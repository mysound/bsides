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
    		$this->itemTitle($row),
    		$this->imagelink($row),
    		$this->itemDescription($row),
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
    		$this->itemProperty($row),
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

    public function itemDescription($product)
    {
    	$description = $product->name . ' - ' . $product->title . ' в формате ' . $product->category->title;
    	
    	return $description;
    }

    public function itemTitle($product)
    {
    	$title = $product->name . ' - ' . $product->title . ' ('. $product->category->title .' '. $product->category->ru_title.') ';

    	return $title;
    }

    public function itemProperty($product)
    {
    	$property = 'UPC: |'.$product->upc.' ;';
    	if ($product->short_description) {
    		$property = $property . 'Описание: |'.$product->short_description.' ;';
    	}
    	$property = $property . 'Формат: |'.$product->category->title.' ;';
    	$property = $property . 'Количество дисков: |'.$product->item_qty.' ;';

    	return $property;
    }
}
