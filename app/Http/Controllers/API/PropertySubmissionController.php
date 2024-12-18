<?php

namespace App\Http\Controllers\API;

use App\Models\PropertySubmission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PropertySubmissionController extends Controller

{
    public $model = "PropertySubmission";

    public function getAll()
    {
        $submissions = PropertySubmission::all();
        $response = ['code' => 200, 'message' => 'Fetched Property Submissions', 'records' => $submissions];
        return response($response);
    }

    public function get($id)
    {
        $submission = PropertySubmission::find($id);
        if ($submission) {
            $response = ['code' => 200, 'message' => 'Fetched Property Submission', 'record' => $submission];
        } else {
            $response = ['code' => 404, 'message' => 'Property Submission Not Found'];
        }
        return response($response);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'full_name' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email',
            'name' => 'required|string',
            'unit_type' => 'required|string',
            'location' => 'required|string',
            'min_price' => 'required|numeric|min:0',
            'max_price' => 'required|numeric|gte:min_price',
            'status' => 'required|string',
            'images.*' => 'required|file'
        ]);

        $propertySubmission = PropertySubmission::create([
            'user_id' => $request->user_id,
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'name' => $request->name,
            'unit_type' => $request->unit_type,
            'location' => $request->location,
            'min_price' => $request->min_price,
            'max_price' => $request->max_price,
            'status' => $request->status,
            'images' => $request->images
        ]);

        $response = ['code' => 201, 'message' => 'Property Submission Created', 'record' => $propertySubmission];
        return response($response);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id' => 'required|exists:property_submissions,id',
            'user_id' => 'required|exists:users,id',
            'full_name' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email',
            'name' => 'required|string',
            'unit_type' => 'required|string',
            'location' => 'required|string',
            'min_price' => 'required|numeric|min:0',
            'max_price' => 'required|numeric|gte:min_price',
            'status' => 'required|string',
            'images.*' => 'required|file'
        ]);

        $propertySubmission = PropertySubmission::findOrFail($id);

        $propertySubmission->update([
            'user_id' => $request->user_id,
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'name' => $request->name,
            'unit_type' => $request->unit_type,
            'location' => $request->location,
            'min_price' => $request->min_price,
            'max_price' => $request->max_price,
            'status' => $request->status,
            'images' => $request->images
        ]);

        $response = ['code' => 200, 'message' => 'Property Submission Updated', 'record' => $propertySubmission];
        return response($response);
    }

    public function delete($id)
    {
        $propertySubmission = PropertySubmission::findOrFail($id);
        $propertySubmission->delete();

        $response = ['code' => 200, 'message' => 'Property Submission Deleted Successfully'];
        return response($response);
    }
}
