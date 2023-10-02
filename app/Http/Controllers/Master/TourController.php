<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TourController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tittle = 'All Tours - LV Travel';
        $tourdata = Tour::leftjoin('categories','categories.id' ,'=', 'tours.cat_id')->where(['tours.del_flag' => 1])->select('tours.*', 'categories.catname')->latest()->paginate(5);
        return view('master.all_tours', compact('tittle', 'tourdata'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tittle = 'Create A Tour - LV Travel';
        $catdata = Category::where(['del_flag' => 1])->latest()->get();
        return view('master.create_tour', compact('tittle', 'catdata'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cat_id' => 'required',
            'tour_name' => 'required|unique:tours',
            'tour_price' => 'required|numeric',
            'tour_start' => 'required|date',
            'tour_duration' => 'required',
            'tour_image' => 'required|mimes:png,jpg,jpeg|max:4024',
            'tour_group' => 'required',
            'tour_place' => 'required|unique:tours',
            'tour_description' => 'required',
        ]);
        $userid = Auth::user()->id;
        $userprofile = Auth::user()->role;
        $ip = $_SERVER['REMOTE_ADDR'];
        $tourimg = "";
        if ($request->hasFile('tour_image')) {
            // // Get filename with the extension
            $filenameWithExt = $request->file('tour_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('tour_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('tour_image')->storeAs('public/tours', $fileNameToStore);
            $tourimg = 'tours/' . $fileNameToStore;
        }
        $result = Tour::create([
            'cat_id' => $request->input('cat_id'),
            'tour_name' => ucwords($request->tour_name),
            'tour_price' => $request->tour_price,
            'tour_start' => $request->tour_start,
            'tour_duration' => $request->tour_duration,
            'tour_image' => $tourimg,
            'tour_group' => $request->tour_group,
            'tour_place' => ucwords($request->tour_place),
            'tour_description' => $request->tour_description,
            'created_by' => $userid,
            'created_by_role' => $userprofile,
            'created_by_ip' => $ip,
        ]);
        if ($result) {
            return redirect()->back()->with(['success' => 'Tour Successfully Added']);
        } else {
            return redirect()->back()->with(['Error' => 'Tour Not Addded, Please Try Again!!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function edit(Tour $tour)
    {
        $tittle = 'Edit a Tours - LV Travel';
        $tourdata = Tour::where(['del_flag' => 1])->latest()->paginate(5);
        $catdata = Category::where(['del_flag' => 1])->latest()->get();
        return view('master.create_tour', compact('tittle', 'tourdata', 'tour', 'catdata'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tour $tour)
    {
        $request->validate([
            'cat_id' => 'required',
            'tour_name' => 'required',
            'tour_price' => 'required|numeric',
            'tour_start' => 'required|date',
            'tour_duration' => 'required',
            // 'tour_image' => 'mimes:png,jpg,jpeg|max:4024',
            'tour_group' => 'required',
            'tour_place' => 'required',
            'tour_description' => 'required',
            'tour_status' => 'required',
        ]);
        if ($request->tour_name !=  $tour->tour_name) {
            $request->validate([
                'tour_name' => 'unique:tours',
            ]);
        }
        if ($request->tour_place !=  $tour->tour_place) {
            $request->validate([
                'tour_place' => 'unique:tours',

            ]);
        }
        if ($request->tour_image !=  $tour->tour_image) {
            $request->validate([
                'tour_image' => 'mimes:png,jpg,jpeg|max:4024',
            ]);
        }
        $tourimg = $tour->tour_image;
        $userid = Auth::user()->id;
        $userprofile = Auth::user()->role;
        $ip = $_SERVER['REMOTE_ADDR'];
        if ($request->hasFile('tour_image')) {
            // // Get filename with the extension
            $filenameWithExt = $request->file('tour_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('tour_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('tour_image')->storeAs('public/tours', $fileNameToStore);
            $tourimg = 'tours/' . $fileNameToStore;
        }
        $result = Tour::where(['id' => $tour->id])->update([
            'cat_id' => $request->input('cat_id'),
            'tour_name' => ucwords($request->tour_name),
            'tour_price' => $request->tour_price,
            'tour_start' => $request->tour_start,
            'tour_duration' => $request->tour_duration,
            'tour_status' => $request->tour_status,
            'tour_image' => $tourimg,
            'tour_group' => $request->tour_group,
            'tour_place' => ucwords($request->tour_place),
            'tour_description' => $request->tour_description,
            'updated_by' => $userid,
            'updated_by_role' => $userprofile,
        ]);
        if ($result) {
            return redirect()->route('tours.index')->with(['success' => 'Tour Successfully Updated']);
        } else {
            return redirect()->back()->with(['Error' => 'Tour Not Updated, Please Try Again!!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tour $tour)
    {
        $userid = Auth::user()->id;
        $userprofile = Auth::user()->role;
        $ip = $_SERVER['REMOTE_ADDR'];
        $date = date("Y-m-d H:i:s");

        $result = Tour::where(['id' => $tour->id])->update([
            'del_flag' => 0,
            'updated_by' => $userid,
            'updated_by_role' => $userprofile,
            'updated_by_ip' => $ip,
            'deleted_at' => $date
        ]);
        if ($result) {
            return redirect()->route('tours.index')->with(['success' => 'Category Successfully Deleted']);
        } else {
            return redirect()->back()->with(['error' => 'Category Not Deleted, Please Try Again!!']);
        }
    }
}
