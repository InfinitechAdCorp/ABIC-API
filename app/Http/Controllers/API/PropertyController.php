<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\Property as Model;

class PropertyController extends Controller
{
    public $model = "Property";

    public function getAll()
    {
        $records = Model::with(['user'])->get();

        $response = ['code' => 200, 'message' => "Fetched Properties", 'records' => $records];

        return response()->json($response);
    }

    public function get($id)
    {
        $record = Model::find($id);
        $response = ['code' => 200, "Fetched $this->model", 'record' => $record];
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
                'user_id' => 'required',
                'name' => 'required',
                'logo' => 'required|image',
                'slogan' => 'required',
                'description' => 'required',
                'location' => 'required',
                'min_price' => 'required|numeric|min:0',
                'max_price' => 'required|numeric|gte:min_price',
                'status' => 'required',
                'percent' => 'required|numeric|between:0,100',
                'images.*' => 'required|file',
            ]);

            $key = 'logo';
            if ($request->hasFile('logo')) {
                $name = Str::ulid() . "." . $request->file($key)->clientExtension();
                Storage::disk('s3')->put("properties/logos/$name", $request->file($key)->getContent(), 'public');
                $validated[$key] = $name;
            }

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
            'name' => 'required',
            'slogan' => 'required',
            'description' => 'required',
            'location' => 'required',
            'min_price' => 'required',
            'max_price' => 'required',
            'status' => 'required',
            'percent' => 'required',
        ]);

        $record = Model::find($validated['id']);
        $record->update($validated);
        $response = ['code' => 200, 'message' => "Updated $this->model"];

        return response($response);
    }

    public function delete($id)
    {
        $record = Model::find($id);

        try {
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
