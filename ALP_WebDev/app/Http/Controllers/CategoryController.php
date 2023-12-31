<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create_category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|unique:categories'
        ]);

        if ($validator->fails()) {
            return redirect()->route('createCategory')
                ->withErrors($validator)
                ->withInput();
        } else {

            Category::create([
                'category_name' => $request->category_name,
            ]);
            return redirect()->route('homepage');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = DB::table('categories')->where('category_id', $id)->first();
        return view('admin.edit_category', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::table('categories')->where('category_id', $id)->update([
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('homepage');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('categories')->where('category_id', $id)->delete();

        return redirect()->route('homepage');
    }
}
