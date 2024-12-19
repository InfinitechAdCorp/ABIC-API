<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Amenity as Model;

class AmenityController extends Controller
{
    public $model = "Amenity";

    public function getAll()
    {
        $records = Model::all();
        $response = ['code' => 200, 'message' => "Fetched Amenities", 'records' => $records];
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
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'name' => 'required',
        ]);

        $record = Model::create($validated);
        $response = ['code' => 200, 'message' => "Created $this->model", 'record' => $record];

        return response($response);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:amenities,id',
            'property_id' => 'required|exists:properties,id',
            'name' => 'required',
        ]);

        $record = Model::find($validated['id']);
        $record = $record->update($validated);
        $response = ['code' => 200, 'message' => "Updated $this->model", 'record' => $record];

        return response($response);
    }

    public function delete($id)
    {
        $record = Model::find($id);
        $record->delete();
        return response(['code' => 200, 'message' => "Deleted $this->model"]);
    }
}
