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
        $name = auth()->user()->name;
        $vehicles = Vehicle::all();
        $clients = Client::all();
        $users= User::all();
        $reminders= Reminder::orderBy('id', 'desc')->where('reminder_to',$name)->get();
      
        $usertype = auth()->user()->usertype;
         if($usertype == 'admin' || $usertype == 'user'){
            return view('reminder.index')->with('reminders',$reminders)->with('vehicles', $vehicles)->with('clients', $clients)->with('users', $users);
        }
        else{
            return view('other');
        }
        return view('reminder.index')->with('reminders',$reminders)->with('vehicles', $vehicles)->with('clients', $clients)->with('users', $users);

       
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
        $this->validate($request, [
            'topic' => 'required',
            'due_date' => 'required',
            'reminder_to' => 'required'
        ]);
        Reminder::create($request->all());
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
        $reminder->update($request->all());
       
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
}
