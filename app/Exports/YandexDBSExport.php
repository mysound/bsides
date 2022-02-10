<?php

namespace App\Exports;

use App\Product;
use Str;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class YandexDBSExport implements FromCollection, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::where([
            ['sku', 'LIKE', 'BSC-' . '%'],
            ['quantity', '>', 0]
        ])->get();
    }

    public function map($row): array
    {
    	return [
    		$row->id,
    		$row->category->ru_title . ' ' . $row->name . ' ' . $row->title,
    		$this->imagelink($row),
    		$row->name . ' - ' . $row->title . ' в формате ' . $row->category->title,
    		'Музыка',
    		$row->name,
    		$row->upc,
    		'32/32/5',
    		$this->itemWeight($row),
    		'',
    		'',
    		'Музыкальная и видеопродукция',
    		'',
    		'',
    		'',
    		$row->slugurl(),
    		'',
    		$row->price + 600,
    		'',
    		'RUR',
    		'',
    		'',
    		'',
    		'Нельзя',
    		'',
    		'В наличии',
    		'1',
    		'Есть',
    		'',
    		'Нет',
    		''
    	];
    }

    public function imagelink($product)
    {
    	if($product->images->first()) {
    		return 'https://bsides.ru/storage/images/'.$product->images->first()->title;
    	}

    	return 'https://bsides.ru/storage/images/noimage.png';
    }

    public function itemWeight($product)
    {
    	if ($product->category->id == 2) {
    		return round($product->item_qty * 0.5);
    	}

    	return '1';
    }
}
