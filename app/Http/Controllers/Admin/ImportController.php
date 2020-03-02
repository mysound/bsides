<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function index()
    {
    	return view('admin.import.index');
    }

    public function create(Request $request)
    {
    	return view('admin.import.create', [
            'sku_title' => $request->sku
        ]);
    }

    public function store(Request $request)
    {
        $skutitle = $request->sku_title;

    	Excel::import(new ProductsImport($skutitle), $request->file('import_file'));

    	return redirect()->route('admin.product.index')->with('status', 'The file was successfully imported');
    }
}
