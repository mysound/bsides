<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function index()
    {
    	return view('admin.export.index');
    }

    public function mainCatalog()
    {
    	return Excel::download(new ProductsExport, 'products.xlsx');
    }
}
