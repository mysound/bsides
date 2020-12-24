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

    public function deleteItem($id)
    {
        $this->total = $this->total - $this->products()->find($id)->pivot->price;
        $this->subtotal = $this->subtotal - $this->products()->find($id)->pivot->price;
        $this->save();
        
        $this->products()->detach($id);
    }
}
