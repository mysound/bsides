<?php

namespace App\Imports;

use App\Product;
use App\Brand;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function __construct($skutitle)
    {
        $this->skutitle = $skutitle;
    }

    public function transformDate($value, $format = 'Y-m-d')
    {
        if((\DateTime::createFromFormat('d.m.Y', $value)) or (\DateTime::createFromFormat('d.m.Y H:i:s', $value))) {
            try {
                return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
            } catch (\ErrorException $e) {
                return \Carbon\Carbon::parse($value)->format($format);
            } 
        } else {
            return null;
        }
    }

    public function model(array $row)
    {
        $sku = $this->skutitle.$row['barcode'];

        $product = Product::where('sku', $sku)->first();

        if($product) {
            $product->quantity = 1;
            $product->price = $this->price($row['itemprice'], $row['exchangekey'], $this->skutitle, $row['category_id']);
        } else {
            $product = new Product(
                [
                    'category_id'           => $row['category_id'],
                    'sku'                   => $sku,
                    'name'                  => $row['artist'],
                    'title'                 => $row['album'],
                    'quantity'              => '1',
                    'price'                 => $this->price($row['itemprice'], $row['exchangekey'], $this->skutitle, $row['category_id']),
                    'release_date'          => $this->transformDate($row['composer']),
                    'upc'                   => $row['barcode'],
                    'item_qty'              => $row['itemuomqty'],
                    'short_description'     => $row['iteminformation'],
                    'subtype_description'   => $row['subtypedescription'],
                    'optional_description'  => $row['composer'],
                    'weight'                => $row['weight'],
                    'catalog_number'        => $row['catalognumber'],

                ]
            );

            if (!empty($row['labeldesc'])) {
                $product->brand_id = $this->addBrand($row['labeldesc']);
            }
        }

        return $product;
    }

    public function addBrand($value)
    {
        $brand = Brand::firstOrCreate(['title' => $value]);

        return $brand->id;
    }

    public function price($cost, $currency, $skutitle, $catid)
    {
        $price = 0;

        if($skutitle == 'UMG-') {
            if($catid == '2') {
                switch ($cost):
                case (($cost >= 0) and ($cost <= 1000)):
                    $price = $cost + ($cost*(60/100));
                    break;
                case (($cost >= 1001) and ($cost <= 1500)):
                    $price = $cost + ($cost*(50/100));
                    break;
                case ($cost >= 1501):
                    $price = $cost + ($cost*(40/100));
                    break;
                endswitch;
            } else {
                switch ($cost):
                case (($cost >= 0) and ($cost <= 2000)):
                    $price = $cost + ($cost*(50/100));
                    break;
                case (($cost >= 2001) and ($cost <= 3000)):
                    $price = $cost + ($cost*(45/100));
                    break;
                case ($cost >= 3001):
                    $price = $cost + ($cost*(40/100));
                    break;
                endswitch;
            }
        } else {
            if($currency == 'EUR') {
                $price = $cost + ($cost*(50/100));
                $price = $price * 65;
            } else {
                $price = $cost + ($cost*(50/100));
            }
        }

        $price = round($price, -1);

        return $price;
    }
}
