<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\Uploadable;

use App\Models\Property as Model;
use App\Models\Owner as Parent;

class PropertyController extends Controller
{
    use Uploadable;

    public $model = "Property";

    public $rules = [
        'owner.first_name' => 'required|max:255',
        'owner.last_name' => 'required|max:255',
        'owner.email' => 'required|max:255|email',
        'owner.phone' => 'required|max:255',
        'owner.type' => 'required|max:255',

        'property.name' => 'required|max:255',
        'property.location' => 'required|max:255',
        'property.price' => 'required|decimal:0,2',
        'property.area' => 'required|decimal:0,2',
        'property.parking' => 'required|boolean',
        'property.description' => 'required',

        'property.unit_number' => 'required|max:255',
        'property.unit_type' => 'required|max:255',
        'property.unit_status' => 'required|max:255',

        'property.title' => 'required|max:255',
        'property.payment' => 'required|max:255',
        'property.turnover' => 'required|max:255',
        'property.terms' => 'required|max:255',

        'property.type' => 'required|max:255',
        'property.published' => 'required|max:255',

        'property.amenities' => 'required|array',
        'property.images' => 'required',
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

        $parent = Parent::create($validated['owner']);

        $validated['property']['owner_id'] = $parent->id;

        $key = 'amenities';
        if ($request['property'][$key]) {
            $amenities = [];
            foreach ($request['property'][$key] as $amenity) {
                array_push($amenities, $amenity);
            }
            $validated['property'][$key] = json_encode($amenities);
        }

        $key = 'images';
        if ($request['property'][$key]) {
            $images = [];
            foreach ($request['property'][$key] as $image) {
                array_push($images, $this->upload($image, "properties/images"));
            }
            $validated['property'][$key] = json_encode($images);
        }

        $record = Model::create($validated['property']);
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

        Parent::find($record->owner_id)->delete();
        $parent = Parent::create($validated['owner']);
        $validated['property']['owner_id'] = $parent->id;

        $key = 'amenities';
        if ($request['property'][$key]) {
            $amenities = [];
            foreach ($request['property'][$key] as $amenity) {
                array_push($amenities, $amenity);
            }
            $validated['property'][$key] = json_encode($amenities);
        }

        $key = 'images';
        if ($request['property'][$key]) {
            $images = json_decode($record[$key]);
            foreach ($images as $image) {
                Storage::disk('s3')->delete("properties/images/$image");
            }

            $images = [];
            foreach ($request['property'][$key] as $image) {
                array_push($images, $this->upload($image, "properties/images"));
            }
            $validated['property'][$key] = json_encode($images);
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
            Parent::find($record->owner_id)->delete();

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

    public function setPublishedStatus(Request $request) {
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
