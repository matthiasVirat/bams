<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'description', 'price'];

    public function discount(){
        return $this->hasOne('App\discount');
    }


   public function category(){
        return $this->belongsTo('App\Prd_category', 'prd_category_id' , 'id');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order')->withPivot('quantity');
    }

}
