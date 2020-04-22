<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    //
    protected $fillable = ['client', 'service', 'location', 'vehicle', 'driver', 'odometer_reading', 'fuel', 'amount', 'service_date', 'file', 'comments', 'invoice_number', 'image'];
}
