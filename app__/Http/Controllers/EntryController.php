<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Entry;
use Illuminate\Http\Request;
use App\Client;
use App\Service;
use App\Vehicle;
use App\Location;
use DB; 
class EntryController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $entries = Entry::all();
        $clients = Client::all();
        $services = Service::all();
        $vehicles = Vehicle::all();
        $locations = Location::all();
        return view('entries.index')->with('entries', $entries)->with('clients', $clients)->with('services', $services)->with('vehicles', $vehicles)->with('locations', $locations);
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
        $this->validate($request, [
            // 'service' => 'required',
            // 'vehicle' => 'required',
            // 'comments' => 'required',
            'image'=>'image|nullable|max:1999'

            ]);

        // hundle file upload
        if ($request->hasFile('image'))
        {
            //get filename with extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // get just file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extention
            $extension = $request->file('image')->getClientOriginalExtension();
            //FILE NAME 
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //fupload Image
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
            
                // $uploadedImage = $request->file('image');
                // $imageName = time() . '.' . $image->getClientOriginalExtension();
                // $destinationPath = public_path('public/images');
                // $uploadedImage->move($destinationPath, $imageName);
                // $image->imagePath = $destinationPath . $imageName;
        }

        if($request->hasFile('file'))
        {
            
            $filenameWithExt1=$request->file('file')->getClientOriginalName();
            $filename1=pathinfo  ($filenameWithExt1,PATHINFO_FILENAME);
            $extension1=$request->file('file')->getClientOriginalExtension();
            $fileNameToStore1= $filename1.'_'.time().'.'. $extension1;
            $path1= $request->file('file')->storeAs('/public/files',$fileNameToStore1);

        }
        // Entry::create($request->all());
        // return back()->with('success', 'Saved Successfully');
        $entry = new Entry();
        $entry->image=$fileNameToStore;
        $entry->file= $fileNameToStore1;
        $entry->client = $request->input('client');
        $entry->vehicle = $request->input('vehicle');  
        $entry->service = $request->input('service'); 
        $entry->location= $request->input('location');
        $entry->comments= $request->input('comments');
        $entry->driver=$request->input('driver'); 
        $entry->odometer_reading= $request->input('odometer_reading');
        $entry->fuel=$request->input('fuel');  
        $entry->service_date= $request->input('service_date');         
        $entry->amount = $request->input('amount');
        $entry->invoice_number=$request->input('invoice_number');
        $entry->driver=$request->input('driver');
        $entry->save();
        return back()->with('success', 'Saved Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function show(Entry $entry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function edit(Entry $entry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'service' => 'required',
            'vehicle' => 'required',

        ]);
        
        $entry = Entry::findOrFail($request->entry_id);
        $entry->update($request->all());
       
        return back()->with('success', 'edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
         $entry = Entry::findOrFail($request->entry_id);
         $entry->delete();
         return back()->with('success', 'Deleted successfully');
       
    }

    public function image($id)
    {
       $image= Entry::find($id);
       return back();
       

    }
}
