<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\Uploadable;

use App\Models\Partner as Model;

class PartnerController extends Controller
{
    use Uploadable;

    public $model = "Partner";

    public function getAll()
    {
        $records = Model::all();
        $response = ['code' => 200, 'message' => "Fetched $this->model" . "s", 'records' => $records];
        return response()->json($response);
    }

    public function get($id)
    {
        $record = Model::find($id);
        if ($record) {
            $response = ['code' => 200, 'message' => "Fetched $this->model", 'record' => $record];
        } else {
            $response = ['code' => 404, 'message' => "$this->model Not Found"];
        }
        return response()->json($response);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'image' => 'required|image',
        ]);

        $key = 'image';
        if ($request->hasFile($key)) {
            $validated[$key] = $this->upload($request->file($key), "partners");
        }

        $record = Model::create($validated);
        $response = ['code' => 200, 'message' => "Created $this->model", 'record' => $record];

        return response()->json($response);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:partners,id',
            'name' => 'required',
            'image' => 'nullable|image',
        ]);

        $record = Model::find($validated['id']);

        $key = 'image';
        if ($request->hasFile($key)) {
            Storage::disk('s3')->delete("partners/$record->image");
            $validated[$key] = $this->upload($request->file($key), "partners");
        }

        $record->update($validated);
        $response = ['code' => 200, 'message' => "Updated $this->model"];

        return response()->json($response);
    }

    public function delete($id)
    {
        $record = Model::find($id);
        if ($record) {
            Storage::disk('s3')->delete("partners/$record->image");
            $record->delete();
            $response = ['code' => 200, 'message' => "Deleted $this->model"];
        } else {
            $response = ['code' => 404, 'message' => "$this->model Not Found"];
        }

        return response($response);
    }
}
