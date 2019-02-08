<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['status','model','storage_id'];

    public function storage(){

        return $this->belongsTo('App/Storage');
    }

    public function types(){
        return $this->belongsToMany('App\Type');

    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
}