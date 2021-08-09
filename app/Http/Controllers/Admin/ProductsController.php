<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductsFilter;
use App\Category;
use App\Brand;
use App\Ganre;
use App\Vendor;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::with('images', 'counter');

        $products = (new ProductsFilter($products, $request))->apply()->paginate(10)
                        ->appends([
                            'sortPrice'     => $request->sortPrice,
                            'sortViews'     => $request->sortViews,
                            'sortCart'      => $request->sortCart,
                            'noImg'         => $request->noImg,
                            'searchField'   => $request->searchField,
                            'skuFilter'     => $request->skuFilter
                        ]);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create', [
            'product'   => [],
            'categories' => Category::with('children')->where('parent_id', '0')->get(),
            'brands' => Brand::all(),
            'ganres' => Ganre::all(),
            'separator'  => ''
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name'  =>  'required',
            'title' =>  'required',
            'price' =>  'required|numeric',
            'image.*' =>  'sometimes|image'
        ]);

        $product = Product::create($request->all());

        if(request()->hasFile('image')) {
            $files = request()->file('image');

            $product->addImage($files);
        }

        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', [
            'product'   => $product,
            'categories' => Category::with('children')->where('parent_id', '0')->get(),
            'brands' => Brand::all(),
            'ganres' => Ganre::all(),
            'separator'  => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate(request(), [
            'name'  =>  'required',
            'title' =>  'required',
            'price' =>  'required|numeric',
            'image.*' =>  'sometimes|image'
        ]);

        $product->update($request->except('slug'));

        if(request()->hasFile('image')) {
            $product->deleteImage();
            
            $files = request()->file('image');

            $product->addImage($files);
        }

        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->images->isNotEmpty()) {
            $product->deleteImage();
        }

        $product->delete();

        return redirect()->route('admin.product.index');
    }

    public function quantity() {
        return view('admin.products.quanity', [
            'vendors' => Vendor::all()
        ]);
    }

    public function nullifyQuantity(Request $request) {

        $products = Product::where('release_date', '<=', \Carbon\Carbon::now()->format('Y-m-d'));
        $products = $products->where('sku', 'LIKE', $request->sku. '%')
                                ->update(['quantity' => 0]);

        $productsDateN =  Product::where([
                                ['release_date', NULL],
                                ['sku', 'LIKE', $request->sku. '%']
                            ])->update(['quantity' => 0]);

        return redirect()->route('admin.product.index')
                            ->with('status', 'Quantity changed successfully');
    }
}
