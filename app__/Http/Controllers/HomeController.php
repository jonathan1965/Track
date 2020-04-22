<?php

namespace App\Http\Controllers;

use App\User;
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
        
        $expiredReminders= Reminder::where('due_date', '<', today())->count();
        $remindersDueToday = Reminder::where('due_date','>',today()->startOfDay())->where('due_date', '<', today()->addDay())->count();
        $remindersDueThisWeek = Reminder::where('due_date','>',today()->startOfDay())->where('due_date', '<', today()->addWeek())->count();
        $remindersDueThisMonth = Reminder::where('due_date','>',today()->startOfDay())->where('due_date', '<', today()->addMonth())->count();
        
        return view('home',compact('expiredReminders','remindersDueToday','remindersDueThisWeek','remindersDueThisMonth'));

        $user = auth()->user()->usertype;
        if($user== 'other'){
            return view('other');
        }
        else{
            return view('home');
        }
        
        
        
    }




}
