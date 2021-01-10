<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image as ImageInt;
use Storage;
use Str;
use Purifier;

class Product extends Model
{

    protected $fillable = ['category_id', 'sku', 'name', 'title', 'brand_id', 'ganre_id',  'slug', 'short_description', 'description', 'subtype_description', 'optional_description', 'price', 'weight', 'upc', 'catalog_number', 'ebayitem_id', 'quantity', 'item_qty', 'release_date', 'repertuare_key', 'availability', 'published', 'new_product', 'meta_title', 'meta_description', 'meta_keyword', 'top_rs'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::title($value);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Str::title($value);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($this->name);
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = Purifier::clean($value);
    }

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    public function ganre()
    {
        return $this->belongsTo(Ganre::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }

    public function addImage($files)
    {
        $i = 0;
        foreach ($files as $file) {
            $imagetitle = Str::slug(substr($this->title, 0, 110) . ' ' . substr($this->name, 0, 110) . ' ' . time(), '-') . $i++ . '.' . $file->getClientOriginalExtension();
            $picture = ImageInt::make($file)
                ->resize(500, null, function ($constraint) { $constraint->aspectRatio(); } )
                ->encode('jpg',100);
            $thumbnail = ImageInt::make($file)
                ->resize(200, null, function ($constraint) { $constraint->aspectRatio(); } )
                ->encode('jpg',100);    
            Storage::disk('images')->put($imagetitle, $picture);
            Storage::disk('thumbnails')->put($imagetitle, $thumbnail);
            $picture->destroy();
            $thumbnail->destroy();
            $this->images()->create([
                'title' => $imagetitle
            ]);
        }
    }

    public function deleteImage()
    {
        foreach ($this->images as $image) {
            Storage::disk('images')->delete($image->title);
            Storage::disk('thumbnails')->delete($image->title);
            $image->delete();
        }
    }

    public function slugurl()
    {
        return url("/{$this->category->slug}/{$this->slug}/{$this->id}-" . Str::slug($this->title));
    }

    public function slugname()
    {
        return url("collection/" . Str::slug($this->name));
    }
}
