<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function notifications()
    {
        $nots = Notification::with('reciver_user','sender_user')->get();
        // dd($nots);
        return view('dashboard.notifications',[
            'nots' => $nots
        ]);
    }
}
