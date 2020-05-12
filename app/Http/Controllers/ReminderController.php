<?php

namespace App\Http\Controllers;

use App\User;
use App\Client;
use App\Vehicle;
use App\Reminder;
use Illuminate\Http\Request;


class ReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usertype = auth()->user()->usertype;
     if($usertype == 'user')
        {
            $user = auth()->user();
            $client = $user->client;
            $vehicles = $client->vehicles;
            $users= User::all();
            $reminders= $client->reminders;
        }
    if($usertype == 'admin')
        {
            $users = User::all();
            $client = client::all();
            $vehicles = vehicle::all();
            $reminders= Reminder::orderBy('id', 'desc')->get();
        }
        if($usertype == 'other'){
            return view('other');
        }
        return view('reminder.index')->with('reminders',$reminders)->with('vehicles', $vehicles)->with('client', $client)->with('users', $users);

       
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
        $usertype = auth()->user()->usertype;
        $this->validate($request, [
            'topic' => 'required',
            'due_date' => 'required',
            'reminder_to' => 'required'
        ]);
        
        if($usertype == 'admin'){
            $user =user::all();
            $client = Client::where('name',$request->get('client'))->first();
            $vehicle = Vehicle::where('plate',$request->get('vehicle'))->first();
            Reminder::create([
                'client_id' => $client->id,
                'vehicle_id' => $vehicle->id,
                'topic' => $request->topic,
                'reminder_by' => $request->reminder_by,
                'reminder_to' => $request->reminder_to,
                'status' => $request->status,
                'due_date' => $request->due_date,
                'odometer' => $request->odometer
            ]); 
        }

        
        if($usertype == 'user'){
            $user = auth()->user();
        $client = $user->client;
        $vehicle = Vehicle::where('plate',$request->vehicle)->first();
        Reminder::create([
            'client_id' => $client->id,
            'vehicle_id' => $vehicle->id,
            'topic' => $request->topic,
            'reminder_by' => $request->reminder_by,
            'reminder_to' => $request->reminder_to,
            'status' => $request->status,
            'due_date' => $request->due_date,
            'odometer' => $request->odometer
        ]); 
        }
       
        return back()->with('success','reminder created');
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
    public function update(Request $request)
    {
        $this->validate($request, [
            'topic' => 'required',
            'due_date' => 'required',
            'status' => 'required',
        ]);
        

        $reminder = Reminder::findOrFail($request->rem_id);
        $client = Client::where('name',$request->client)->first();
        $vehicle = Vehicle::where('plate',$request->vehicle)->first();
        $reminder->update([
            'client_id' => $client->id,
            'vehicle_id' => $vehicle->id,
            'topic' => $request->topic,
            'reminder_by' => $request->reminder_by,
            'reminder_to' => $request->reminder_to,
            'status' => $request->status,
            'due_date' => $request->due_date,
            'odometer' => $request->odometer
        ]);
       
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
        
        $reminder = Reminder::findOrFail($request->rem_id);
        $reminder->delete();
        return back()->with('success', 'Deleted successfully');
    }
      public function getVehicles($client)    
    {
        $client = Client::where('name',$client)->first();
        $vehicles = $client->vehicles;
        $vehicles = $vehicles->pluck("client_id","plate");
          
        return json_encode($vehicles);
        
    }
}
