<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Property as Model;
use App\Traits\Uploadable;

class PropertyController extends Controller
{
    use Uploadable;

    public $model = "Property";

    public function getAll()
    {
        $user = Auth::user();

        if ($user->type == "Agent") {
            $records = Model::where('user_id', $user->id)->get();
        } else if ($user->type == "Admin") {
            $records = Model::with(['user'])->get();
        }

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

            if ($request->hasFile('logo')) {
                $validated['logo'] = $this->upload($request->file('logo'), 'uploads/properties/logos');
            }

            if ($request->hasFile('images')) {
                $images = [];
                foreach ($request->file('images') as $image) {
                    array_push($images, $this->upload($image, 'uploads/properties/images'));
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
            if ($record->logo) {
                $file = public_path("uploads/properties/logos/$record->logo");
                if (file_exists($file)) unlink($file);
            }

            if ($record->images) {
                $images = json_decode($record->images, true);
                foreach ($images as $image) {
                    $file = public_path("uploads/properties/images/$image");
                    if (file_exists($file)) unlink($file);
                }
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
