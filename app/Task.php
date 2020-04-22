<?php

namespace App;

use App\Vehicle;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['task','status','requested_by','requested_to','due_date','closed_date',];

    public function vehicle(){

        return $this->belongsTo(Vehicle::class);

    }
}
