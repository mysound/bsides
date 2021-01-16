<?php

namespace App\Exports;

use App\Product;
use Str;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class YandexExport implements FromCollection, WithMapping
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
    		'В наличии',
    		'Есть',
    		'',
    		'',
    		'Нет',
    		'',
    		'',
    		'Нельзя',
    		$row->slugurl(),
    		'Музыка',
    		$row->price,
    		'',
    		'RUR',
    		$this->imagelink($row),
    		$row->name . ' - ' . $row->title . ' в формате ' . $row->category->title,
    		'',
    		'Предоплата 100%',
    		'',
    		'',
    		'',
    		$row->upc,
    		'artist.title',
    		$row->name,
    		'',
    		$row->category->ru_title .' '. $row->name .' '. $row->title,
    		$row->title,
    		$this->getYear($row->release_date),
    		$row->category->title,
    		$row->name,
    		'',
    		'Нет',
    		'',
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

    public function getYear($date)
    {
    	if($date) {
    		return Carbon::createFromFormat('Y-m-d', $date)->year;
    	}

    	return '';
    }
}
