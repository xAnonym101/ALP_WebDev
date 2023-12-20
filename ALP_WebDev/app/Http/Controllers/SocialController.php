<?php

namespace App\Http\Controllers;

use App\Models\Social;
use App\Http\Requests\StoreSocialRequest;
use App\Http\Requests\UpdateSocialRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SocialController extends Controller
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
        return view('admin.create_social');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // dd($request->file('socialmedia_icon'));
        $validator = Validator::make($request->all(), [
            'socialmedia_name' => 'required|unique:socials',
        ]);

        // dd($validator);
        if ($validator->fails()) {
            return redirect()->route('createSocial')
                ->withErrors($validator)
                ->withInput();
        }

        $imageFile = $request->file('socialmedia_icon');
        $hashedFilename = $imageFile->hashName();
        $imageFile->storeAs('images', $hashedFilename, 'public');

        // dd($request->all());
        Social::create([
            'socialmedia_name' => $request->socialmedia_name,
            'socialmedia_link' => $request->socialmedia_link,
            'socialmedia_icon' => $hashedFilename,
            'user_id' => 1, // Assuming a default user ID for this example
        ]);

        return redirect()->route('homepage');
    }


    /**
     * Display the specified resource.
     */
    public function show(Social $social)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $social = DB::table('socials')->where('social_id', $id)->first();
        return view('admin.edit_social', compact('social'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->file('socialmedia_icon'));
        // dd($request->all());
        $imageFile = $request->file('socialmedia_icon');
        $hashedFilename = $imageFile->hashName();
        $imageFile->storeAs('images', $hashedFilename, 'public');

        DB::table('socials')->where('social_id', $id)->update([
            'socialmedia_name' => $request->socialmedia_name,
            'socialmedia_link' => $request->socialmedia_link,
            'socialmedia_icon' => $hashedFilename,
        ]);

        return redirect()->route('homepage');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('socials')->where('social_id', $id)->delete();
        return redirect()->route('homepage');
    }
}
