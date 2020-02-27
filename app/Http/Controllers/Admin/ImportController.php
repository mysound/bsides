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

    public function mainCreate()
    {
    	return view('admin.import.maincreate');
    }

    public function mainStore(Request $request)
    {
    	Excel::import(new ProductsImport, $request->file('import_file'));

    	return redirect()->route('admin.product.index')->with('status', 'The file was successfully imported');
    } 
}
