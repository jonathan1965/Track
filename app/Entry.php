<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    //
    protected $fillable = ['client_id', 'service', 'location', 'vehicle_id', 'driver', 'odometer_reading', 'fuel', 'amount', 'service_date', 'file', 'comments', 'invoice_number', 'image'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
