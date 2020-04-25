<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Entry;
use App\Client;
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
        $client = $user->client;
        $expiredReminders= Reminder::where('due_date', '<', today())->where('client_id',$client->id)->count();
        $remindersDueToday = Reminder::where('due_date','=',today())->where('client_id',$client->id)->count();
        $remindersDueThisWeek = Reminder::where('due_date','>',today()->startOfDay())->where('due_date', '<', today()->addWeek())->where('client_id',$client->id)->count();
        $remindersDueThisMonth = Reminder::where('due_date','>',today()->startOfDay())->where('due_date', '<', today()->addMonth())->where('client_id',$client->id)->count();
        
        $client = auth()->user()->client;
        //
        if(auth()->user()->usertype == 'admin'){
            $entries = Entry::all();
        }else{
            $client = Client::where('id',$client->id)->first();
            $entries = $client->entries;
            // $entries = DB::table('entries')->where('client',$client)->get();
        }

        $user = auth()->user()->usertype;
        if($user== 'other'){
            return view('other');
        }
        else{
            return view('home',compact('expiredReminders','remindersDueToday','remindersDueThisWeek','remindersDueThisMonth'))->with('entries',$entries);
        }
        
        
        
    }




}
