<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

use App\Models\Testimonial as Model;

class TestimonialController extends Controller
{
    public $model = "Testimonial";

    public $rules = [
        'user_id' => 'required|exists:users,id',
        'first_name' => 'required|max:255',
        'last_name' => 'required|max:255',
        'message' => 'required|max:255',
    ];

    public function getAll(Request $request)
    {
        $user =  PersonalAccessToken::findToken($request->bearerToken())->tokenable;
        if ($user->type == "Admin") {
            $records = Model::with('user')->orderBy('updated_at', 'desc')->get();
        } else if ($user->type == "Agent") {
            $records = Model::with('user')->where('user_id', $user->id)->orderBy('updated_at', 'desc')->get();
        }
        $code = 200;
        $response = ['message' => "Fetched $this->model" . "s", 'records' => $records];
        return response()->json($response, $code);
    }

    public function get($id)
    {
        $record = Model::with('user')->where('id', $id)->first();
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

        $record = Model::create($validated);
        $code = 201;
        $response = [
            'message' => "Created $this->model",
            'record' => $record,
        ];
        return response()->json($response, $code);
    }

    public function update(Request $request)
    {
        $this->rules['id'] = 'required|exists:testimonials,id';
        $validated = $request->validate($this->rules);

        $record = Model::find($validated['id']);
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
            $response = [
                'message' => "Deleted $this->model"
            ];
        } else {
            $code = 404;
            $response = ['message' => "$this->model Not Found"];
        }
        return response()->json($response, $code);
    }
}
