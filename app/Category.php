<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at',];

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function cells(){
        return $this->belongsToMany('App\Cell');
    }

    public function cars(){

        return $this->belongsToMany('App\Car');
    }
}
