<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BookingController;
use App\Models\BookingDetails;
use App\Models\Booking;
use App\Models\customer;
use App\Models\PaymentModel;
use App\Models\Tour;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;

class OrderController extends Controller
{
    public function index($id)
    {
        $title = 'Order Details - Lv Travle';
        $bookingdata = Booking::leftjoin('users', 'bookings.coustomerid', '=', 'users.id')->where(['bookings.bid' => $id, 'bookings.del_flag' => 1])->select('bookings.*', 'users.name', 'users.email', 'users.baseid')->first();
        $tourdata = BookingDetails::join('tours', 'booking_details.tourid', '=', 'tours.id')->where(['booking_details.bookingid' =>  $bookingdata->id, 'booking_details.del_flag' => 1])->select('booking_details.*', 'tours.*')->first();
        $cdata = Customer::leftjoin('users', 'users.baseid', '=', 'customers.id')->where(['users.id' => $bookingdata->coustomerid])->select('customers.*')->first();
        $result = Booking::Where(['id' => $id])->update([
            'status' => 1
        ]);
        return view('front.order_details', compact('bookingdata', 'tourdata', 'cdata', 'title'));
    }

    public function invoice($id)
    {
        $decrypted = Crypt::decryptString($id);
        // dd($decrypted);
        $title = 'Order Confirmation - Lv Travle';
        $bookingdata = Booking::leftjoin('users', 'bookings.coustomerid', '=', 'users.id')->where(['bookings.bid' => $decrypted, 'bookings.del_flag' => 1, 'bookings.status' => 2])->select('bookings.*', 'users.name', 'users.email')->first();
        $paymentdetails = PaymentModel::leftjoin('bookings', 'bookings.bid', '=', 'payments.orderid')->where(['bookings.bid' => $decrypted, 'bookings.del_flag' => 1, 'bookings.status' => 2])->select('payments.*')->first();
        $tourdata = BookingDetails::leftjoin('bookings', 'booking_details.bookingid', '=', 'bookings.id')->join('tours', 'booking_details.tourid', '=', 'tours.id')->where(['bookings.bid' => $decrypted, 'bookings.del_flag' => 1, 'bookings.status' => 2])->select('tours.*')->first();
        return view('front.invoice', compact('title', 'bookingdata', 'paymentdetails', 'tourdata'));
    }
}
