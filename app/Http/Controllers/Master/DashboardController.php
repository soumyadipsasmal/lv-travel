<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $tittle = 'Master DashBoard - LV Travel';
        return view('master.dashboard', compact('tittle'));
    }
    public function userProfile()
    {
        $tittle = 'Master Profile - LV Travel';
        return view('master.Profile', compact('tittle'));
    }
    public function profileUpdate(Request $request)
    {
        //validation //
        $request->validate([
            'name' => 'required',
            'profile' => 'nullable|mimes:png,jpg,JPEG,PNG|max:1024'
        ]);
        //profile image upload//
        $profile = Auth::user()->profile;
        if ($request->hasFile('profile')) {
            // // Get filename with the extension
            $filenameWithExt = $request->file('profile')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('profile')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('profile')->storeAs('public/profile', $fileNameToStore);
            $profile = 'profile/' . $fileNameToStore;
        }
        //upadte data
        $result = DB::table('users')
            ->where('id', Auth::user()->id)
            ->update([
                'name' => ucwords($request->name),
                'profile' =>  $profile
            ]);

        if ($result) {
            return redirect()->route('admindashboard')->with(['success' => 'Profile Succesfully Updated']);
        } else {
            return redirect()->back()->with(['error' => 'Profile Not Updated! Please Try Again']);
        }
    }
}
