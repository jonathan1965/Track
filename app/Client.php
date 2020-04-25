<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function Entries()
    {
        return $this->hasMany(Entry::class);
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
