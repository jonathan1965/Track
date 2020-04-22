<?php

namespace App\Http\Controllers;

use App\User;
use App\Entry;
use App\Reminder;
use Illuminate\Http\Request;
use DB;
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
        $name = auth()->user()->name;
        $expiredReminders= Reminder::where('due_date', '<', today())->where('reminder_to',$name)->count();
        $remindersDueToday = Reminder::where('due_date','=',today())->where('reminder_to',$name)->count();
        $remindersDueThisWeek = Reminder::where('due_date','>',today()->startOfDay())->where('due_date', '<', today()->addWeek())->where('reminder_to',$name)->count();
        $remindersDueThisMonth = Reminder::where('due_date','>',today()->startOfDay())->where('due_date', '<', today()->addMonth())->where('reminder_to',$name)->count();
        
        $client = auth()->user()->client;
        //
        if(auth()->user()->usertype == 'admin'){
            $entries = Entry::all();
        }else{
            $entries = DB::table('entries')->where('client',$client)->get();
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
