<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\Uploadable;

use App\Models\Event as Model;

class EventController extends Controller
{
    use Uploadable;

    public $model = "Event";

    public function getAll()
    {
        $records = Model::orderBy('updated_at', 'desc')->get();
        $code = 200;
        $response = ['message' => "Fetched $this->model" . "s", 'records' => $records];
        return response()->json($response, $code);
    }

    public function get($id)
    {
        $record = Model::find($id);
        if ($record) {
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
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);

        $key = 'image';
        if ($request->hasFile($key)) {
            $validated[$key] = $this->upload($request->file($key), "events");
        }

        $record = Model::create($validated);
        $code = 201;
        $response = ['message' => "Created $this->model", 'record' => $record];
        return response()->json($response, $code);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:events,id',
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable',
        ]);

        $record = Model::find($validated['id']);

        $key = 'image';
        if ($request->hasFile($key)) {
            Storage::disk('s3')->delete("events/$record[$key]");
            $validated[$key] = $this->upload($request->file($key), "events");
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
            Storage::disk('s3')->delete("events/$record->image");
            $record->delete();
            $code = 200;
            $response = ['message' => "Deleted $this->model"];
        }
        else {
            $code = 404;
            $response = ['message' => "$this->model Not Found"];
        }
        return response($response, $code);
    }
}
