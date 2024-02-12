<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\User;
class ReviewController extends Controller
{
    public function addReview(Request $request){
        $data = [
            'user_id' => $request->user_id,
            'provider_id' => $request->provider_id,
            'rate' => $request->rate,
        ];
        Review::create($data);
        $rate = Review::where('provider_id',$request->provider_id)->avg('rate');
        $provider = User::find($request->provider_id)->update(['rate'=>$rate]);
        return response()->json([
            'details' => 'successfully'
        ]);
    }
}
