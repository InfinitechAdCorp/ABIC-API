<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\Partner as Model;

class PartnerController extends Controller
{
    public $model = "Partner";

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
            'name' => 'required',
            'image' => 'required|image',
        ]);

        $key = 'image';
        if ($request->hasFile($key)) {
            $name = Str::ulid() . "." . $request->file($key)->clientExtension();
            Storage::disk('s3')->put("partners/$name", $request->file($key)->getContent(), 'public');
            $validated[$key] = $name;
        }

        $record = Model::create($validated);
        $response = ['code' => 200, 'message' => "Created $this->model", 'record' => $record];

        return response($response);
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
            $name = Str::ulid() . "." . $request->file($key)->clientExtension();
            Storage::disk('s3')->put("partners/$name", $request->file($key)->getContent(), 'public');
            $validated[$key] = $name;
        }

        $record->update($validated);
        $response = ['code' => 200, 'message' => "Updated $this->model"];

        return response($response);
    }

    public function delete($id)
    {
        $record = Model::find($id);
        Storage::disk('s3')->delete("partners/$record->image");
        $record->delete();
        return response(['code' => 200, 'message' => "Deleted $this->model"]);
    }
}
