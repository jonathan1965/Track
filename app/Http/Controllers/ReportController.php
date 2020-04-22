<?php

namespace App\Http\Controllers;

use App\Task;
use App\Client;
use App\Service;
use App\Entry;
use App\Vehicle;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
         $tasks = Task::all();
         $vehicles = Vehicle::all();
        $clients = Client::all();
        $services = Service::all();
    return view('report.index')->with('clients', $clients)->with('vehicles',$vehicles)->with('services',$services);;
      //dd($entries = DB::table("entries")->get(["vehicle","created_at","service"]));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getVehicles(Request $request, $client)    
    {
        $vehicles = DB::table("vehicles")->where("client",$client);
        
        if($request->startingDate){
            $startingDate = Carbon::parse($request->startingDate);
            $vehicles = $vehicles->where('created_at', '>=',$startingDate);
        }

        if($request->endingDate){
            $endingDate = Carbon::parse($request->endingDate);
            $vehicles = $vehicles->where('created_at', '<=',$endingDate);
        }
        $vehicles = $vehicles->pluck("client","plate");
        return json_encode($vehicles);
    }
    public function getEntries(Request $request, $plate)    
    {
       
        $entries = DB::table("entries")->where("vehicle",$plate);

        if($request->startingDate){
            $startingDate = Carbon::parse($request->startingDate);
            $entries = $entries->where('created_at', '>=',$startingDate);
        }

        if($request->endingDate){
            $endingDate = Carbon::parse($request->endingDate);
            $entries = $entries->where('created_at', '<=',$endingDate);
        }

        $entries = $entries->pluck("vehicle","service");
            //dd($entries = DB::table("entries")->get(["vehicle","created_at","service"]));
        return json_encode($entries);
          
    }

    public function calculateSum(Request $request, $plate)    
    {
        $entries = DB::table('entries')
                ->select('service', DB::raw('sum(amount) as totalAmount'))
                ->where("vehicle",$plate);
                
                if($request->startingDate){
                    $startingDate = Carbon::parse($request->startingDate);
                    $entries = $entries->where('created_at', '>=',$startingDate);
                }
        
                if($request->endingDate){
                    $endingDate = Carbon::parse($request->endingDate);
                    $entries = $entries->where('created_at', '<=',$endingDate);
                }
             $entries = $entries->whereIn('service', $request->services)
                ->groupBy('service')
                ->get();
            return json_encode($entries);
    }

    // public function Chartjs()    
    // {
       
    //     $month = array('Jan', 'Feb', 'Mar', 'Apr', 'May');
    //     $data  = array(1, 2, 3, 4, 5);
    //     return json_encode($entries);
          
    // }
}