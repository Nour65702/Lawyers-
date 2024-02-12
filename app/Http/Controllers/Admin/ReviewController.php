<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function reviews()
    {
        $reviews = Review::with('user','provider')->get();
        return view('dashboard.review.reviews',[
            'reviews' => $reviews
        ]);
    }
}
