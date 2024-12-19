<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\Submission as Model;
use App\Models\Property;

class SubmissionController extends Controller
{
    public $model = "Submission";

    public function getAll()
    {
        $records = Model::all();
        $response = ['code' => 200, 'message' => "Fetched $this->model" . "s", 'records' => $records];
        return response($response);
    }

    public function get($id)
    {
        $record = Model::find($id);
        $response = ['code' => 200, 'message' => "Fetched $this->model", 'record' => $record];
        return response($response);
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
                'price' => 'required|decimal:2',
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
                'images' => 'required',
            ]);

            $key = 'images';
            if ($request[$key]) {
                $images = [];
                foreach ($request[$key] as $image) {
                    $name = Str::ulid() . "." . $image->clientExtension();
                    Storage::disk('s3')->put("submissions/images/$name", $image->getContent(), 'public');
                    array_push($images, $name);
                }
                $validated['images'] = json_encode($images);
            }

            $record = Model::create($validated);

            $response = [
                'code' => 200,
                'message' => "Created $this->model",
                'record' => $record,
            ];
        } catch (\Exception $e) {
            $response = [
                'code' => 500,
                'message' => $e->getMessage(),
            ];
        }

        return response()->json($response);
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
            'price' => 'required|decimal:2',
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
                $name = Str::ulid() . "." . $image->clientExtension();
                Storage::disk('s3')->put("submissions/images/$name", $image->getContent(), 'public');
                array_push($images, $name);
            }
            $validated['images'] = json_encode($images);
        }
        $record->update($validated);
        $response = ['code' => 200, 'message' => "Updated $this->model"];

        return response($response);
    }

    public function delete($id)
    {
        $record = Model::find($id);

        try {
            $images = json_decode($record->images);
            foreach ($images as $image) {
                Storage::disk('s3')->delete("submissions/images/$image");
            }
            $record->delete();

            $response = [
                'code' => 200,
                'message' => "Deleted $this->model"
            ];
        } catch (\Exception $e) {
            $response = [
                'code' => 500,
                'message' => $e->getMessage(),
            ];
        }

        return response()->json($response);
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

        $response = ['code' => 200, 'message' => "Updated Status", 'property' => $property];

        return response($response);
    }
}
