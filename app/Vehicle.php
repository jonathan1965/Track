<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    //
    protected $fillable = ['client_id', 'type', 'make', 'model', 'plate'];

    public function tasks()
    {
 
        return $this->hasMany(Task::class);

    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }
}
