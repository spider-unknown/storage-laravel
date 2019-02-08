<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    protected $fillable = ['name','address'];

    public function cells()
    {
        return $this->hasMany('App\Cell');
    }

    public function cars()
    {
        return $this->hasMany('App\Car');
    }
}
