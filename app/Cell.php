<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    protected $fillable = ['name','storage_id'];

    public function categories(){
        return $this->belongsToMany('App\Category','cell_category','cell_id','category_id');

    }
    public function products(){
        return $this->hasMany('App\Product');
    }

}
