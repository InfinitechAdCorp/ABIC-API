<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Article;
use App\Models\Career;
use App\Models\Inquiry;
use App\Models\Item;
use App\Models\Partner;
use App\Models\Property;
use App\Models\Schedule;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function getCounts()
    {
        $article = Article::count();
        $career = Career::count();
        $inquiry = Inquiry::count();
        $item = Item::count();
        $partner = Partner::count();
        $property = Property::count();
        $testimonial = Testimonial::count();

        $records = [
            'articles' => $article,
            'careers' => $career,
            'inquiries' => $inquiry,
            'items' => $item,
            'partners' => $partner,
            'properties' => $property,
            'testimonials' => $testimonial,
        ];
        
        $code = 200;
        $response = ['message' => "Fetched Counts", 'records' => $records];
        return response()->json($response, $code);
    }
}