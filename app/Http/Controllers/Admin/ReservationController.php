<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    // view all reservation
    public function reservations()
    {
        $reservations = Reservation::with('user','provider')
        ->get();
        return view('dashboard.reservation.reservations',[
            'reservations' => $reservations
        ]);
    }
}
