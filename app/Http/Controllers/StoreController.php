<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Ganre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class StoreController extends Controller
{
    public function index()
    {
    	return view('store.index', [
            'ganres' => Ganre::all()
        ]);
    }

    public function view($category, $name, Product $product)
    {
        event('productHasViewed', $product);
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

            if($products->first() == null) {
                $products = Product::where('slug', $request->searchField);
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

        $products = $products->where('quantity', '>', 0);

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
            'top_rs'        => $request->top_rs,
            'categoryslug'  => null
    	]);
    }

    public function allartist()
    {
        $products = Product::all();
        $collection = $products->pluck('name')->unique();
        $artists = $collection->groupBy(function ($item, $key) {
            return substr($item, 0, 1);
        })
        ->sortBy(function ($item, $key) {
            return $key;
        });
        return view('store.all-artists', ['artists' => $artists]);
    }

    public function name($name, Request $request)
    {
        $products = new Product;

        $products = Product::where('slug', $name);

        $products = $products->where('quantity', '>', 0);
        
        $products = $products->paginate(15);
        
        $viewArr = $this->viewArr($name);
        $viewArr['products'] = $products;
        $viewArr['metatitle'] = ($products->isEmpty() ? $name : $products->first()->name) . ' купить на виниловых пластинках Vinyl, на CD компакт-дисках, на DVD, на Blu-Ray | bsides.ru';
        $viewArr['metadescription'] = 'Купить недорого все альбомы ' . ($products->isEmpty() ? $name : $products->first()->name) . ' на виниловых пластинках, компакт-дисках CD, DVD, Blu-Ray. Интернет-магазин bsides.ru';

        return view('store.search', $viewArr);
    }

    public function catslug($slug, $name = null)
    {
        $category = Category::where('slug', $slug)->first();

        $products = new Product;
        
        $name = Str::slug($name, '-');
        
        if($name) {
            $products = Product::where('slug', 'LIKE' , '%' . $name . '%');
        }

        if ($category->parent_id == 0) {
            $collection = Category::where('parent_id', $category->id)->pluck('id');
            $products = $products->whereIn('category_id', $collection);
        } else {
            $products = $products->where('category_id', $category->id);
        }

        $viewArr = $this->viewArr($name, $category->id, $category->slug);

        $products = $products->where('quantity', '>', 0);
        $products = $products->paginate(15)->appends($viewArr);

        $viewArr['products'] = $products; 
        $viewArr['metatitle'] = $category->title . ' купить в интернет магазине bsides.ru';

        return view('store.search', $viewArr);
    }

    public function ganreslug($slug, $category = null)
    {
        $ganre = Ganre::where('slug', $slug)->first();

        $products = Product::where('ganre_id', $ganre->id);
        $products = $products->where('quantity', '>', 0);
        $products = $products->paginate(15);
        $viewArr = $this->viewArr();
        $viewArr['ganreslug'] = $ganre->slug;
        $viewArr['products'] = $products;
        $viewArr['metatitle'] = $ganre->title . ' - ' . 'Виниловые пластинки и компакт-диски купить в интернет магазине bsides.ru';
        $viewArr['metadescription'] = 'Купить виниловые пластинки Vinyl и компакт-диски CD, LP, EP, CD, DVD, Blu-Ray недорого в интернет магазине bsides жанра — '. $ganre->title .'. Доставка по России';
        return view('store.search', $viewArr);
    }

    public function boxset()
    {
        $products = Product::where('item_qty', '>', '2')->paginate(15);
        $viewArr = $this->viewArr();
        $viewArr['products'] = $products;

        return view('store.search', $viewArr);
    }

    public function preorder()
    {
        $products = Product::where('release_date', '>', $this->dateNow())->paginate(15);

        $viewArr = $this->viewArr();
        $viewArr['products'] = $products;

        return view('store.search', $viewArr);
    }

    public function newReleas()
    {
        $products = Product::whereBetween('release_date', [date('Y-m-d', strtotime("-30 days")), $this->dateNow()]);

        $products = $products->where('quantity', '>', 0);
        $products = $products->paginate(15);

        $viewArr = $this->viewArr();
        $viewArr['products'] = $products;

        return view('store.search', $viewArr);
    }

    public function viewArr($searchField = null, $category_id = null, $categoryslug = null)
    {
        return [
            'categories'    => Category::all(),
            'ganres'        => Ganre::all(),
            'searchField'   => $searchField,
            'sortType'      => null,
            'min_price'     => null,
            'max_price'     => null,
            'category_id'   => $category_id,
            'categoryslug'  => $categoryslug,
            'top_rs'        => null,
            'metatitle'     => 'Результат поиска | bsides.ru'
        ];
    }

    public function dateNow()
    {
        return Carbon::now()->format('Y-m-d');
    }

    public function about()
    {
        return view('store.about');
    }

    public function payment()
    {
        return view('store.payment');
    }

    public function delivery()
    {
        return view('store.delivery');
    }

    public function policy()
    {
        return view('store.policy');
    }

    public function response()
    {
        echo "SUCCESS";
    }
}
