<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Traits\Uploadable;
use Illuminate\Http\Request;

use App\Models\Certificate as Model;

class CertificateController extends Controller
{
    use Uploadable;

    public $model = "Certificate";

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
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required',
            'date' => 'required|date',
            'image' => 'required|image',
        ]);

        $key = 'image';
        if ($request->hasFile($key)) {
            $validated[$key] = $this->upload($request->file($key), 'uploads/certificates');
        }

        Model::create($validated);
        $response = ['code' => 200, 'message' => "Created $this->model"];

        return response($response);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:certificates,id',
            'user_id' => 'required|exists:users,id',
            'name' => 'required',
            'date' => 'required|date',
            'image' => 'nullable|image',
        ]);

        $record = Model::find($validated['id']);

        $key = 'image';
        if ($request->hasFile($key)) {
            $validated[$key] = $this->upload($request->file($key), 'uploads/certificates');
            $file = public_path("uploads/certificates/$record->image");
            if (file_exists($file)) unlink($file);
        }

        $record->update($validated);
        $response = ['code' => 200, 'message' => "Updated $this->model"];

        return response($response);
    }

    public function delete($id)
    {
        $record = Model::find($id);
        $file = public_path("uploads/certificates/$record->image");
        if (file_exists($file)) unlink($file);
        $record->delete();
        return response(['code' => 200, 'message' => "Deleted $this->model"]);
    }
}
