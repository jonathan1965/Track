<?php

namespace App\Http\Controllers;

use App\User;
use App\Client;
use App\Vehicle;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::all();
        $clients = Client::all();
        $users = User::where('usertype','!=','admin')->get();
        $usertype = auth()->user()->usertype;
        
        if($usertype == 'admin'){
            return view('user.index')->with('users', $users)->with('clients',$clients);
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::create($request->all());
        return back()->with('success','User created');
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
    public function edit(Request $request,$id)
    {
        $users = User::findOrFail($id);
        return view('user.useredit')->with('users',$users);
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
       // dd($request->all());
       $user = user::findOrFail($request->user_id);
       $user->update($request->all());
       return back();

    // $user = user::find ($id);
    // $user ->update($request->all());
    // return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request )
    {
        // dd($request->users_id);

        $user = User::findOrFail($request->users_id);
        $user->delete();
        return back();
    }
}
