<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\Uploadable;

use App\Models\Application as Model;

class ApplicationController extends Controller
{
    use Uploadable;

    public $model = "Application";

    public $rules = [
        'career_id' => 'required|exists:careers,id',
        'first_name' => 'required|max:255',
        'last_name' => 'required|max:255',
        'email' => 'required|max:255|email',
        'phone' => 'required|max:255',
        'address' => 'required|max:255',
        'resume' => 'required',
    ];

    public function getAll()
    {
        $records = Model::with('career')->orderBy('updated_at', 'desc')->get();
        $code = 200;
        $response = ['message' => "Fetched $this->model" . "s", 'records' => $records];
        return response()->json($response, $code);
    }

    public function get($id)
    {
        $record = Model::with('career')->where('id', $id)->first();
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

        $key = 'resume';
        if ($request->hasFile($key)) {
            $validated[$key] = $this->upload($request->file($key), "careers/applications");
        }

        $record = Model::create($validated);
        $code = 201;
        $response = ['message' => "Created $this->model", 'record' => $record];
        return response()->json($response, $code);
    }

    public function update(Request $request)
    {
        $this->rules['id'] = 'required|exists:applications,id';
        $this->rules['resume'] = 'nullable';
        $validated = $request->validate($this->rules);

        $record = Model::find($validated['id']);

        $key = 'resume';
        if ($request->hasFile($key)) {
            Storage::disk('public')->delete("careers/applications/$record[$key]");
            $validated[$key] = $this->upload($request->file($key), "careers/applications");
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
        } else {
            $code = 404;
            $response = ['message' => "$this->model Not Found"];
        }
        return response()->json($response, $code);
    }
}
