<?php

namespace App\Http\Controllers;

use DB;
use App\Task;
use App\User;
use App\Client;
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
      
        $usertype = auth()->user()->usertype;
         if($usertype == 'admin')
         {
           
            $users = User::all();
            $vehicles = Vehicle::all();
            $tasks = Task::all();

            // foreach($tasks as $task)

            // {
            //     return $task->vehicle;
            // }
            
        }
        if($usertype == 'user')
        {
            $user = auth()->user();
            $client = $user->client;
            $vehicles = $client->vehicles;
            $users = User::all();
            $tasks = $client->tasks;
        }
        if($usertype == 'other')
        {
            return view('other');
        }
        return view('task.index')->with('tasks',$tasks)->with('users',$users)->with('vehicles',$vehicles);
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
            'task' => 'required',
            'vehicles' => 'required',
           ]);
           if($usertype == 'admin')
           {
            
            $client = Client::where('name',$request->get('clients'))->first();
            $vehicle = Vehicle::where('plate',$request->get('vehicles'))->first();
            $tasks = new Task();
            
            $tasks->vehicle_id = $vehicle->id;
            $tasks->client_id = $client->id;
            $tasks->task = $request->input('task');
            $tasks->requested_by = $request->input('requested_by');  
            $tasks->requested_to = $request->input('requested_to'); 
            $tasks->due_date= $request->input('due_date');
            $tasks->closed_date= $request->input('closed_date');
            $tasks->status=$request->input('status'); 
            $tasks->save();
           }
           if($usertype == 'user')
           {
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
           }
           
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
