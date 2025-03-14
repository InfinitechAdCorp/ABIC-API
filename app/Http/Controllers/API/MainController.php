<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Uploadable;
use Sentiment\Analyzer;

use App\Models\Property;
use App\Models\Testimonial;
use App\Models\Partner;
use App\Models\Career;
use App\Models\Application;
use App\Models\Inquiry;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\Article;
use App\Models\Infrastructure;
use App\Models\Owner;
use App\Models\User;

class MainController extends Controller
{
    use Uploadable;

    public function allUsersgetAll()
    {
        $relations = ['profile', 'certificates', 'inquiries', 'schedules', 'testimonials', 'videos'];
        $record = User::with($relations)->get();
        $code = 200;
        $response = ['message' => "Fetched Users", 'record' => $record];
        return response()->json($response, $code);
    }

    public function propertiesGetAll()
    {
        $records = Property::where('published', 1)->orderBy('status')->get();
        $code = 200;
        $response = ['message' => "Fetched Properties", 'records' => $records];
        return response()->json($response, $code);
    }

    public function propertiesGet($id)
    {
        $record = Property::with('owner')->where('id', $id)->first();
        if ($record) {
            $code = 200;
            $response = ['message' => "Fetched Property", 'record' => $record];
        } else {
            $code = 404;
            $response = ['message' => "Property Not Found"];
        }
        return response()->json($response, $code);
    }

    public function usersGetAll()
    {
        $relations = ['profile', 'certificates', 'inquiries', 'schedules', 'testimonials', 'videos'];
        $records = User::with($relations)->where('type', 'Agent')->orderBy('updated_at', 'desc')->get();
        $code = 200;
        $response = ['message' => "Fetched Users", 'records' => $records];
        return response()->json($response, $code);
    }

    public function testimonialsGetAll()
    {
        $analyzer = new Analyzer();
        $records = [];

        $testimonials = Testimonial::with('user')->orderBy('updated_at', 'desc')->get();

        foreach ($testimonials as $testimonial) {
            $sentiment = $analyzer->getSentiment($testimonial->message);
            if ($sentiment['compound'] > 0.3) {
                array_push($records, $testimonial);
            }
        }

        $code = 200;
        $response = ['message' => "Fetched Testimonials", 'records' => $records];
        return response()->json($response, $code);
    }

    public function partnersGetAll()
    {
        $records = Partner::all();
        $code = 200;
        $response = ['message' => "Fetched Partners", 'records' => $records];
        return response()->json($response, $code);
    }

    public function careersGetAll()
    {
        $records = Career::with('applications')->orderBy('updated_at', 'desc')->get();
        foreach ($records as $record) {
            $record['available_slots'] = $record->slots - count($record->applications);
        }
        $code = 200;
        $response = ['message' => "Fetched Careers", 'records' => $records];
        return response()->json($response, $code);
    }

    public function servicesGetAll()
    {
        $records = Service::orderBy('updated_at', 'desc')->get();
        $code = 200;
        $response = ['message' => "Fetched Services", 'records' => $records];
        return response()->json($response, $code);
    }

    public function servicesGet($id)
    {
        $record = Service::find($id);
        if ($record) {
            $code = 200;
            $response = ['message' => "Fetched Service", 'record' => $record];
        } else {
            $code = 404;
            $response = ['message' => "Service Not Found"];
        }
        return response()->json($response, $code);
    }

    public function articlesGetAll()
    {
        $records = Article::get()->groupBy('type');
        $code = 200;
        $response = ['message' => "Fetched Articles", 'records' => $records];
        return response()->json($response, $code);
    }

    public function infrastructuresGetAll()
    {
        $records = Infrastructure::orderBy('updated_at', 'desc')->get();
        $code = 200;
        $response = ['message' => "Fetched Infrastruces", 'records' => $records];
        return response()->json($response, $code);
    }

    public function filterProperties(Request $request)
    {
        $where = [];

        $location = $request->query('location');
        if ($location) {
            $location = str_replace('+', ' ', $location);
            array_push($where, ['location', 'LIKE', "%$location%"]);
        }

        $min_price = $request->query('min_price');
        if ($min_price) {
            array_push($where, ['price', '>=', $min_price]);
        }

        $max_price = $request->query('max_price');
        if ($max_price) {
            array_push($where, ['price', '<=', $max_price]);
        }

        $unit_type = $request->query('unit_type');
        if ($unit_type) {
            $unit_type = str_replace('+', ' ', $unit_type);
            array_push($where, ['unit_type', $unit_type]);
        }

        $records = Property::where($where)->get();
        $code = 200;
        $response = ['message' => "Filtered Properties", 'records' => $records];
        return response()->json($response, $code);
    }

    public function filterLocation($id)
    {
        $property = Property::find($id);
        if ($property) {
            $locations = ["Pasig", "Makati", "Quezon", "Las Pinas"];
            foreach ($locations as $location) {
                $count = Property::where([['location', 'LIKE', "%$location%"], ['id', '!=', $id]])->get()->count();
                if ($count > 0) {
                    $matchingLocation = $location;
                }
            }

            $records = Property::where([['location', 'LIKE', "%$matchingLocation%"], ['id', '!=', $id]])->get();
            $code = 200;
            $response = ['message' => "Filtered Properties", 'records' => $records];
        } else {
            $code = 404;
            $response = ['message' => "Property Not Found"];
        }
        return response()->json($response, $code);
    }

    public function submitProperty(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'phone' => 'required|max:255',
            'type' => 'required|max:255',

            'name' => 'required|max:255',
            'location' => 'required|max:255',
            'price' => 'required|decimal:0,2',
            'area' => 'required|decimal:0,2',
            'parking' => 'required|boolean',
            'description' => 'required',

            'unit_number' => 'required|max:255',
            'unit_type' => 'required|max:255',
            'unit_status' => 'required|max:255',

            'sale_type' => 'required|max:255',
            'title' => 'required|max:255',
            'payment' => 'required|max:255',
            'turnover' => 'required|max:255',
            'terms' => 'required|max:255',

            'status' => 'required|max:255',
            'badge' => 'nullable|max:255',
            'published' => 'required|boolean',

            'amenities' => 'required|array',
            'images' => 'required',
        ]);

        $owner = Owner::create($validated);

        $validated['owner_id'] = $owner->id;

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
                array_push($images, $this->upload($image, "properties/images"));
            }
            $validated[$key] = json_encode($images);
        }

        $record = Property::create($validated);
        $record = Property::with('owner')->where('id', $record->id)->first();
        $code = 201;
        $response = [
            'message' => "Submitted Property",
            'record' => $record,
        ];
        return response()->json($response, $code);
    }

    public function submitSchedule(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'phone' => 'required|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'type' => 'required|max:255',
            'properties' => 'required|max:255',
            'message' => 'required',
            'status' => 'required|max:255',
        ]);

        $record = Schedule::create($validated);
        $code = 201;
        $response = [
            'message' => "Submitted Schedule",
            'record' => $record,
        ];
        return response()->json($response, $code);
    }

    public function submitInquiry(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'phone' => 'required|max:255',
            'type' => 'required|max:255',
            'properties' => 'nullable|max:255',
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

    public function submitApplication(Request $request)
    {
        $validated = $request->validate([
            'career_id' => 'required|exists:careers,id',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
            'resume' => 'required',
        ]);

        $key = 'resume';
        if ($request->hasFile($key)) {
            $validated[$key] = $this->upload($request->file($key), "careers/applications");
        }

        $record = Application::create($validated);
        $code = 201;
        $response = ['message' => "Submitted Application", 'record' => $record];
        return response()->json($response, $code);
    }
}
