<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\Uploadable;

use App\Models\Career as Model;

class CareerController extends Controller
{
    use Uploadable;
    
    public $model = "Career";

    public $rules = [
        'position' => 'required|max:255',
        'slots' => 'required|numeric|integer',
        'image' => 'required',
    ];

    public function getAll()
    {
        $records = Model::with('applications')->orderBy('updated_at', 'desc')->get();
        foreach ($records as $record) {
            $record['applications_count'] = count($record['applications']); 
        }
        $code = 200;
        $response = ['message' => "Fetched $this->model" . "s", 'records' => $records];
        return response()->json($response, $code);
    }

    public function get($id)
    {
        $record = Model::with('applications')->where('id', $id)->first();
        if ($record) {
            $record['applications_count'] = count($record['applications']); 
            $code = 200;
            $response = ['message' => "Fetched $this->model", 'record' => $record];
        }
        else {
            $code = 404;
            $response = ['message' => "$this->model Not Found"];
        }
        return response()->json($response, $code);
    }

    public function create(Request $request)
    {
        $validated = $request->validate($this->rules);

        $key = 'image';
        if ($request->hasFile($key)) {
            $validated[$key] = $this->upload($request->file($key), "careers/images");
        }

        $record = Model::create($validated);
        $code = 201;
        $response = ['message' => "Created $this->model", 'record' => $record];
        return response()->json($response, $code);
    }

    public function update(Request $request)
    {
        $this->rules['id'] = 'required|exists:careers,id';
        $this->rules['image'] = 'nullable';
        $validated = $request->validate($this->rules);

        $record = Model::find($validated['id']);

        $key = 'image';
        if ($request->hasFile($key)) {
            Storage::disk('public')->delete("careers/images/$record[$key]");
            $validated[$key] = $this->upload($request->file($key), "careers/images");
        }

        $record->update($validated);
        $code = 200;
        $response = ['message' => "Updated $this->model", 'record' => $record];
        return response()->json($response, $code);
    }

    public function delete($id)
    {
        $record = Model::find($id);
        if ($record) {
            $record->delete();
            $code = 200;
            $response = ['message' => "Deleted $this->model"];
        }
        else {
            $code = 404;
            $response = ['message' => "$this->model Not Found"];
        }
        return response()->json($response, $code);
    }
}