<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Inquiry;

class AgentController extends Controller
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
