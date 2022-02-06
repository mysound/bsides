<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuantityImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    private $skutitle, $currency_eur;

    public function __construct($skutitle, $currency_eur = null)
    {
        $this->skutitle = $skutitle;
        $this->currency_eur = $currency_eur;
    }

    public function model(array $row)
    {
        $sku = $this->skutitle.$row['barcode'];

        $product = Product::where('sku', $sku)->first();

        if($product) {
            if($this->skutitle == 'BSC-') {
                $product->price = $this->price($row['itemprice'], $row['exchangekey'], $this->skutitle, $row['category_id']);
            } else {
                $product->quantity = 1;
                $product->price = $this->price($row['itemprice'], $row['exchangekey'], $this->skutitle, $row['category_id']);
            }
        }

        return $product;
    }

    public function price($cost, $currency, $skutitle, $catid)
    {
        $price = 0;

        if(($skutitle == 'UMG-') or ($skutitle == 'UMRU-')) {
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
                case (($cost >= 0) and ($cost <= 600)):
                    $price = $cost + ($cost*(60/100));
                    break;
                case (($cost >= 601) and ($cost <= 2000)):
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
                $price = $price * $this->currency_eur;
            } else {
                $price = $cost + ($cost*(50/100));
            }
        }

        $price = round($price, -1);

        return $price;
    }
}
