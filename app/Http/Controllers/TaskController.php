<?php

namespace App\Http\Controllers;

use DB;
use App\Task;
use App\User;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user = auth()->user();
        $client = $user->client;
        $vehicles = $client->vehicles;
        $users = User::all();
        $clientUsers = DB::table('users')->where('client', $client);
        $tasks = $client->tasks;
        $usertype = auth()->user()->usertype;
         if($usertype == 'admin'){
            return view('task.index')->with('tasks',$tasks)->with('users',$users)->with('vehicles',$vehicles);
        }elseif($usertype == 'user'){
            return view('task.index')->with('tasks',$tasks)->with('clientUsers',$clientUsers)->with('vehicles',$vehicles)->with('users',$users);
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
        $this->validate($request, [
            'task' => 'required',
            'vehicles' => 'required',
           ]);
           $user = Auth::user();
           $client = $user->client;
           $vehicle = Vehicle::where('plate',$request->input('vehicles'))->first();
           $tasks = new Task();
        
           $tasks->task = $request->input('task');
           $tasks->requested_by = $request->input('requested_by');  
           $tasks->requested_to = $request->input('requested_to'); 
           $tasks->due_date= $request->input('due_date');
           $tasks->closed_date= $request->input('closed_date');
           $tasks->vehicle_id = $vehicle->id;
           $tasks->client_id = $client->id;
           $tasks->status=$request->input('status'); 
           $tasks->save();
        return back()->with('success', 'Saved Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
      $this->validate($request,[
          'task'=>'required',

          
      ]);

      $tasks = Task::findOrFail($request->task_id);
      $tasks->update($request->all());
      return back()->with('success','edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $tasks = Task::findOrFail($request->task_id);
        $tasks->delete();
        return back()->with('success', 'Deleted successfully');
    }
}
