<?php

namespace App\Http\Controllers;

use DB;
use App\Task;
use App\Client;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
       $client = auth()->user()->client;
       $usertype = auth()->user()->usertype;
    if( $usertype == 'admin')
    {     
   
        $clients = client::all();
        $vehicles = Vehicle::all();
    }
    if($usertype == 'user')
    {
        $user = Auth::user();
        $clients = $user->client;
        $vehicles = Vehicle::where('client_id',$clients->id)->get();
    }
    if( $usertype == 'other')
    {
        return view('other');
    }
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
        $usertype = auth()->user()->usertype;
        $this->validate($request, [
            'type' => 'required',
            'plate' => 'bail|required|unique:vehicles|max:255',
            'make' => 'required',
            'file' => 'image|nullable|max:1999', 

        ]);
        if($usertype == 'admin') 
        {
            $client = Client::where('name',$request->get('client'))->first();
            $vechicle = Vehicle::create([
                'client_id' => $client->id,
                'type' => $request->type,
                'make' => $request->make,
                'model' => $request->model,
                'plate' => $request->plate
            ]);
        }
        if($usertype == 'user')
        {
            $client = Client::where('name',$request->client)->first();
            $vechicle = Vehicle::create([
                'client_id' => $client->id,
                'type' => $request->type,
                'make' => $request->make,
                'model' => $request->model,
                'plate' => $request->plate
            ]);
        }
        
        // Vehicle::create($request->all());
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
        $vehicle = Vehicle::find($id);
        $tasks = $vehicle->tasks;
        return view('vehicles.show')->with('tasks', $tasks);
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
