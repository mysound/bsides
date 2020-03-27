<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
    	return view('store.index');
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

        $products = new Product;

        $min_price = $request->min_price ? $request->min_price : 0;
        $max_price = $request->max_price ? $request->max_price : 1000000;

        if($request->has('searchField')) {
            $products = $products->where('name', 'LIKE', '%' . $request->searchField . '%');

            if($products->first() == null) {
                $products = $products->where('title', 'LIKE', '%' . $request->searchField . '%');
            }

            if($products->first() == null) {
                $products = $products->where('upc', $request->searchField);
            }
        }

        $products = $products->when($request->has('category_id'), function ($query) {
            $query->whereIn('category_id', request()->category_id);
        })->when($request->has('sortType'), function ($query) {
            $query->orderBy('price', request()->sortType);
        });

        if($request->has('min_price') or $request->has('max_price')) {
            $products = $products->whereBetween('price', [$min_price, $max_price]);
        }

        $products = $products->paginate(15)->appends([
            'searchField'   => $request->searchField,
            'sortType'      => $request->sortType,
            'min_price'     => $request->min_price,
            'max_price'     => $request->max_price,
            'category_id'   => $request->category_id
        ]);

    	return view('store.search',[
            'products'      => $products,
            'categories'    => $catgories,
            'searchField'   => $request->searchField,
            'sortType'      => $request->sortType,
            'min_price'     => $request->min_price,
            'max_price'     => $request->max_price,
            'category_id'   => $request->category_id      
    	]);
    }
}
