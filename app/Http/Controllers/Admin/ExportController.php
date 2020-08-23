<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Exports\YandexExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function index()
    {
    	return view('admin.export.index');
    }

    public function mainCatalog(Request $request)
    {
    	if($request->ebayitem) {
    		return Excel::download(new ProductsExport(true), 'products.xlsx');
    	}

    	return Excel::download(new ProductsExport, 'products.xlsx');
    }

    public function yandexMarket()
    {
        return Excel::download(new YandexExport, 'ya.xlsx');
    }
}
