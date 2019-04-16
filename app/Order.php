<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;



    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product')->withPivot('quantity');
    }

    public function adrDelivery()
    {
        return $this->belongsTo('App\Adress', 'adr_delivery', 'id');
    }

    public function adrInvoice()
    {
        return $this->belongsTo('App\Adress', 'adr_invoice', 'id');
    }



}