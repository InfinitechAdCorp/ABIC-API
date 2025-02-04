<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;

use App\Models\User as Model;

class UserController extends Controller
{
    public $model = "User";

    public $relations = ['profile', 'certificates', 'inquiries', 'schedules', 'testimonials', 'videos'];

    public function getAll(Request $request)
    {
        $record =  PersonalAccessToken::findToken($request->bearerToken())->tokenable;
        if ($record->type == "Admin") {
            $records = Model::with($this->relations)->orderBy('updated_at', 'desc')->get();
            $code = 200;
            $response = ['message' => "Fetched $this->model" . "s", 'records' => $records];
        } else if ($record->type == "Agent") {
            $record = Model::with($this->relations)->where('id', $record->id)->first();
            $code = 200;
            $response = ['message' => "Fetched $this->model", 'record' => $record];
        }
        return response()->json($response, $code);
    }

    public function get($id)
    {
        $record = Model::with($this->relations)->where('id', $id)->first();
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
        $validated = $request->validate([
            'name' => 'required|max:255|unique:users,name',
            'email' => 'required|max:255|email|unique:users,email',
            'password' => 'required|min:8|max:255',
            'address' => 'required|max:255|string',
            'type' => 'required|max:255'
        ]);

        $validated['password'] = Hash::make($validated['password']);

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
        $validated = $request->validate([
            'id' => 'required|exists:users,id',
            'name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'address' => 'required|max:255|string',
        ]);

        $record = Model::find($validated['id']);
        $record->update($validated);
        $code = 200;
        $response = [
            'message' => "Updated $this->model",
            'record' => $record,
        ];
        return response()->json($response, $code);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $record = Model::where('email', $validated['email'])->first();
        $validPassword = Hash::check($validated['password'], $record->password);

        if ($record && $validPassword) {
            $record->tokens()->delete();
            $token = $record->createToken("$record->name-AuthToken")->plainTextToken;
            $code = 200;
            $response = [
                'message' => 'Logged In Successfully',
                'token' => $token,
                'record' => $record,
            ];
        } else {
            $code = 401;
            $response = [
                'message' => 'Invalid Credentials',
            ];
        }
        return response()->json($response, $code);
    }

    public function logout(Request $request)
    {
        $record = PersonalAccessToken::findToken($request->bearerToken())->tokenable;
        PersonalAccessToken::where('tokenable_id', $record->id)->delete();
        $code = 200;
        $response = ['message' => 'Logged Out Successfully'];
        return response()->json($response, $code);
    }

    public function requestReset(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $record = Model::where('email', $validated['email'])->first();
        $code = 200;
        $response = ['message' => 'Request Sent Successfully', 'reset_token' => $record->reset_token];
        return response()->json($response, $code);
    }

    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'password' => 'required|min:8|max:255',
            'reset_token' => 'required|exists:users,reset_token',
        ]);

        $record = Model::where('reset_token', $validated['reset_token'])->first();
        $validated['password'] = Hash::make($validated['password']);
        $validated['reset_token'] = Str::random();
        $record->update($validated);
        $code = 200;
        $response = ['message' => 'Reset Password Successfully'];
        return response()->json($response, $code);
    }
}
