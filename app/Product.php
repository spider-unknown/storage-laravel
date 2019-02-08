<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'image','name' , 'code' ,'width','height','depth','category_id',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function types(){
        return $this->belongsToMany('App\Type');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
