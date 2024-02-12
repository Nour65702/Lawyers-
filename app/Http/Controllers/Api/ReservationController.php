<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Reservation;
class ReservationController extends Controller
{
    public function reserve(Request $request)
    {
        $data = [
            'provider_id' => $request->provider_id,
            'user_id' => $request->user_id,
            'time'    => $request->time,
            'date'    => $request->date,
            'status'  => '0'
        ];
        Reservation::create($data);
        $not = [
            'sender' => $request->user_id,
            'reciver' => $request->provider_id,
            'notification' => 'A reservation request has been sent to you'
        ];
        Notification::create($not);
        return $this->response('added successfully wait until accepting');
    }

    // provider reservations
    
    public function provider_reservation(Request $request)
    {
        $reservations = Reservation::with('user','provider')
        ->where('provider_id',$request->provider_id)
        ->get();
        return $this->response($reservations);
    }

    // accept reservation 
    public function accept_reservation(Request $request)
    {
        $reservation = Reservation::find($request->reservation_id);
        $reservation->status = '1';
        if($request->time){
            $reservation->time = $request->time;
            $reservation->date = $request->date;
        }        
        $reservation->save();
        $not = [
            'sender' => $reservation->provider_id,
            'reciver' => $reservation->user_id,
            'notification' => 'A reservation request has been sent to you'
        ];
        Notification::create($not);
        return $this->response('accept successfully');
    }
    // 
    public function response($data){
        return response()->json([
            'details' => $data
        ]);
    }
}
