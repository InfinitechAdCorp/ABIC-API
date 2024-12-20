<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User as Model;

class UserController extends Controller
{
    public function getAll($id)
    {
        if ($id) {
            $record = Model::find($id);
            if ($record->type == "Admin") {
                $records = Model::all();
                $response = ['code' => 200, 'message' => 'Fetched Users', 'records' => $records];
            } else if ($record->type == "Agent") {
                $response = ['code' => 200, 'message' => 'Fetched User', 'record' => $record];
            }
        } else {
            $response = ['code' => 401, 'message' => 'User Not Authenticated'];
        }

        return response()->json($response);
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

            $response = [
                'code' => 200,
                'message' => 'Created User',
                'record' => $record,
            ];
        } catch (\Exception $e) {
            $response = [
                'code' => 500,
                'message' => $e->getMessage(),
            ];
        }

        return response()->json($response);
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
            $response = [
                'code' => 200,
                'message' => 'Login Successful',
                'record' => $record,
                'token' => $token,
            ];
        } else {
            $response = [
                'code' => 401,
                'message' => 'Invalid Credentials',
            ];
        }

        return response()->json($response);
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            $request->user()->currentAccessToken()->delete();
            $response = [
                'code' => 200,
                'message' => 'Logged Out Successfully',
            ];
        } else {
            $response = [
                'code' => 401,
                'message' => 'Not Authenticated',
            ];
        }

        return response()->json($response);
    }
}
