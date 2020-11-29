<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function products()
    {
    	return $this->belongsToMany('App\Product')->withPivot('quantity', 'price');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function address()
    {
    	return $this->belongsTo('App\Address');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }
}
