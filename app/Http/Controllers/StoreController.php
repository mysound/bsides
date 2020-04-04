<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Ganre;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
    	return view('store.index', [
            'ganres' => Ganre::all()
        ]);
    }

    public function view(Product $product)
    {
        return view('store.view', compact('product'), [
            'items' => Product::all()->random(4)
        ]);
    }

    public function shope(Request $request)
    {
        $catgories = Category::all();
        $ganres = Ganre::all();

        $products = new Product;

        $min_price = $request->min_price ? $request->min_price : 0;
        $max_price = $request->max_price ? $request->max_price : 1000000;

        if($request->has('searchField')) {
            $products = Product::where('name', 'LIKE', '%' . $request->searchField . '%');

            if($products->first() == null) {
                $products = Product::where('title', 'LIKE', '%' . $request->searchField . '%');
            }

            if($products->first() == null) {
                $products = Product::where('upc', $request->searchField);
            }
        }

        $products = $products->when($request->has('category_id'), function ($query) {
            $query->whereIn('category_id', request()->category_id);
        })->when($request->has('sortType'), function ($query) {
            $query->orderBy('price', request()->sortType);
        })->when($request->has('ganre_id'), function ($query) {
            $query->where('ganre_id', request()->ganre_id);
        })->when($request->has('top_rs'), function ($query) {
            $query->whereNotNull('top_rs');
        });

        if($request->has('min_price') or $request->has('max_price')) {
            $products = $products->whereBetween('price', [$min_price, $max_price]);
        }

        $products = $products->paginate(15)->appends([
            'searchField'   => $request->searchField,
            'sortType'      => $request->sortType,
            'min_price'     => $request->min_price,
            'max_price'     => $request->max_price,
            'category_id'   => $request->category_id,
            'ganre_id'      => $request->ganres_id,
            'top_rs'        => $request->top_rs
        ]);

    	return view('store.search',[
            'products'      => $products,
            'categories'    => $catgories,
            'ganres'        => $ganres,
            'searchField'   => $request->searchField,
            'sortType'      => $request->sortType,
            'min_price'     => $request->min_price,
            'max_price'     => $request->max_price,
            'category_id'   => $request->category_id,
            'top_rs'        => $request->top_rs
    	]);
    }

    public function allartist ()
    {
        $products = Product::all();
        $collection = $products->pluck('name')->unique();
        $artists = $collection->groupBy(function ($item, $key) {
            return substr($item, 0, 1);
        });
        return view('store.all-artists', ['artists' => $artists]);
    }
}
