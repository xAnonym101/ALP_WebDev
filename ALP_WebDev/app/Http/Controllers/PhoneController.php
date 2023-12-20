<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Http\Requests\StorePhoneRequest;
use App\Http\Requests\UpdatePhoneRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PhoneController extends Controller
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
        return view('admin.create_phone_number');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|unique:phones'
        ]);

        if ($validator->fails()) {
            return redirect()->route('createPhone')
                ->withErrors($validator)
                ->withInput();
        } else {

            Phone::create([
                'phone_number' => $request->phone_number,
                'user_id' => 1,
            ]);
            return redirect()->route('homepage');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Phone $phone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $phone = DB::table('phones')->where('phone_id', $id)->first();
        return view('admin.edit_phone_number', compact('phone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        DB::table('phones')->where('phone_id', $id)->update([
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('homepage');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('phones')->where('phone_id', $id)->delete();

        return redirect()->route('homepage');
    }
}
