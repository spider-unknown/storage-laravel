<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['location','way_long','car_id'];


    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

    public function car()
    {
        return $this->belongsTo('App\Car');
    }

}
