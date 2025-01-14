<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\Uploadable;
use Laravel\Sanctum\PersonalAccessToken;

use App\Models\Property as Model;

class PropertyController extends Controller
{
    use Uploadable;

    public $model = "Property";

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
                $response = ['message' => "Fetched Properties", 'records' => $records];
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
                'name' => 'nullable',
                'type' => 'nullable',
                'location' => 'nullable',
                'price' => 'nullable|decimal:0,2',
                'area' => 'nullable|numeric',
                'parking' => 'nullable|boolean',
                'vacant' => 'nullable|boolean',
                'nearby' => 'nullable',
                'description' => 'nullable',
                'sale' => 'nullable',
                'badge' => 'nullable',
                'status' => 'nullable',
                'unit_number' => 'nullable',
                'unit_type' => 'nullable',
                'unit_furnish' => 'nullable',
                'unit_floor' => 'nullable',
                'amenities' => 'nullable|array',
                'images' => 'nullable',
            ]);

            $key = 'images';
            if ($request[$key]) {
                $images = [];
                foreach ($request[$key] as $image) {
                    array_push($images, $this->upload($image, "properties/images"));
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
            'id' => 'required|exists:properties,id',
            'user_id' => 'required|exists:users,id',
            'name' => 'nullable',
            'type' => 'nullable',
            'location' => 'nullable',
            'price' => 'nullable|decimal:0,2',
            'area' => 'nullable|numeric',
            'parking' => 'nullable|boolean',
            'vacant' => 'nullable|boolean',
            'nearby' => 'nullable',
            'description' => 'nullable',
            'sale' => 'nullable',
            'badge' => 'nullable',
            'status' => 'nullable',
            'unit_number' => 'nullable',
            'unit_type' => 'nullable',
            'unit_furnish' => 'nullable',
            'unit_floor' => 'nullable',
            'images' => 'nullable',
            'amenities' => 'nullable|array',
        ]);

        $record = Model::find($validated['id']);

        $key = 'images';

        $images = json_decode($record[$key]);
        foreach ($images as $image) {
            Storage::disk('s3')->delete("properties/images/$image");
        }

        if ($request[$key]) {
            $images = [];
            foreach ($request[$key] as $image) {
                array_push($images, $this->upload($image, "properties/images"));
            }
            $validated['images'] = json_encode($images);
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
                    Storage::disk('s3')->delete("properties/images/$image");
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
}
