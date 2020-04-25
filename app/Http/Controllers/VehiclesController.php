<?php

namespace App\Http\Controllers;

use DB;
use App\Task;
use App\User;
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
        // $vehicles = DB::table('vehicles')->leftJoin('tasks', 'vehicles.id', '=', 'tasks.vehicle_id')->select('vehicles.*', 'tasks.status')->where('vehicles.client', $client)->get();
        $user = User::where('client_id',Auth::user()->client_id)->first();
        $clients = $user->client;
       
        $vehicles = Vehicle::where('client_id',$clients->id)->get();
        $usertype = auth()->user()->usertype;
         if($usertype == 'admin' || $usertype == 'user'){     
            
            return view('vehicles.index')->with('vehicles', $vehicles)->with('clients', $clients);
        }
        else{
            return view('other');
        }
        
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
        $client = Client::where('name',$request->client)->first();
        $vechicle = Vehicle::create([
            'client_id' => $client->id,
            'type' => $request->type,
            'make' => $request->make,
            'model' => $request->model,
            'plate' => $request->plate
        ]);
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
        return view('vehicles.show')->with('vehicle', $vehicle)->with('tasks', $vehicle->tasks);
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
