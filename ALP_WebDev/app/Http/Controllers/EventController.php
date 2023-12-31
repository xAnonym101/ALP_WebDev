<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
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
        return view('admin.create_event');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required|unique:events'
        ]);

        if ($validator->fails()) {
            return redirect()->route('createEvent')
                ->withErrors($validator)
                ->withInput();
        } else {

            Event::create([
                'event_name' => $request->event_name,
                'status' => '0',
            ]);
            return redirect()->route('homepage');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $event = DB::table('events')->where('event_id', $id)->first();
        return view('admin.edit_event', compact('event'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::table('events')->where('event_id', $id)->update([
            'event_name' => $request->event_name,
        ]);

        return redirect()->route('homepage');
    }

    public function enableDisable($id) {
        $event = DB::table('events')->where('event_id', $id)->first();

        if ($event) {
            $newStatus = $event->status == "0" ? "1" : "0";

            DB::table('events')->where('event_id', $id)->update([
                'status' => $newStatus,
            ]);
        }
        return redirect()->route('homepage');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('events')->where('event_id', $id)->delete();
        return redirect()->route('homepage');
    }

    public function eventChecker() {
        $events = DB::table('events')->get();

        foreach($events as $data) {
            $products = DB::table('products')->where('product_id', $data->event_id)->first();
            if ($products) {
                DB::table('events')->where('event_id', $data->event_id)->update([
                    'status' => "1",
                ]);
            } else {
                DB::table('events')->where('event_id', $data->event_id)->update([
                    'status' => "0",
                ]);
            }
        }
    }
}
