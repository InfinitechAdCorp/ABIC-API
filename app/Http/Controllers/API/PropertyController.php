<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\Property as Model;
use App\Models\User;

class PropertyController extends Controller
{
    public $model = "Property";

    public function getAll($user_id)
    {
        $user = User::find($user_id);
        if ($user->type == "Admin") {
            $records = Model::with("amenities")->get();
        } else if ($user->type == "Agent") {
            $records = Model::with("amenities")->where('user_id', $user_id)->get();
        }
        $response = ['code' => 200, 'message' => "Fetched Properties", 'records' => $records];
        return response()->json($response);
    }

    public function get($id)
    {
        $record = Model::find($id);
        $response = ['code' => 200, 'message' => "Fetched $this->model", 'record' => $record];
        return response()->json($response);
    }

    public function getAgentProperties($id)
    {
        $records = Model::where('user_id', $id)->get();
        $response = ['code' => 200, 'message' => "Fetched Properties", 'records' => $records];
        return response()->json($response);
    }

    public function create(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'name' => 'required',
                'type' => 'required',
                'location' => 'required',
                'price' => 'required|decimal:0,2',
                'area' => 'required|numeric',
                'parking' => 'required|boolean',
                'vacant' => 'required|boolean',
                'nearby' => 'required',
                'description' => 'required',
                'sale' => 'required',
                'badge' => 'required',
                'status' => 'required',
                'unit_number' => 'required',
                'unit_type' => 'required',
                'unit_furnish' => 'required',
                'unit_floor' => 'nullable',
                'images' => 'required',
            ]);

            $key = 'images';
            if ($request[$key]) {
                $images = [];
                foreach ($request[$key] as $image) {
                    $name = Str::ulid() . "." . $image->clientExtension();
                    Storage::disk('s3')->put("properties/images/$name", $image->getContent(), 'public');
                    array_push($images, $name);
                }
                $validated['images'] = json_encode($images);
            }

            $record = Model::create($validated);

            $response = [
                'code' => 200,
                'message' => "Created $this->model",
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

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:properties,id',
            'user_id' => 'required|exists:users,id',
            'name' => 'required',
            'type' => 'required',
            'location' => 'required',
            'price' => 'required|decimal:0,2',
            'area' => 'required|numeric',
            'parking' => 'required|boolean',
            'vacant' => 'required|boolean',
            'nearby' => 'required',
            'description' => 'required',
            'sale' => 'required',
            'badge' => 'required',
            'status' => 'required',
            'unit_number' => 'required',
            'unit_type' => 'required',
            'unit_furnish' => 'required',
            'unit_floor' => 'nullable',
            'images' => 'nullable',
        ]);

        $record = Model::find($validated['id']);
        $key = 'images';
        $images = json_decode($record[$key]);
        foreach ($images as $image) {
            Storage::disk('s3')->delete("properties/images/$image");
        }
        if ($request[$key]) {
            $images = [];
            foreach ($request[$key] as $image) {
                $name = Str::ulid() . "." . $image->clientExtension();
                Storage::disk('s3')->put("properties/images/$name", $image->getContent(), 'public');
                array_push($images, $name);
            }
            $validated['images'] = json_encode($images);
        }
        $record->update($validated);
        $response = ['code' => 200, 'message' => "Updated $this->model"];

        return response($response);
    }

    public function delete($id)
    {
        $record = Model::find($id);
        try {
            $images = json_decode($record->images);
            foreach ($images as $image) {
                Storage::disk('s3')->delete("properties/images/$image");
            }
            $record->delete();

            $response = [
                'code' => 200,
                'message' => "Deleted $this->model"
            ];
        } catch (\Exception $e) {
            $response = [
                'code' => 500,
                'message' => $e->getMessage(),
            ];
        }

        return response()->json($response);
    }
}
