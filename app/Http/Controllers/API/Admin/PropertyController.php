<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\Uploadable;

use App\Models\Property as Model;
use App\Models\Owner;

class PropertyController extends Controller
{
    use Uploadable;

    public $model = "Property";

    public $rules = [
        'first_name' => 'required|max:255',
        'last_name' => 'required|max:255',
        'email' => 'required|max:255|email',
        'phone' => 'required|max:255',
        'type' => 'required|max:255',

        'name' => 'required|max:255',
        'location' => 'required|max:255',
        'price' => 'required|decimal:0,2',
        'area' => 'required|decimal:0,2',
        'parking' => 'required|boolean',
        'description' => 'required',

        'unit_number' => 'required|max:255',
        'unit_type' => 'required|max:255',
        'unit_status' => 'required|max:255',

        'sale_type' => 'required|max:255',
        'title' => 'required|max:255',
        'payment' => 'required|max:255',
        'turnover' => 'required|max:255',
        'terms' => 'required|max:255',

        'status' => 'required|max:255',
        'badge' => 'nullable|max:255',
        'published' => 'required|boolean',

        'amenities' => 'required|array',
        'images' => 'required',
    ];

    public function getAll()
    {
        $records = Model::with('owner')->get();
        $code = 200;
        $response = ['message' => "Fetched Properties", 'records' => $records];
        return response()->json($response, $code);
    }

    public function get($id)
    {
        $record = Model::with('owner')->where('id', $id)->first();
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
        $validated = $request->validate($this->rules);

        $owner = Owner::create($validated);

        $validated['owner_id'] = $owner->id;

        $key = 'amenities';
        if ($request[$key]) {
            $amenities = [];
            foreach ($request[$key] as $amenity) {
                array_push($amenities, $amenity);
            }
            $validated[$key] = json_encode($amenities);
        }

        $key = 'images';
        if ($request[$key]) {
            $images = [];
            foreach ($request[$key] as $image) {
                array_push($images, $this->upload($image, "properties/images"));
            }
            $validated[$key] = json_encode($images);
        }

        $record = Model::create($validated);
        $record = Model::with('owner')->where('id', $record->id)->first();
        $code = 201;
        $response = [
            'message' => "Created $this->model",
            'record' => $record,
        ];
        return response()->json($response, $code);
    }

    public function update(Request $request)
    {
        $this->rules['id'] = 'required|exists:properties,id';
        $this->rules['amenities'] = 'nullable|array';
        $this->rules['images'] = 'nullable';
        $validated = $request->validate($this->rules);

        $record = Model::find($validated['id']);

        Owner::find($record->owner_id)->delete();
        $owner = Owner::create($validated);
        $validated['owner_id'] = $owner->id;

        $key = 'amenities';
        if ($request[$key]) {
            $amenities = [];
            foreach ($request[$key] as $amenity) {
                array_push($amenities, $amenity);
            }
            $validated[$key] = json_encode($amenities);
        }

        $key = 'images';
        if ($request[$key]) {
            $images = json_decode($record[$key]);
            foreach ($images as $image) {
                Storage::disk('s3')->delete("properties/images/$image");
            }

            $images = [];
            foreach ($request[$key] as $image) {
                array_push($images, $this->upload($image, "properties/images"));
            }
            $validated[$key] = json_encode($images);
        }

        $record->update($validated);
        $record = Model::with('owner')->where('id', $record->id)->first();
        $code = 200;
        $response = [
            'message' => "Updated $this->model",
            'record' => $record,
        ];
        return response()->json($response, $code);
    }

    public function UpdatePatch(Request $request)
    {
        $this->rules = [
            'id' => 'required|exists:properties,id',
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255',
            'phone' => 'sometimes|string|max:20',
            'type' => 'sometimes|string|max:50',
            'name' => 'sometimes|string|max:255',
            'location' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric',
            'area' => 'sometimes|numeric',
            'parking' => 'sometimes|integer',
            'description' => 'sometimes|string',
            'unit_number' => 'sometimes|string|max:50',
            'unit_type' => 'sometimes|string|max:50',
            'unit_status' => 'sometimes|string|max:50',
            'sale_type' => 'sometimes|string|max:50',
            'title' => 'sometimes|string|max:255',
            'payment' => 'sometimes|string|max:255',
            'turnover' => 'sometimes|string|max:255',
            'terms' => 'sometimes|string|max:255',
            'status' => 'sometimes|string|max:50',
            'published' => 'sometimes|boolean',
            'amenities' => 'sometimes|array',
            'images' => 'sometimes|array',
        ];

        $validated = $request->validate($this->rules);

        $record = Model::findOrFail($validated['id']);

        if ($request->has('owner')) {
            $owner = Owner::find($record->owner_id);
            if ($owner) {
                $owner->update($request->input('owner'));
            }
        }
        

        if ($request->has('amenities')) {
            $amenities = [];
            foreach ($request->input('amenities') as $amenity) {
                array_push($amenities, $amenity);
            }
            $validated['amenities'] = json_encode($amenities);
        }

        if ($request->has('images')) {
            $oldImages = json_decode($record->images, true);
            if ($oldImages) {
                foreach ($oldImages as $image) {
                    Storage::disk('s3')->delete("properties/images/$image");
                }
            }

            $images = [];
            foreach ($request->input('images') as $image) {
                array_push($images, $this->upload($image, "properties/images"));
            }
            $validated['images'] = json_encode($images);
        }

        $record->update($validated);

        $record = Model::with('owner')->findOrFail($record->id);

        $response = [
            'message' => "Updated $this->model",
            'record' => $record,
        ];

        return response()->json($response, 200);
    }
    
    public function delete($id)
    {
        $record = Model::find($id);
        if ($record) {
            $record->delete();
            $code = 200;
            $response = [
                'message' => "Deleted $this->model"
            ];
        } else {
            $code = 404;
            $response = ['message' => "$this->model Not Found"];
        }
        return response()->json($response, $code);
    }

    public function setStatus(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:properties,id',
            'published' => 'required|boolean',
        ]);

        $record = Model::find($validated['id']);
        $record->update($validated);
        $code = 200;
        $response = ['message' => "Updated Status"];
        return response()->json($response, $code);
    }
}
