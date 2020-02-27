<?php

namespace App\Exports;

use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all();
    }

    public function map($row): array
    {
    	return [
	    	$row->sku,
            $row->name,
            $row->title,
            $row->short_description,
	    	$row->price,
	    	$row->upc,
            $row->quantity
	    ];
    }

    public function headings(): array
    {
        return [
            'SKU',
            'Name',
            'Title',
            'ShortDescription',
            'Price',
            'UPC',
            'Quantity'

        ];
    }
}
