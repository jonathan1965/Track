<?php

namespace App\Http\Controllers;

use DB;
use App\Task;
use App\User;
use App\Entry;
use App\Client;
use App\Service;
use App\Vehicle;
use App\Reminder;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $user = auth()->user();
        $userType = auth()->user()->usertype;
        $services = Service::all()->count();
        if($userType == 'user')
        {
        $client = $user->client;
        $expiredReminders= Reminder::where('due_date', '<', today())->where('client_id',$client->id)->count();
        $remindersDueToday = Reminder::where('due_date','=',today())->where('client_id',$client->id)->count();
        $remindersDueThisWeek = Reminder::where('due_date','>',today()->startOfDay())->where('due_date', '<', today()->addWeek())->where('client_id',$client->id)->count();
        $remindersDueThisMonth = Reminder::where('due_date','>',today()->startOfDay())->where('due_date', '<', today()->addMonth())->where('client_id',$client->id)->count();
        $entries = $client->entries;
        $vehicles = $client->vehicles->count();
        $tasks = $client->tasks->count();
        $clients = $user->client->count();
        }
        if($userType == 'admin')
        {
        $expiredReminders= Reminder::where('due_date', '<', today())->count();
        $remindersDueToday = Reminder::where('due_date','=',today())->count();
        $remindersDueThisWeek = Reminder::where('due_date','>',today()->startOfDay())->where('due_date', '<', today()->addWeek())->count();
        $remindersDueThisMonth = Reminder::where('due_date','>',today()->startOfDay())->where('due_date', '<', today()->addMonth())->count();
        $entries = Entry::all();
        $vehicle = Vehicle::all();
        $vehicles = Vehicle::all()->count();
        $clients = Client::all()->count();
        $tasks = Task::all()->count();
        }
        if($userType == 'other'){
            return view('other');
        }
        return view('home',compact('expiredReminders','remindersDueToday','remindersDueThisWeek','remindersDueThisMonth','vehicles','services','userType','clients','tasks'))
        ->with('entries',$entries);
        
    }




}
