<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Uploadable;
use Sentiment\Analyzer;

use App\Models\User;
use App\Models\Inquiry;
use App\Models\Schedule;

class AgentController extends Controller
{
    use Uploadable;

    public function getAgent(Request $request) {
        $user_id = $request->header('user-id');
        $analyzer = new Analyzer();
        $testimonials = [];

        $relations = ['profile', 'certificates', 'inquiries', 'schedules', 'testimonials', 'videos'];
        $record = User::with($relations)->where('id', $user_id)->first();

        foreach ($record['testimonials'] as $testimonial) {
            $sentiment = $analyzer->getSentiment($testimonial->message);
            if ($sentiment['compound'] > 0.5) {
                array_push($testimonials, $testimonial);
            }
        }

        unset($record['testimonials']);
        $record['testimonials'] = $testimonials;

        $code = 200;
        $response = ['message' => "Fetched User", 'record' => $record];
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

        $validated['user_id'] = $request->header('user-id');

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

        $validated['user_id'] = $request->header('user-id');

        $record = Inquiry::create($validated);
        $code = 201;
        $response = [
            'message' => "Submitted Inquiry",
            'record' => $record,
        ];
        return response()->json($response, $code);
    }
}
