<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{

    protected $fillable = ['name','price'];

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }


    public function cells(){
        return $this->belongsToMany('App\Cell');
    }


    public function cars(){

        return $this->belongsToMany('App\Car');
    }
}
