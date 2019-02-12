<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['location','way_long','car_id','product_id'];


    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function car()
    {
        return $this->belongsTo('App\Car');
    }

}
