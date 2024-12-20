<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\Uploadable;

use App\Models\Certificate as Model;
use App\Models\User;

class CertificateController extends Controller
{
    use Uploadable;

    public $model = "Certificate";

    public function getAll($user_id)
    {
        $user = User::find($user_id);
        if ($user) {
            if ($user->type == "Admin") {
                $records = Model::all();
            } else if ($user->type == "Agent") {
                $records = Model::where('user_id', $user_id)->get();
            }
            $response = ['code' => 200, 'message' => "Fetched $this->model" . "s", 'records' => $records];
        }
        else {
            $response = ['code' => 401, 'message' => "User Not Authenticated"];
        }
        return response()->json($response);
    }

    public function get($id)
    {
        $record = Model::find($id);
        if ($record) {
            $response = ['code' => 200, 'message' => "Fetched $this->model", 'record' => $record];
        }
        else {
            $response = ['code' => 404, 'message' => "$this->model Not Found"];
        }
        return response()->json($response);
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
            $validated[$key] = $this->upload($request->file($key), "certificates");
        }

        $record = Model::create($validated);
        $response = ['code' => 200, 'message' => "Created $this->model", 'record' => $record];

        return response()->json($response);
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
            Storage::disk('s3')->delete("certificates/$record->image");
            $validated[$key] = $this->upload($request->file($key), "certificates");
        }

        $record->update($validated);
        $response = ['code' => 200, 'message' => "Updated $this->model"];

        return response()->json($response);
    }

    public function delete($id)
    {
        $record = Model::find($id);
        if ($record) {
            Storage::disk('s3')->delete("certificates/$record->image");
            $record->delete();
            $response = ['code' => 200, 'message' => "Deleted $this->model"];
        }
        else {
            $response = ['code' => 404, 'message' => "$this->model Not Found"];
        }

        return response()->json($response);
    }
}
