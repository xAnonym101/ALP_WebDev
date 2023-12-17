<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
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
        $categories = DB::table('categories')->get();
        if ($categories->isEmpty()) {
            return redirect()->route('homepage');
        } else {
            return view('admin.create_product', compact('categories'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $product = Product::create([
        Product::create([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'discount_percent' => 0,
            'best_seller' => '0',
        ]);

        // $variantsData = $request->input('variants');

        // if ($variantsData) {
        //     // Create an array to store variants
        //     $variants = [];

        //     // Loop through each variant data
        //     foreach ($variantsData as $variantData) {
        //         // Add the variant data to the array
        //         $variants[] = [
        //             'variant_name' => $variantData['variant_name'],
        //             'color' => $variantData['color'],
        //             'description' => $variantData['description'],
        //             // Add other fields as needed
        //         ];
        //     }

        //     $product->variant()->createMany($variants);
        // }

        return redirect()->route('homepage');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = DB::table('categories')->get();
        $toEdit = Product::where('product_id', $id)->first();
        return view('admin.update_product', compact('categories', 'toEdit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $product->update([
        //     'product_name' => $request->input('product_name'),
        //     'description' => $request->input('description'),
        //     'price' => $request->input('price'),
        //     'category_id' => $request->input('category_id'),
        //     'discount_percent' => $request->input('discount_percent'),
        //     'best_seller' => $request->input('best_seller'),
        // ]);

        DB::table('products')->where('product_id', $id)->update([
            'product_name' => $request->input('product_name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'category_id' => $request->input('category_id'),
            'discount_percent' => $request->input('discount_percent'),
            'best_seller' => $request->input('best_seller'),
            'final_price' => $request->price - ($request->price * ($request->discount_percent / 100)),
        ]);
        return redirect()->route('homepage');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('products')->where('product_id', $id)->delete();
        return redirect()->route('homepage');
    }

    public function productsList()
    {
        $products = DB::table('products')->get();
        return view('admin.admin_page', compact('products'));
    }
}
