<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\Uploadable;

use App\Models\PropertySubmission as Model;
use App\Models\Property;

class SubmissionController extends Controller
{
    use Uploadable;

    public $model = "Submission";

    public $rules = [
        'user_last' => 'nullable|max:255',
        'user_first' => 'nullable|max:255',
        'user_email' => 'nullable|max:255|email',
        'user_phone' => 'nullable|max:255',
        'sender_type' => 'nullable|max:255',
        'property_name' => 'nullable|max:255',
        'property_type' => 'nullable|max:255',
        'property_unit_status' => 'nullable|max:255',
        'property_price' => 'nullable|decimal:0,2',
        'property_area' => 'nullable|decimal:0,2',
        'property_number' => 'nullable|max:255',
        'property_parking' => 'nullable|boolean',
        'property_status' => 'nullable|max:255',
        'property_rent_terms' => 'nullable|max:255',
        'property_sale_type' => 'nullable|max:255',
        'property_sale_payment' => 'nullable|max:255',
        'property_sale_title' => 'nullable|max:255',
        'property_sale_turnover' => 'nullable|max:255',
        'property_description' => 'nullable',
        'property_amenities' => 'nullable|array',
        'images' => 'nullable',
    ];

    public function getAll(Request $request)
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
        } else {
            $code = 404;
            $response = ['message' => "$this->model Not Found"];
        }
        return response()->json($response, $code);
    }

    public function create(Request $request)
    {
        $validated = $request->validate($this->rules);

        $key = 'property_amenities';
        if ($request[$key]) {
            $amenities = [];
            foreach ($request[$key] as $amenity) {
                array_push($validated[$key], $amenity);
            }
            $validated[$key] = json_encode($amenities);
        }

        $key = 'images';
        if ($request[$key]) {
            $images = [];
            foreach ($request[$key] as $image) {
                array_push($images, $this->upload($image, "submissions/images"));
            }
            $validated[$key] = json_encode($images);
        }

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
        $this->rules['id'] = 'required|exists:property_submissions,id';
        $validated = $request->validate($this->rules);

        $record = Model::find($validated['id']);

        $key = 'property_amenities';
        if ($request[$key]) {
            $amenities = [];
            foreach ($request[$key] as $amenity) {
                array_push($amenities, $amenity);
            }
            $validated[$key] = json_encode($amenities);
        }

        $key = 'images';
        if ($request[$key]) {
            $images = json_decode($record[$key]);
            foreach ($images as $image) {
                Storage::disk('s3')->delete("submissions/images/$image");
            }

            $images = [];
            foreach ($request[$key] as $image) {
                array_push($images, $this->upload($image, "submissions/images"));
            }
            $validated[$key] = json_encode($images);
        }

        $record->update($validated);
        $code = 200;
        $response = ['message' => "Updated $this->model"];
        return response()->json($response, $code);
    }

    public function delete($id)
    {
        $record = Model::find($id);
        if ($record) {
            $images = json_decode($record->images);
            foreach ($images as $image) {
                Storage::disk('s3')->delete("submissions/images/$image");
            }

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
