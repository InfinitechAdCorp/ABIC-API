<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Uploadable;
use Sentiment\Analyzer;

use App\Models\Property;
use App\Models\Testimonial;
use App\Models\Seminar;
use App\Models\Partner;
use App\Models\Career;
use App\Models\Application;
use App\Models\Inquiry;
use App\Models\Submission;
use App\Models\PropertySubmission;

class MainController extends Controller
{
    use Uploadable;

    public function propertiesGetAll()
    {
        $records = Property::orderBy('badge')->get();
        $code = 200;
        $response = ['message' => "Fetched Properties", 'records' => $records];
        return response()->json($response, $code);
    }

    public function testimonialsGetAll() {
        $analyzer = new Analyzer();
        $records = [];

        $testimonials = Testimonial::with('user')->orderBy('updated_at', 'desc')->get();

        foreach ($testimonials as $testimonial) {
            $sentiment = $analyzer->getSentiment($testimonial->message);
            if ($sentiment['compound'] > 0.5) {
                array_push($records, $testimonial);
            }
        }

        $code = 200;
        $response = ['message' => "Fetched Testimonials", 'records' => $records];
        return response()->json($response, $code);
    }

    public function seminarsGetAll() {
        $records = Seminar::orderBy('updated_at', 'desc')->get();
        $code = 200;
        $response = ['message' => "Fetched Seminars", 'records' => $records];
        return response()->json($response, $code);
    }

    public function partnersGetAll() {
        $records = Partner::all();
        $code = 200;
        $response = ['message' => "Fetched Partners", 'records' => $records];
        return response()->json($response, $code);
    }

    public function careersGetAll() {
       $records = Career::with('applications')->orderBy('updated_at', 'desc')->get();
        foreach ($records as $record) {
            $record['available_slots'] = $record->slots - count($record->applications);
        }
        $code = 200;
        $response = ['message' => "Fetched Careers", 'records' => $records];
        return response()->json($response, $code);
    }

    public function submitApplication(Request $request)
    {
        $validated = $request->validate([
            'career_id' => 'required|exists:careers,id',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'resume' => 'required',
        ]);

        $parent = Career::with('applications')->where('id', $validated['career_id'])->first();
        $availableSlots = $parent->slots - count($parent->applications);

        if ($availableSlots <= 0) {
            $code = 200;
            $response = ['message' => "Out Of Slots"];
        } else {
            $key = 'resume';
            if ($request->hasFile($key)) {
                $validated[$key] = $this->upload($request->file($key), "careers/applications");
            }

            $record = Application::create($validated);
            $code = 201;
            $response = ['message' => "Submitted Application", 'record' => $record];
        }

        return response()->json($response, $code);
    }

    public function submitInquiry(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'type' => 'required',
            'properties' => 'nullable',
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
