<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\Uploadable;
use Laravel\Sanctum\PersonalAccessToken;

use App\Models\Submission as Model;
use App\Models\Property;

class SubmissionController extends Controller
{
    use Uploadable;

    public $model = "Submission";

    public function getAll(Request $request)
    {
        if ($token = $request->bearerToken()) {
            $user =  PersonalAccessToken::findToken($token)->tokenable;

            if ($user) {
                if ($user->type == "Admin") {
                    $records = Model::all();
                } else if ($user->type == "Agent") {
                    $records = Model::where('user_id', $user->id)->get();
                }

                $code = 200;
                $response = ['message' => "Fetched $this->model" . "s", 'records' => $records];
            } else {
                $code = 404;
                $response = ['message' => "User Not Found"];
            }
        } else {
            $code = 401;
            $response = ['message' => "User Not Authenticated"];
        }
        return response()->json($response, $code);
    }

    public function get($id)
    {
        $record = Model::find($id);
        if ($record) {
            $code = 200;
            $response = ['message' => "Fetched $this->model", 'record' => $record];
        } else {
            $code = 404;
            $response = ['message' => "$this->model Not Found"];
        }
        return response()->json($response, $code);
    }

    public function create(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required|email',
                'property' => 'required',
                'type' => 'required',
                'location' => 'required',
                'price' => 'required|decimal:0,2',
                'area' => 'required|numeric',
                'parking' => 'required|boolean',
                'vacant' => 'required|boolean',
                'nearby' => 'required',
                'description' => 'required',
                'sale' => 'required',
                'badge' => 'required',
                'status' => 'required',
                'submit_status' => 'required',
                'unit_number' => 'required',
                'unit_type' => 'required',
                'unit_furnish' => 'required',
                'unit_floor' => 'nullable',
                'submitted_by' => 'required',
                'commission' => 'required|boolean',
                'terms' => 'required',
                'title' => 'required',
                'turnover' => 'required',
                'lease' => 'required',
                'acknowledgment' => 'required',
                'amenities' => 'required|array',
                'images' => 'required',
            ]);

            $key = 'images';
            if ($request[$key]) {
                $images = [];
                foreach ($request[$key] as $image) {
                    array_push($images, $this->upload($image, "submissions/images"));
                }
                $validated[$key] = json_encode($images);
            }

            $key = 'amenities';
            if ($request[$key]) {
                $amenities = [];
                foreach ($request[$key] as $amenity) {
                    array_push($amenities, $amenity);
                }
                $validated[$key] = json_encode($amenities);
            }

            $record = Model::create($validated);

            $code = 201;
            $response = [
                'message' => "Created $this->model",
                'record' => $record,
            ];
        } catch (\Exception $e) {
            $code = 500;
            $response = [
                'message' => $e->getMessage(),
            ];
        }

        return response()->json($response, $code);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:submissions,id',
            'user_id' => 'required|exists:users,id',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'property' => 'required',
            'type' => 'required',
            'location' => 'required',
            'price' => 'required|decimal:0,2',
            'area' => 'required|numeric',
            'parking' => 'required|boolean',
            'vacant' => 'required|boolean',
            'nearby' => 'required',
            'description' => 'required',
            'sale' => 'required',
            'badge' => 'required',
            'status' => 'required',
            'submit_status' => 'required',
            'unit_number' => 'required',
            'unit_type' => 'required',
            'unit_furnish' => 'required',
            'unit_floor' => 'nullable',
            'submitted_by' => 'required',
            'commission' => 'required|boolean',
            'terms' => 'required',
            'title' => 'required',
            'turnover' => 'required',
            'lease' => 'required',
            'acknowledgment' => 'required',
            'amenities' => 'required|array',
            'images' => 'nullable',
        ]);

        $record = Model::find($validated['id']);

        $key = 'images';

        $images = json_decode($record[$key]);
        foreach ($images as $image) {
            Storage::disk('s3')->delete("submissions/images/$image");
        }

        if ($request[$key]) {
            $images = [];
            foreach ($request[$key] as $image) {
                array_push($images, $this->upload($image, "submissions/images"));
            }
            $validated[$key] = json_encode($images);
        }

        $key = 'amenities';
        if ($request[$key]) {
            $amenities = [];
            foreach ($request[$key] as $amenity) {
                array_push($amenities, $amenity);
            }
            $validated[$key] = json_encode($amenities);
        }

        $record->update($validated);

        $code = 200;
        $response = ['message' => "Updated $this->model"];

        return response()->json($response, $code);
    }

    public function delete($id)
    {
        $record = Model::find($id);
        if ($record) {
            try {
                $images = json_decode($record->images);
                foreach ($images as $image) {
                    Storage::disk('s3')->delete("submissions/images/$image");
                }
                $record->delete();

                $code = 200;
                $response = [
                    'message' => "Deleted $this->model"
                ];
            } catch (\Exception $e) {
                $code = 500;
                $response = [
                    'message' => $e->getMessage(),
                ];
            }
        } else {
            $code = 404;
            $response = ['message' => "$this->model Not Found"];
        }

        return response()->json($response, $code);
    }

    public function changeStatus(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:submissions,id',
            'submit_status' => 'required',
        ]);

        $record = Model::find($validated['id']);
        $record->update($validated);

        if ($validated['submit_status'] == "Accepted") {
            $property = [
                'user_id' => $record->user_id,
                'name' => $record->name,
                'type' => $record->type,
                'location' => $record->location,
                'price' => $record->price,
                'area' => $record->area,
                'parking' => $record->parking,
                'vacant' => $record->vacant,
                'nearby' => $record->nearby,
                'description' => $record->description,
                'sale' => $record->sale,
                'badge' => $record->badge,
                'status' => $record->status,
                'unit_number' => $record->unit_number,
                'unit_type' => $record->unit_type,
                'unit_furnish' => $record->unit_furnish,
                'unit_floor' => $record->unit_floor,
                'images' => $record->images,
            ];

            $property = Property::create($property);
        }

        $code = 200;
        $response = ['message' => "Updated Status", 'property' => $property];
        return response()->json($response, $code);
    }
}
