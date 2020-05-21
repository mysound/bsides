<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Str;

class Category extends Model
{

	protected $fillable = ['title', 'slug', 'parent_id'];

	public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($this->title);
    }

    public function children()
    {
    	return $this->hasMany('App\Category', 'parent_id');
    }

    public function products()
    {
    	return $this->hasMany(Product::class);
    }
}
