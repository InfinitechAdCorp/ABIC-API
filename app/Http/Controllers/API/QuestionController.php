<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Question as Model;

class QuestionController extends Controller
{
    public $model = "Question";

    public function getAll()
    {
        $records = Model::all();
        $response = ['code' => 200, 'message' => "Fetched $this->model"."s", 'records' => $records];
        return response()->json($response);
    }

    public function get($id)
    {
        $record = Model::findOrFail($id);
        $response = ['code' => 200, 'message' => "Fetched $this->model", 'record' => $record];
        return response()->json($response);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required',
            'answer' => 'required',
            'status' => 'required',
        ]);

        Model::create($validated);
        $response = ['code' => 200, 'message' => "Created $this->model"];

        return response()->json($response);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:questions,id',
            'question' => 'required',
            'answer' => 'required',
            'status' => 'required',
        ]);

        $record = Model::find($validated["id"]);
        $record->update($validated);
        $response = ['code' => 200, 'message' => "Updated $this->model"];

        return response()->json($response);
    }

    public function delete($id)
    {
        $record = Model::findOrFail($id);
        $record->delete();
        $response = ['code' => 200, 'message' => "Deleted $this->model"];
        return response()->json($response);
    }
}
