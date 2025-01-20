<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Inquiry;
use App\Models\Submission;

class MainController extends Controller
{
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

    public function submitProperty(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
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
            'images' => 'required',
        ]);

        $key = 'images';
        if ($request[$key]) {
            $validated[$key] = [];
            foreach ($request[$key] as $image) {
                array_push($validated[$key], $this->upload($image, "submissions"));
            }
            $validated[$key] = json_encode($validated[$key]);
        }

        $key = 'amenities';
        if ($request[$key]) {
            $validated[$key] = [];
            foreach ($request[$key] as $amenity) {
                array_push($validated[$key], $amenity);
            }
            $validated[$key] = json_encode($validated[$key]);
        }

        $record = Submission::create($validated);
        $code = 201;
        $response = [
            'message' => "Submitted Property",
            'record' => $record,
        ];
        return response()->json($response, $code);
    }
}
