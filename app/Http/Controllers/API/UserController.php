<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User as Model;

class UserController extends Controller
{
    public $model = "User";

    public function getAll($id)
    {
        if ($id) {
            $record = Model::find($id);
            if ($record) {
                if ($record->type == "Admin") {
                    $records = Model::all();

                    $code = 200;
                    $response = ['message' => "Fetched $this->model" . "s", 'records' => $records];
                } else if ($record->type == "Agent") {
                    $code = 200;
                    $response = ['message' => "Fetched $this->model", 'record' => $record];
                }
            } else {
                $code = 404;
                $response = ['message' => "$this->model Not Found"];
            }
        } else {
            $code = 401;
            $response = ['message' => "$this->model Not Authenticated"];
        }

        return response()->json($response, $code);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'type' => 'required'
        ]);

        try {
            $key = "password";
            $validated[$key] = Hash::make($validated[$key]);
            $record = Model::create($validated);

            $code = 201;
            $response = [
                'message' => "Created $this->model",
                'record' => $record,
            ];
        } catch (\Exception $e) {
            $code = 500;
            $response = [
                'message' => $e->getMessage(),
            ];
        }

        return response()->json($response, $code);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $record = Model::where('email', $request->email)->first();

        if ($record && Hash::check($request->password, $record->password)) {
            $record->tokens()->delete();
            $token = $record->createToken($record->name . '-AuthToken')->plainTextToken;

            $code = 200;
            $response = [
                'message' => 'Login Successful',
                'record' => $record,
                'token' => $token,
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
        if (Auth::check()) {
            $request->user()->currentAccessToken()->delete();

            $code = 200;
            $response = [
                'message' => 'Logged Out Successfully',
            ];
        } else {
            $code = 401;
            $response = [
                'message' => "$this->model Not Authenticated",
            ];
        }

        return response()->json($response, $code);
    }
}
