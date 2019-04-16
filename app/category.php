<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    public $timestamps = false;
    protected $table='prd_categories';


    public function product(){
        return $this->hasMany('App/product','prd_category_id', 'id'   );

    }
}
