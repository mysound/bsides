<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ganre extends Model
{
    protected $fillable = ['title', 'slug'];

    public function products()
    {
    	return $this->hasMany(Product::class);
    }
}
