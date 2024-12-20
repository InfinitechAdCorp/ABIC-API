<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Traits\Uploadable;
use Illuminate\Http\Request;

use App\Models\Schedule as Model;
use App\Models\User;

class ScheduleController extends Controller
{
    use Uploadable;

    public $model = "Schedule";

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
        } else {
            $response = ['code' => 401, 'message' => "User Not Authenticated"];
        }
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
            'user_id' => 'required|exists:users,id',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'date' => 'required|date',
            'time' => 'required',
            'type' => 'required',
            'properties' => 'required',
            'message' => 'required',
            'status' => 'required',
        ]);

        $record = Model::create($validated);
        $response = ['code' => 200, 'message' => "Created $this->model", 'record' => $record];

        return response()->json($response);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:schedules,id',
            'user_id' => 'required|exists:users,id',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'date' => 'required|date',
            'time' => 'required',
            'type' => 'required',
            'properties' => 'required',
            'message' => 'required',
            'status' => 'required',
        ]);

        $record = Model::find($validated['id']);
        $record->update($validated);
        $response = ['code' => 200, 'message' => "Updated $this->model"];

        return response()->json($response);
    }

    public function delete($id)
    {
        $record = Model::find($id);
        if ($record) {
            $record->delete();
            $response = ['code' => 200, 'message' => "Deleted $this->model"];
        } else {
            $response = ['code' => 404, 'message' => "$this->model Not Found"];
        }
        return response()->json($response);
    }

    public function changeStatus(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:schedules,id',
            'status' => 'required',
        ]);

        $record = Model::find($validated['id']);
        $record->update($validated);
        $response = ['code' => 200, 'message' => "Updated Status"];

        return response()->json($response);
    }
}
