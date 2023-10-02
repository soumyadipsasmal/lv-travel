<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $tittle = 'User Dashboard';
        $bookingdata = Booking::join('booking_details', 'bookings.id', '=', 'booking_details.bookingid')
            ->join('tours', 'tours.id', '=', 'booking_details.tourid')
            ->select('bookings.*', 'booking_details.tourprice', 'tours.tour_name', 'tours.tour_price', 'tours.tour_image', 'tours.tour_start', 'tours.tour_duration')
            ->where('bookings.coustomerid', '=', Auth::user()->id)
            ->get();
        return view('front.user_dashboard', compact('tittle', 'bookingdata'));
    }
}
