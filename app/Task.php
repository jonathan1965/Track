<?php

namespace App;

use App\Vehicle;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['client_id','vehicle_id','task','status','requested_by','requested_to','due_date','closed_date',];

    public function vehicle(){

        return $this->belongsTo(Vehicle::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
