<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carpool extends Model
{
    protected  $primaryKey = 'rideId';
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
