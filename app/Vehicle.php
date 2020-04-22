<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    //
    protected $fillable = ['client', 'type', 'make', 'model', 'plate'];

    public function tasks(){
 
        return $this->hasMany(Task::class);

    }
}
