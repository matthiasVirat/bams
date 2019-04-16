<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class discount extends Model
{
    public $timestamps = false;
    public function productlist(){
        return $this->hasMany('App\Productlist');
    }
}
