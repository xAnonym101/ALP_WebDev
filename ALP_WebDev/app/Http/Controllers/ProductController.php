<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Variant;
use App\Models\Image;
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

        // dd($request->file('image'));


        $product = Product::create([
            // Product::create([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'discount_percent' => $request->discount_percent,
            'best_seller' => '0',
            'final_price' => $request->price - ($request->price * ($request->discount_percent / 100)),
        ]);

        $images = [];
        $imageFile = $request->file('image');
        $hashedFilename = $imageFile->hashName();

        if ($request->file('image')) {
            // dd($request->file('image'));
            $imageFile->storeAs('images', $hashedFilename, ['disk'=>'public'] );
            $images[] = [
                'image' => $hashedFilename,
            ];
        }

        $variants = [];

        for ($i = 1; $i <= $request->input('formCounter'); $i++) {
            $variantName = $request->input("variant_name{$i}");
            $color = $request->input("color{$i}");
            $description = $request->input("description{$i}");
            if ($variantName !== null || $color !== null || $description !== null) {
                $variants[] = [
                    'variant_name' => $variantName,
                    'color' => $color,
                    'description' => $description,
                ];
            }
        }

        $product->variants()->createMany($variants);
        // dd($images);
        $product->images()->createMany($images);

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
        $variants = Variant::where('product_id', $id)->get();
        $images = Image::where('product_id', $id)->get();
        $events = DB::table('events')->get();
        return view('admin.edit_product', compact('categories', 'toEdit', 'variants', 'images', 'events'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        // dd($request->file('image'));
        // dd($request->all());
        // dd($request->delete);

        if ($request->filled('product_name')) {
            if ($request->filled('event_id')) {
                DB::table('products')->where('product_id', $id)->update([
                    'product_name' => $request->input('product_name'),
                    'description' => $request->input('description'),
                    'event_id' => $request->input('event_id'),
                    'price' => $request->input('price'),
                    'category_id' => $request->input('category_id'),
                    'discount_percent' => $request->input('discount_percent'),
                    'best_seller' => $request->input('best_seller'),
                    'final_price' => $request->price - ($request->price * ($request->discount_percent / 100)),
                ]);
            } else {
                DB::table('products')->where('product_id', $id)->update([
                    'product_name' => $request->input('product_name'),
                    'description' => $request->input('description'),
                    'price' => $request->input('price'),
                    'category_id' => $request->input('category_id'),
                    'discount_percent' => $request->input('discount_percent'),
                    'best_seller' => $request->input('best_seller'),
                    'final_price' => $request->price - ($request->price * ($request->discount_percent / 100)),
                ]);
            }
        }
        if ($request->file('image')) {
            $imageFile = $request->file('image');
            $hashedFilename = $imageFile->hashName();
            $imageFile->storeAs('images', $hashedFilename, 'public');
            DB::table('images')->insert([
                'product_id' => $id,
                'image' => $hashedFilename,
            ]);
        }

        for ($i = 1; $i <= $request->input('formCounter') + 1; $i++) {
            $variantName = $request->input("variant_name{$i}");
            $color = $request->input("color{$i}");
            $description = $request->input("description{$i}");
            if ($variantName !== null || $color !== null || $description !== null) {
                if ($request->filled("variant_id{$i}")) {
                    $variant = DB::table('variants')->where('variant_id', $request->input("variant_id{$i}"))->update([
                        'variant_name' => $variantName,
                        'color' => $color,
                        'description' => $description,
                    ]);
                } else {
                    DB::table('variants')->insert([
                        'variant_name' => $variantName,
                        'color' => $color,
                        'description' => $description,
                        'product_id' => $id
                    ]);
                }
            }
        }

        if (isset($request->delete)) {
            DB::table('variants')->where('variant_id', $request->delete)->delete();
            return redirect()->back();
        }

        return redirect()->route('homepage');
    }

    public function destroy($id)
    {
        DB::table('products')->where('product_id', $id)->delete();
        return redirect()->route('homepage');
    }

    public function productsList()
    {
        $products = DB::table('products')->paginate(5);
        $categories = DB::table('categories')->get();
        $events = DB::table('events')->get();
        $phones = DB::table('phones')->get();
        $socials = DB::table('socials')->get();

        if ($categories->count() > 0 && $events->count() > 0) {
            return view('admin.admin_page', compact('products', 'categories', 'events', 'phones', 'socials'));
        } elseif ($categories->count() > 0) {
            return view('admin.admin_page', compact('products', 'categories', 'phones', 'socials'));
        } elseif ($events->count() > 0) {
            return view('admin.admin_page', compact('products', 'events', 'phones', 'socials'));
        } else {
            return view('admin.admin_page', compact('products', 'phones', 'socials'));
        }
    }

    public function allproducts()
    {
        $products = DB::table('products')->get();
        $categories = DB::table('categories')->get();
        $events = DB::table('events')->get();
        $phones = DB::table('phones')->get();
        $socials = DB::table('socials')->get();
        $images = DB::table('images')->get();

        if ($categories->count() > 0 && $events->count() > 0) {
            return view('all_products', compact('products', 'categories', 'events', 'phones', 'socials', 'images'),["pagetitle" => "all products"]);
        } elseif ($categories->count() > 0) {
            return view('all_products', compact('products', 'categories', 'phones', 'socials', 'images'),["pagetitle" => "all products"]);
        } elseif ($events->count() > 0) {
            return view('all_products', compact('products', 'events', 'phones', 'socials', 'images'),["pagetitle" => "all products"]);
        } else {
            return view('all_products', compact('products', 'phones', 'socials', 'images'),["pagetitle" => "all products"]);
        }
    }


    public function newarrival()
    {
        $products = DB::table('products')->get();
        $categories = DB::table('categories')->get();
        $events = DB::table('events')->get();
        $phones = DB::table('phones')->get();
        $socials = DB::table('socials')->get();
        $images = DB::table('images')->get();

        if ($categories->count() > 0 && $events->count() > 0) {
            return view('new_arrival', compact('products', 'categories', 'events', 'phones', 'socials', 'images'),["pagetitle" => "new arrivals"]);
        } elseif ($categories->count() > 0) {
            return view('new_arrival', compact('products', 'categories', 'phones', 'socials', 'images'),["pagetitle" => "new arrivals"]);
        } elseif ($events->count() > 0) {
            return view('new_arrival', compact('products', 'events', 'phones', 'socials', 'images'),["pagetitle" => "new arrivals"]);
        } else {
            return view('new_arrival', compact('products', 'phones', 'socials', 'images'),["pagetitle" => "new arrivals"]);
        }
    }

    public function bestseller()
    {
        $products = DB::table('products')->get();
        $categories = DB::table('categories')->get();
        $events = DB::table('events')->get();
        $phones = DB::table('phones')->get();
        $socials = DB::table('socials')->get();
        $images = DB::table('images')->get();

        if ($categories->count() > 0 && $events->count() > 0) {
            return view('best_seller', compact('products', 'categories', 'events', 'phones', 'socials', 'images'),["pagetitle" => "best seller"]);
        } elseif ($categories->count() > 0) {
            return view('best_seller', compact('products', 'categories', 'phones', 'socials', 'images'),["pagetitle" => "best seller"]);
        } elseif ($events->count() > 0) {
            return view('best_seller', compact('products', 'events', 'phones', 'socials', 'images'),["pagetitle" => "best seller"]);
        } else {
            return view('best_seller', compact('products', 'phones', 'socials', 'images'),["pagetitle" => "best seller"]);
        }
    }

    public function saleproduct()
    {
        $products = DB::table('products')->get();
        $categories = DB::table('categories')->get();
        $events = DB::table('events')->get();
        $phones = DB::table('phones')->get();
        $socials = DB::table('socials')->get();
        $images = DB::table('images')->get();

        if ($categories->count() > 0 && $events->count() > 0) {
            return view('sale', compact('products', 'categories', 'events', 'phones', 'socials', 'images'),["pagetitle" => "sale"]);
        } elseif ($categories->count() > 0) {
            return view('sale', compact('products', 'categories', 'phones', 'socials', 'images'),["pagetitle" => "sale"]);
        } elseif ($events->count() > 0) {
            return view('sale', compact('products', 'events', 'phones', 'socials', 'images'),["pagetitle" => "sale"]);
        } else {
            return view('sale', compact('products', 'phones', 'socials', 'images'),["pagetitle" => "sale"]);
        }
    }

    public function productdetail($product_id)
    {
        $products = DB::table("products")->where("product_id", $product_id)->first();
        $categories = DB::table('categories')->get();
        $events = DB::table('events')->get();
        $phones = DB::table('phones')->get();
        $socials = DB::table('socials')->get();
        $images = DB::table('images')->get();

        if ($categories->count() > 0 && $events->count() > 0) {
            return view('products_details', compact('products', 'categories', 'events', 'phones', 'socials', 'images'),["pagetitle" => "product detail"]);
        } elseif ($categories->count() > 0) {
            return view('products_details', compact('products', 'categories', 'phones', 'socials', 'images'),["pagetitle" => "product detail"]);
        } elseif ($events->count() > 0) {
            return view('products_details', compact('products', 'events', 'phones', 'socials', 'images'),["pagetitle" => "product detail"]);
        } else {
            return view('products_details', compact('products', 'phones', 'socials', 'images'),["pagetitle" => "product detail"]);
        }
    }


    public function deleteVariant($id)
    {
    }
}
