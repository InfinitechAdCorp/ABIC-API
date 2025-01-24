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

        'title' => 'required|max:255',
        'payment' => 'required|max:255',
        'turnover' => 'required|max:255',
        'terms' => 'required|max:255',

        'category' => 'required|max:255',
        'badge' => 'nullable|max:255',
        'published' => 'required|boolean',

        'amenities' => 'required|array',
        'images' => 'required',
    ];

    public function getAll()
    {
        $records = Model::with('owner')->orderBy('updated_at', 'desc')->get();
        $code = 200;
        $response = ['message' => "Fetched $this->model" . "s", 'records' => $records];
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

    public function delete($id)
    {
        $record = Model::find($id);
        if ($record) {
            Owner::find($record->owner_id)->delete();

            $images = json_decode($record->images);
            foreach ($images as $image) {
                Storage::disk('s3')->delete("properties/images/$image");
            }

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

    public function setStatus(Request $request) {
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
