<?php

namespace App\Exports;

use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromCollection, WithHeadings, WithMapping
{

    public function __construct($ebayitem = false)
    {
        $this->ebayitem = $ebayitem;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if ($this->ebayitem) {
            $products = Product::all();
            $ebayitems = $products->where('ebayitem_id', null);

            return $ebayitems;
        }
        return Product::all();
    }

    public function map($row): array
    {
        $title = $this->nameTitle($row->name, $row->title, $row->category->title);
        $maker = $this->makerTitle(substr($row->sku, 0, 4));
        $description = $this->description($row, $title, $maker);
        $category = $this->categoriTitle($row->category_id);
        $image = '';
        if ($row->images->first()) {
            $image = $row->images->first()->title;
        }

        
        if(($category == 'RU:176984') or ($category == 'RU:617')) {
            $shipping = 42171;
        } else {
            $shipping = 41869;
        }

    	return [
	    	$row->sku,
            $title,
            'RU',
	    	$row->upc,
            $row->upc,
            $maker,
            'Non applicable',
            $description,
            'New',
            $row->quantity,
	    	$row->price,
            $category,
            $image,
            $shipping
	    ];
    }

    public function headings(): array
    {
        return [
            'SKU',
            'Title',
            'Language',
            'UPC',
            'EAN',
            'Brand',
            'MPN',
            'Description',
            'Condition',
            'Quantity',
            'Price',
            'Categories',
            'Product Pictures',
            'Shipping Profile'
        ];
    }

    public function nameTitle($name, $title, $type)
    {
        $name_title = $name.' - '.$title.' ('.$type.') New';
        return $name_title;
    }

    public function makerTitle($value)
    {
        switch ($value):
        case ($value == 'BSC-'):
            $maker = '';
            break;
        case ($value == 'WMR-'):
            $maker = 'Warner Music';
            break;
        case (($value == 'UMG-') or ($value == 'UMRU')):
            $maker = 'Universal Music';
            break;
        endswitch;
        return $maker;
    }

    public function transformDate($value, $format = 'd.m.Y')
    {
        if(\DateTime::createFromFormat('d.m.Y H:i:s', $value)) {
            try {
                return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
            } catch (\ErrorException $e) {
                return \Carbon\Carbon::parse($value)->format($format);
            } 
        } else {
            return $value;
        }
    }

    public function description($row, $title, $maker)
    {
        $brand = '';
        if (!empty($row->brand_id)) {
            $brand = $row->brand->title;
        }
        $description = '<h1>'.$title.'</h1><ul><li>Состояние: Новый</li><li>'.$row->name.'</li><li>'.$row->subtype_description.'</li><li>'.$row->short_description.'</li><li>Количество дисков: '.$row->item_qty.'</li><li>Производитель: '.$maker.'</li><li>Лейбл: '.$brand.'</li><li>'.$row->repertuare_key.'</li><li>'.$this->transformDate($row->optional_description).'</li><li>UPC: '.$row->upc.'</li></ul><p>Пожалуйста, уточняйте наличие перед покупкой. Спасибо</p>';
        return $description;
    }

    public function categoriTitle($category_id)
    {
        switch ($category_id):
        case ($category_id == 2):
            $category = 'RU:176985';
            break;
        case (($category_id == 3) or ($category_id == 4)):
            $category = 'RU:176984';
            break;
        case (($category_id == 6) or ($category_id == 7)):
            $category = 'RU:617';
            break;
        endswitch;

        return $category;
    }
}
