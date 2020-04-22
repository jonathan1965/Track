<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $fillable = ['topic', 'reminder_by', 'reminder_to', 'client','vehicle', 'status', 'due_date', 'odometer'];


    public function isDue(){
      
       if (Carbon::parse($this->due_date)->lte(now())){
           return true;
       }
       return false;
    }

}
