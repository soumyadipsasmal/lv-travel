<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Category;
use App\Models\User;
use App\Models\Customer;
use App\Models\Booking;
use App\Models\BookingDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    //
    public function bookings($id = null)
    {
        $title = 'Tour Booking - Lv Travle';
        $tourdata = Tour::leftjoin('categories', 'categories.id', '=', 'tours.cat_id', 'users')->where(['tours.id' => $id, 'tours.del_flag' => 1])->select('tours.*', 'categories.catname')->first();
        // $id = Auth::user()->id;
        if (empty($tourdata)) {
            return redirect()->back()->with(['Error' => "Your Selected Tour Is Not Avilable"]);
        }

        //uique booking id
        $prefix = "TV";
        $bid = IdGenerator::generate([
            'table' => 'bookings',
            'field' => 'bid',
            'length' => 8,
            'prefix' => $prefix
        ]);

        return view('front.bookings', compact('title', 'tourdata', 'bid'));
    }


    public function store(Request $request)
    {

        $tourdata = Tour::leftjoin('categories', 'categories.id', '=', 'tours.cat_id', 'users')->where(['tours.id' => $request->tourid, 'tours.del_flag' => 1])->select('tours.*', 'categories.catname')->first();
        if (empty($tourdata)) {
            return redirect()->back()->with(['Error' => "Your Selected Tour Is Not Avilable"]);
        }
        // dd($request->all());
        //validation
        $request->validate([
            'cname' => 'required',
            'cemail' => 'required|unique:customers',
            'cnumber' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:12|min:3|unique:customers',
            'caddress' => 'required',
            'tgroup' => 'required',
            'bid' => 'required|unique:bookings',
            // 'pnames' => 'required',
            // 'pcontact' => 'required'
        ]);

        //auth data
        $userid = "";
        $userrole = "";
        if (Auth::check()) {
            $userid = Auth::user()->id;
            $userrole = Auth::user()->role;
        }
        $ip =  $_SERVER['REMOTE_ADDR'];
        //customer registration and email sending
        if ($userid == '') {
            $result = Customer::Create([
                'cname' =>  ucwords($request->cname),
                'cemail' => $request->cemail,
                'cnumber' => $request->cnumber,
                'caddress' => $request->caddress,
                'tgroup' => $request->tgroup,
                'created_by_ip' => $ip
            ]);
            $ids = $result->id;
            if ($result) {
                // create user account
                $pass = Str::random(8);
                $user = User::Create([
                    'baseid' => $ids,
                    'name' => ucwords($request->cname),
                    'email' => $request->cemail,
                    'password' => Hash::make($pass),
                ]);
                $userid =  $user->id;
                //send login detials to customer by mail
                $data =  array(
                    'uemail' => $request->cemail,
                    'upassword' => $pass,
                    'clientname' => ucwords($request->cname),
                );
                $user = [
                    'to' => $request->cemail,
                ];
                Mail::send('email.useraccount', $data, function ($message) use ($user) {
                    $message->from('sunnydeolyo@gmail.com');
                    $message->to($user['to'], 'Tour and travel')->subject('Welcome to Tour and Travel - Your One Step Booking System');
                });
            }
        }
        // if (Auth::user()->id) {
        //     User::where(['id' => $userid])->update([
        //         'contact' => $request->cnumber,
        //         'address' => $request->caddress
        //     ]);
        // }
        //booking data insert
        $booking = Booking::Create([
            'bid' => $request->bid,
            'coustomerid' => $userid,
            'total' => $request->tgroup * @$tourdata->tour_price,
            'tgroup' => $request->tgroup,
            'pnames' => implode(",", $request->pnames),
            'pcontact' => implode(",", $request->pcontact),
            'created_by_ip' => $ip
        ]);
        if ($booking) {
            $bdata = BookingDetails::Create([
                'bookingid' => $booking->id,
                'tourid' => @$tourdata->id,
                'tourprice' => @$tourdata->tour_price,
                'created_by_ip' => $ip
            ]);
            if ($bdata) {
                return response()->json(['res' => 1, 'msg' => 'Booking Created. Please Pay and Confirm Your Booking']);
            }
            // return redirect()->route('order.details', $booking->bid)->with(['success' => "Booking Created. Please Pay and Confirm Your Booking"]);
        } else {
            return redirect()->back()->with(['Error' => "Booking Failed! Please Try Agian Later."]);
        }
    }



    //booking deatails & delete & edit bookings in master dashboard

    public function viewbookings()
    {
        $tittle = 'All Booking Details - Lv Travle';
        $bookingdata = Booking::leftjoin('users', 'bookings.coustomerid', '=', 'users.id')->leftjoin('booking_details', 'booking_details.bookingid', '=', 'bookings.id')->leftjoin('customers', 'users.baseid', '=', 'customers.id')->where(['bookings.del_flag' => 1])->select('bookings.*', 'users.name', 'users.email', 'users.address', 'users.contact', 'booking_details.tourid', 'customers.cnumber')->latest()->paginate(5);
        return view('master.view_bookings', compact('bookingdata', 'tittle'));
    }
    public function bookings_delete($id)
    {
        $result = Booking::where(['id' => $id])->update([
            'del_flag' => 0
        ]);
        if ($result) {
            return redirect()->route('master.viewbookings')->with(['success' => 'Booking Successfully Deleted']);
        } else {
            return redirect()->back()->with(['Error' => 'Booking Not Deleted, Please Try Again!!']);
        }
    }
    public function bookings_edit($id)
    {
        $tittle = 'Edit Booking Details - Lv Travle';
        $bookingdata = Booking::leftjoin('users', 'bookings.coustomerid', '=', 'users.id')->leftjoin('booking_details', 'booking_details.bookingid', '=', 'bookings.id')->leftjoin('customers', 'users.baseid', '=', 'customers.id')->where(['bookings.id' => $id, 'bookings.del_flag' => 1])->select('bookings.*', 'users.name', 'users.email', 'users.address', 'users.contact', 'booking_details.tourid', 'customers.cnumber')->first();
        return view('master.edit_bookings', compact('bookingdata', 'tittle'));
    }
    public function bookings_update(Request $request, $id)
    {
        $update = Booking::where(['id' => $id])->update([
            'status' => $request->status
        ]);
        if ($update) {
            return redirect()->route('master.viewbookings')->with(['success' => 'Booking Successfully Updated']);
        } else {
            return redirect()->back()->with(['Error' => 'Booking Not Updated, Please Try Again!!']);
        }
    }







    //ajax validation
    public function customerChecking(Request $request)
    {
        if ($request->ajax()) {
            $user = User::where([
                'email' => $request->cemail
            ])->first();
            $cnumber = Customer::where([
                'cnumber' => $request->cnumber
            ])->first();
            if ($user) {
                return response()->json(['res' => 1, 'msg' => 'User Email Is Already Exists,Plese Login!']);
            } else if ($cnumber) {
                return response()->json(['res' => 1, 'msg' => 'User Number Is Already Exists']);
            } else {
                return response()->json(['res' => 0, 'msg' => 'Please']);
            }
        } else {
            return response()->json(['res' => 0, 'msg' => 'Request in not Ajax Request']);
        }
    }
}
