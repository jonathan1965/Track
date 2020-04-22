<?php

namespace App\Http\Controllers;

use App\Entry;
use Illuminate\Http\Request;
use App\Client;
use App\Service;
use App\Vehicle;
use App\Location;
use DB; 
class EntryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        //
        $entries = Entry::all();
        $clients = Client::all();
        $services = Service::all();
        $vehicles = Vehicle::all();
        $locations = Location::all();
        return view('entries.index')->with('entries', $entries)->with('clients', $clients)->with('services', $services)->with('vehicles', $vehicles)->with('locations', $locations);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'service' => 'required',
            'vehicle' => 'required'

        ]);
        Entry::create($request->all());
        return back()->with('success', 'Saved Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function show(Entry $entry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function edit(Entry $entry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'service' => 'required',
            'vehicle' => 'required',

        ]);
        //
        $entry = Entry::findOrFail($request->entry_id);
        $entry->update($request->all());
       
        return back()->with('success', 'edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
         $entry = Entry::findOrFail($request->entry_id);
         $entry->delete();
         return back()->with('success', 'Deleted successfully');
       
    }
}
