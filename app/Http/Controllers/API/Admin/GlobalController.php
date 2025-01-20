<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Property;

class GlobalController extends Controller
{
    public function propertiesGetAll()
    {
        $records = Property::all();
        $code = 200;
        $response = ['message' => "Fetched Properties", 'records' => $records];
        return response()->json($response, $code);
    }
}
