<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Symfony\Component\VarDumper\Cloner\Data;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tittle = 'Category - LV Travel';
        $catdata = Category::where(['del_flag' => '1'])->latest()->paginate(1);
        return view('master.category', compact('tittle', 'catdata'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'catname' => 'required|unique:categories',
            'catslug' => 'required|unique:categories',
            'catimage' => 'nullable|mimes:png,jpg,jpeg|max:4024'
        ]);
        //insert data //
        $userid = Auth::user()->id;
        $userprofile = Auth::user()->role;
        $ip = $_SERVER['REMOTE_ADDR'];
        $catimage = "";
        if ($request->hasFile('catimage')) {
            // // Get filename with the extension
            $filenameWithExt = $request->file('catimage')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('catimage')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('catimage')->storeAs('public/categories', $fileNameToStore);
            $catimage = 'categories/' . $fileNameToStore;
        }




        $result = Category::create([
            'catname' => ucwords($request->catname),
            'catslug' => strtolower(str_replace(' ', '_', $request->catslug)),
            'catimage' => $catimage,
            'created_by' => $userid,
            'created_by_role' => $userprofile,
            'created_by_ip' => $ip,
        ]);
        if ($result) {
            return redirect()->back()->with(['success' => 'Category Successfully Added']);
        } else {
            return redirect()->back()->with(['Error' => 'Category Not Addded, Please Try Again!!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $tittle = 'Edit-Category - LV Travel';
        $catdata = Category::where(['del_flag' => '1'])->latest()->paginate(1);
        return view('master.category', compact('tittle', 'catdata', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'catname' => 'required',
            'catslug' => 'required',
            'catimage' => 'nullable|mimes:png,jpg,jpeg|max:4024'
        ]);
        if ($request->catname != $category->catname) {
            $request->validate([
                'catname' => 'unique:categories'
            ]);
        }
        if ($request->catslug != $category->catslug) {
            $request->validate([
                'catslug' => 'unique:categories'
            ]);
        }

        //image //
        $catimage = $category->catimage;
        if ($request->hasFile('catimage')) {
            // // Get filename with the extension
            $filenameWithExt = $request->file('catimage')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('catimage')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('catimage')->storeAs('public/categories', $fileNameToStore);
            $catimage = 'categories/' . $fileNameToStore;
        }
        $userid = Auth::user()->id;
        $userprofile = Auth::user()->role;
        $ip = $_SERVER['REMOTE_ADDR'];
        $date = date("Y-m-d H:i:s");
        $update = Category::where(['id' => $category->id])->update([
            'catname' => ucwords($request->catname),
            'catslug' => strtolower(str_replace(' ', '_', $request->catslug)),
            'catimage' => $catimage,
            'updated_by' => $userid,
            'updated_by_role' => $userprofile,
            'updated_by_ip' => $ip,
            'deleted_at' => $date
        ]);

        if ($update) {
            return redirect()->route('category.index')->with(['success' => 'Category Successfully Updated']);
        } else {
            return redirect()->back()->with(['error' => 'Category Not Updated, Please Try Again!!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $userid = Auth::user()->id;
        $userprofile = Auth::user()->role;
        $ip = $_SERVER['REMOTE_ADDR'];
        $date = date("Y-m-d H:i:s");
        $result = Category::where(['id' => $category->id])->update([
            'del_flag' => 0,
            'updated_by' => $userid,
            'updated_by_role' => $userprofile,
            'updated_by_ip' => $ip,
            'deleted_at' => $date
        ]);

        if ($result) {
            return redirect()->route('category.index')->with(['success' => 'Category Successfully Deleted']);
        } else {
            return redirect()->back()->with(['error' => 'Category Not Deleted, Please Try Again!!']);
        }
    }
}
