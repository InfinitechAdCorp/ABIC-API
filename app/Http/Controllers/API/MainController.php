<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Property;
use App\Models\Inquiry;
use App\Models\Submission;
use App\Models\PropertySubmission;

class MainController extends Controller
{
    public function getAllProperties()
    {
        $records = Property::orderBy('badge')->get();
        $code = 200;
        $response = ['message' => "Fetched Properties", 'records' => $records];
        return response()->json($response, $code);
    }

    public function submitInquiry(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'type' => 'required',
            'message' => 'required',
        ]);

        $record = Inquiry::create($validated);
        $code = 201;
        $response = [
            'message' => "Submitted Inquiry",
            'record' => $record,
        ];
        return response()->json($response, $code);
    }

    public function oldSubmitProperty(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'property' => 'required',
            'type' => 'required',
            'location' => 'required',
            'price' => 'required|decimal:0,2',
            'area' => 'required|numeric',
            'parking' => 'required|boolean',
            'vacant' => 'nullable|boolean',
            'description' => 'required',
            'sale' => 'required',
            'badge' => 'required',
            'status' => 'required',
            'submit_status' => 'required',
            'unit_number' => 'nullable',
            'unit_type' => 'required',
            'unit_furnish' => 'required',
            'unit_floor' => 'nullable',
            'submitted_by' => 'nullable',
            'commission' => 'required|boolean',
            'terms' => 'nullable',
            'title' => 'nullable',
            'turnover' => 'nullable',
            'lease' => 'nullable',
            'amenities' => 'required|array',
            'images' => 'nullable',
        ]);

        $key = 'amenities';
        if ($request[$key]) {
            $amenities = [];
            foreach ($request[$key] as $amenity) {
                array_push($amenities, $amenity);
            }
            $validated[$key] = json_encode($amenities);
        }

        $key = 'images';
        if ($request[$key]) {
            $images = [];
            foreach ($request[$key] as $image) {
                array_push($images, $this->upload($image, "submissions"));
            }
            $validated[$key] = json_encode($images);
        }

        $record = Submission::create($validated);
        $code = 201;
        $response = [
            'message' => "Submitted Property",
            'record' => $record,
        ];
        return response()->json($response, $code);
    }

    public function submitProperty(Request $request)
    {
        $validated = $request->validate([
            'user_last' => 'nullable',
            'user_first' => 'nullable',
            'user_email' => 'nullable|email',
            'user_phone' => 'nullable',
            'sender_type' => 'nullable',
            'property_name' => 'nullable',
            'property_type' => 'nullable',
            'property_unit_status' => 'nullable',
            'property_price' => 'nullable|decimal:0,2',
            'property_area' => 'nullable|decimal:0,2',
            'property_number' => 'nullable',
            'property_parking' => 'nullable',
            'property_status' => 'nullable',
            'property_rent_terms' => 'nullable',
            'property_sale_type' => 'nullable',
            'property_sale_payment' => 'nullable',
            'property_sale_title' => 'nullable',
            'property_sale_turnover' => 'nullable',
            'property_description' => 'nullable',
            'property_amenities' => 'nullable|array',
            'images' => 'nullable',
        ]);

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
            $images = [];
            foreach ($request[$key] as $image) {
                array_push($images, $this->upload($image, "submissions/images"));
            }
            $validated[$key] = json_encode($images);
        }

        $record = PropertySubmission::create($validated);
        $code = 201;
        $response = [
            'message' => "Submitted Property",
            'record' => $record,
        ];
        return response()->json($response, $code);
    }
}
