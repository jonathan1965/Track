<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehicle;
use App\Client;

class VehiclesController extends Controller
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
        $vehicles = Vehicle::all();
        $clients = Client::all();
        return view('vehicles.index')->with('vehicles', $vehicles)->with('clients', $clients);
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
            'type' => 'required',
            'plate' => 'bail|required|unique:vehicles|max:255',
            'make' => 'required',
            'file' => 'image|nullable|max:1999', 

        ]);
        
        Vehicle::create($request->all());
        return back()->with('success', 'Vehicle saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'type' => 'required',
            'plate' => 'bail|required|unique:vehicles|max:255',
            'make' => 'required',
            'file' => 'image|nullable|max:1999', 

        ]);
        //
        // echo "done";
        $vehicle = Vehicle::findOrFail($request->vehicle_id);
        $vehicle->update($request->all());
       
        return back()->with('success', 'edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
         $vehicle = Vehicle::findOrFail($request->vehicle_id);
         $vehicle->delete();
         return back()->with('success', 'Deleted successfully');
       //

    }
}
