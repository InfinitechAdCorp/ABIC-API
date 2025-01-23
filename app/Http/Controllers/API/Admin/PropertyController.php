<?php

namespace App\Http\Controllers\API\Admin;

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

    public $rules = [
        'name' => 'required|max:255',
        'type' => 'required|max:255',
        'location' => 'required|max:255',
        'price' => 'required|decimal:0,2',
        'area' => 'required|numeric|integer',
        'parking' => 'required|boolean',
        'vacant' => 'required|boolean',
        'nearby' => 'required',
        'description' => 'required',
        'sale' => 'required|max:255',
        'badge' => 'required|max:255',
        'status' => 'required|max:255',
        'unit_number' => 'required|max:255',
        'unit_type' => 'required|max:255',
        'unit_furnish' => 'required|max:255',
        'unit_floor' => 'required|max:255',
        'amenities' => 'required|array',
        'images' => 'required',
    ];

    public function getAll(Request $request)
    {
        $user =  PersonalAccessToken::findToken($request->bearerToken())->tokenable;
        if ($user->type == "Admin") {
            $records = Model::with('user')->orderBy('updated_at', 'desc')->get();
        } else if ($user->type == "Agent") {
            $records = Model::with('user')->where('user_id', $user->id)->orderBy('updated_at', 'desc')->get();
        }
        $code = 200;
        $response = ['message' => "Fetched Properties", 'records' => $records];
        return response()->json($response, $code);
    }

    public function get($id)
    {
        $record = Model::with('user')->where('id', $id)->first();
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
        $code = 200;
        $response = ['message' => "Updated $this->model"];
        return response()->json($response, $code);
    }

    public function delete($id)
    {
        $record = Model::find($id);
        if ($record) {
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
}
