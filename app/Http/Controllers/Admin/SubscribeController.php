<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscribeUser;
use JWTAuth;
    use Tymon\JWTAuth\Exceptions\JWTException;
class SubscribeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function subscribes()
    {
        // $token   = JWTAuth::authenticate($request->token);
        $subscribes = SubscribeUser::with('user','package')->where('status',1)->get();
        $sum = SubscribeUser::with('user','package')->sum('price');
        return view('dashboard.subscribe.subscribe',[
            'subscribes' => $subscribes,
            'sum' => $sum
        ]);
    }

    public function SubscribeRequest()
    {
        $subscribes = SubscribeUser::with('user','package')->where('status',0)->get();
        return view('dashboard.subscribe.subscribe-request',[
            'subscribes' => $subscribes,
        ]);
    }

    public function acceptSubscribe($sub_id)
    {
        $subscribe = SubscribeUser::where('id',$sub_id)->update(['status' => 1]);
        return redirect()->back();
    }
}
