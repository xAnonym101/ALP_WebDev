<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Variant;
use App\Models\Image;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Client\Request as ClientRequest;
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
        $events = DB::table('events')->get();
        if ($categories->isEmpty()) {
            return redirect()->route('homepage');
        } else {
            return view('admin.create_product', compact('categories', 'events'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->file('image'));


        // $product = Product::create([
        //     // Product::create([
        //     'product_name' => $request->product_name,
        //     'description' => $request->description,
        //     'price' => $request->price,
        //     'link' =>$request->link,
        //     'category_id' => $request->category_id,
        //     'event_id' => $request->category_id,
        //     'discount_percent' => $request->discount_percent,
        //     'best_seller' => '0',
        //     'final_price' => $request->price - ($request->price * ($request->discount_percent / 100)),
        // ]);
        if ($request->event_id == 0) {
            $product = Product::create([
                // Product::create([
                'product_name' => $request->product_name,
                'description' => $request->description,
                'price' => $request->price,
                'link' =>$request->link,
                'category_id' => $request->category_id,
                'discount_percent' => $request->discount_percent,
                'best_seller' => '0',
                'final_price' => $request->price - ($request->price * ($request->discount_percent / 100)),
            ]);
        } else {
            $product = Product::create([
                // Product::create([
                'product_name' => $request->product_name,
                'description' => $request->description,
                'price' => $request->price,
                'link' =>$request->link,
                'category_id' => $request->category_id,
                'event_id' => $request->event_id,
                'discount_percent' => $request->discount_percent,
                'best_seller' => '0',
                'final_price' => $request->price - ($request->price * ($request->discount_percent / 100)),
            ]);
        }

        $images = [];
        $imageFile = $request->file('image');
        $hashedFilename = $imageFile->hashName();

        if ($request->file('image')) {
            // dd($request->file('image'));
            $imageFile->storeAs('images', $hashedFilename, ['disk' => 'public']);
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

                if ($request->input('event_id') == 0) {
                    DB::table('products')->where('product_id', $id)->update([
                        'product_name' => $request->input('product_name'),
                        'description' => $request->input('description'),
                        'event_id' => null,
                        'price' => $request->input('price'),
                        'link' =>$request->input('link'),
                        'category_id' => $request->input('category_id'),
                        'discount_percent' => $request->input('discount_percent'),
                        'best_seller' => $request->input('best_seller'),
                        'final_price' => $request->price - ($request->price * ($request->discount_percent / 100)),
                    ]);
                } else {
                    DB::table('products')->where('product_id', $id)->update([
                        'product_name' => $request->input('product_name'),
                        'description' => $request->input('description'),
                        'event_id' => $request->input('event_id'),
                        'price' => $request->input('price'),
                        'link' =>$request->input('link'),
                        'category_id' => $request->input('category_id'),
                        'discount_percent' => $request->input('discount_percent'),
                        'best_seller' => $request->input('best_seller'),
                        'final_price' => $request->price - ($request->price * ($request->discount_percent / 100)),
                    ]);
                }
            } else {
                DB::table('products')->where('product_id', $id)->update([
                    'product_name' => $request->input('product_name'),
                    'description' => $request->input('description'),
                    'price' => $request->input('price'),
                    'link' =>$request->input('link'),
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

    public function productsList(Request $request)
    {
        if ($request->has('search')) {
            $products = DB::table("products")->where('product_name', 'like', '%'.$request->search.'%')->orWhere('product_id', 'like', '%'.$request->search.'%')->paginate(15);
        } else {
            $products = DB::table("products")->paginate(15);
        }
        $categories = DB::table('categories')->paginate(3);
        $events = DB::table('events')->paginate(3);
        $phones = DB::table('phones')->paginate(3);
        $socials = DB::table('socials')->paginate(3);
        return view('admin.admin_page', compact('products', 'categories', 'events', 'phones', 'socials'));
    }

    public function allproducts(Request $request)
    {
        if ($request->has('search')) {
            $products = DB::table("products")->where('product_name', 'like', '%'.$request->search.'%')->orWhere('product_id', 'like', '%'.$request->search.'%')->paginate(15);
        } else {
            $products = DB::table("products")->paginate(15);
        }
        $categories = DB::table('categories')->paginate(3);
        $events = DB::table('events')->paginate(3);
        $phones = DB::table('phones')->paginate(3);
        $socials = DB::table('socials')->paginate(3);
        $images = DB::table('images')->get();
        $pagetitle = 'All Products';
        return view('all_products', compact('products', 'categories', 'events', 'phones', 'socials', 'images', 'pagetitle'));
    }


    public function home(Request $request)
    {
        if ($request->has('search')) {
            $products = DB::table("products")->where('product_name', 'like', '%'.$request->search.'%')->orWhere('product_id', 'like', '%'.$request->search.'%')->paginate(15);
        } else {
            $products = DB::table("products")->paginate(15);
        }
        $categories = DB::table('categories')->paginate(3);
        $events = DB::table('events')->paginate(3);
        $phones = DB::table('phones')->paginate(3);
        $socials = DB::table('socials')->paginate(3);
        $images = DB::table('images')->get();
        $pagetitle = 'Home';
        return view('home', compact('products', 'categories', 'events', 'phones', 'socials', 'images', 'pagetitle'));
    }


    public function newarrival(Request $request)
    {
        if ($request->has('search')) {
            $products = DB::table("products")->where('product_name', 'like', '%'.$request->search.'%')->orWhere('product_id', 'like', '%'.$request->search.'%')->paginate(15);
        } else {
            $products = DB::table("products")->paginate(15);
        }
        $categories = DB::table('categories')->paginate(3);
        $events = DB::table('events')->paginate(3);
        $phones = DB::table('phones')->paginate(3);
        $socials = DB::table('socials')->paginate(3);
        $images = DB::table('images')->get();
        $pagetitle = 'New Arrival';
        return view('new_arrival', compact('products', 'categories', 'events', 'phones', 'socials', 'images', 'pagetitle'));
    }

    public function bestseller(Request $request)
    {
        if ($request->has('search')) {
            $products = DB::table("products")->where('product_name', 'like', '%'.$request->search.'%')->orWhere('product_id', 'like', '%'.$request->search.'%')->paginate(15);
        } else {
            $products = DB::table("products")->paginate(15);
        }
        $categories = DB::table('categories')->paginate(3);
        $events = DB::table('events')->paginate(3);
        $phones = DB::table('phones')->paginate(3);
        $socials = DB::table('socials')->paginate(3);
        $images = DB::table('images')->get();
        $pagetitle = 'Best Seller';
        return view('best_seller', compact('products', 'categories', 'events', 'phones', 'socials', 'images', 'pagetitle'));
    }

    public function saleproduct(Request $request)
    {
        if ($request->has('search')) {
            $products = DB::table("products")->where('product_name', 'like', '%'.$request->search.'%')->orWhere('product_id', 'like', '%'.$request->search.'%')->paginate(15);
        } else {
            $products = DB::table("products")->paginate(15);
        }
        $categories = DB::table('categories')->paginate(3);
        $events = DB::table('events')->paginate(3);
        $phones = DB::table('phones')->paginate(3);
        $socials = DB::table('socials')->paginate(3);
        $images = DB::table('images')->get();
        $pagetitle = 'Sale';
        return view('sale', compact('products', 'categories', 'events', 'phones', 'socials', 'images', 'pagetitle'));
    }

    public function productdetail($product_id)
    {
        $products = DB::table("products")->where('product_id', $product_id)->first();
        $categories = DB::table('categories')->paginate(3);
        $events = DB::table('events')->paginate(3);
        $phones = DB::table('phones')->paginate(3);
        $socials = DB::table('socials')->paginate(3);
        $images = DB::table('images')->where("product_id", $product_id)->get();
        $pagetitle = 'Products {{$product_id}}';
        return view('products_details', compact('products', 'categories', 'events', 'phones', 'socials', 'images', 'pagetitle'));
    }


    public function deleteVariant($id)
    {
    }
}
