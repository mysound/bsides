<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Count extends Model
{
	protected $fillable = ['view_count', 'cart_count', 'sold_count', 'watcher_count'];

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}
