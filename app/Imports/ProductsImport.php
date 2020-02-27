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

    public function transformDate($value, $format = 'Y-m-d')
    {
        if(\DateTime::createFromFormat('d.m.Y', $value)) {
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
        $sku = 'WMR-'.$row['barcode'];

        $product = Product::where('sku', $sku)->first();

        if($product) {
            $product->quantity = 1;
            $product->price = $this->price($row['itemprice'], $row['exchangekey']);
        } else {
            $product = new Product(
                [
                    'category_id'           => $row['category_id'],
                    'sku'                   => $sku,
                    'name'                  => $row['artist'],
                    'title'                 => $row['album'],
                    'short_description'     => $row['iteminformation'],
                    'subtype_description'   => $row['subtypedescription'],
                    'optional_description'  => $row['composer'],
                    'price'                 => $this->price($row['itemprice'], $row['exchangekey']),
                    'weight'                => $row['weight'],
                    'upc'                   => $row['barcode'],
                    'catalog_number'        => $row['catalognumber'],
                    'quantity'              => '1',
                    'item_qty'              => $row['itemuomqty'],
                    'release_date'          => $this->transformDate($row['composer']),

                ]
            );

            if (!empty($row['labeldesc'])) {
                $product->brand_id = $this->brand($row['labeldesc']);
            }
        }

        return $product;
    }

    public function price($cost, $currency)
    {
        $price = 0;

        if($currency == 'EUR') {
            $price = $cost + ($cost*(50/100));
            $price = $price * 65;
        } else {
            $price = $cost + ($cost*(50/100));
        }

        return $price;
    }

    public function brand($value)
    {
        $brand = Brand::firstOrCreate(['title' => $value]);

        return $brand->id;
    }
}
