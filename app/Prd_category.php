<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prd_category extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $table = 'prd_categories'; //designe la table qu'il utilise

    public function product()
    {
        return $this->hasMany('App\Product', 'prd_category_id', 'id');
//    }

    }

}


