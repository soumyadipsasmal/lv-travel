<?php
namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function home()
    {
        $title = 'Home - Lv Travle';
        $date = date('Y-m-d');
        $tourdata = Tour::leftjoin('categories', 'categories.id', '=', 'tours.cat_id')
        ->where(['tours.del_flag' => 1, 'tours.tour_status' => 1])
        ->WhereDate('tours.tour_start', '>', $date)
        ->select('tours.*', 'categories.catname')->latest()->paginate(6);
        $catdata = Category::where(['del_flag' => 1])->latest()->paginate(5);
        return view('front.home', compact('title', 'tourdata', 'catdata'));
    }
    public function tourdetails($id)
    {
        $title = 'Tour Details - Lv Travle';
        $tourdata = Tour::leftjoin('categories', 'categories.id', '=', 'tours.cat_id')->where(['tours.id' => $id])->select('tours.*', 'categories.catname')->get();
        return view('front.tourdetails', compact('title', 'tourdata'));
    }
    public function catdetails($slug)
    {
        $title = 'Category Details - Lv Travle';
        $tourdata = Tour::join('categories', 'categories.id', '=', 'tours.cat_id')->where([
            'tours.del_flag' => 1,
            'categories.catslug' => $slug
        ])->select('tours.*', 'categories.catname', 'categories.catslug')->latest()->get();
        $catdata = Category::where(['catslug' => $slug])->first();
        return view('front.category', compact('title', 'tourdata', 'catdata'));
    }
    public function tourSearch(Request $request)
    {
        $request->validate([
            'tourdate' => 'required'
        ]);
        $catid = $request->cat;
        $date = $request->tourdate;
        $catdata = Category::where(['id' => $catid])->first();
        $tourdata = array();
        if ($catid != '' && $date != '') {
            $tourdata = Tour::leftjoin('categories', 'categories.id', '=', 'tours.cat_id')->where([
                'tours.del_flag' => 1,
                'categories.id' => $catid,
                'tours.tour_start' => date('Y-m-d', strtotime($date))
            ])->select('tours.*', 'categories.catname', 'categories.catslug')->latest()->get();
        }
        $title = 'Tour Search - Lv Travle';
        return view('front.tour_search', compact('title', 'date', 'catdata', 'tourdata'));
    }
}
