<?php

namespace App\Imports;

use App\Product;
use App\Brand;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Intervention\Image\Facades\Image as ImageInt;
use Storage;

class PreorderImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
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
            $product->description = $row['salepoint'];
            if(!$product->images->first()) {
                if (isset($row['fullalbumcoverpath'])) {
                    stream_context_set_default( [
                        'ssl' => [
                            'verify_peer' => false,
                            'verify_peer_name' => false
                        ],
                    ]);
                    $imagelink = 'https://www.canvass.warnermusic.ru/Handlers/GetAlbumCoverHandler.ashx?imgpath='.str_replace(' ', '%20', $row['albumcoverpath']);
                    $headers = get_headers($imagelink);
                    if (str_contains($headers[0], '200')) {
                        $imageType = exif_imagetype($imagelink);
                        if ($imageType <= 3) {

                            $ch = curl_init($imagelink);

                            curl_setopt_array($ch,[
                                CURLOPT_TIMEOUT => 60,
                                CURLOPT_FOLLOWLOCATION => 1,
                                CURLOPT_RETURNTRANSFER => 1,
                                CURLOPT_NOPROGRESS => 0,
                                CURLOPT_BUFFERSIZE => 1024,
                                CURLOPT_PROGRESSFUNCTION => function ($ch, $dwnldSize, $dwnld, $upldSize, $upld) {
                                    if ($dwnld > 1024 * 1024 * 5) {
                                        return -1;
                                    }
                                },
                                CURLOPT_SSL_VERIFYPEER => 1,
                                CURLOPT_SSL_VERIFYHOST => 2,
                            ]);
                            $raw   = curl_exec($ch);
                            $info  = curl_getinfo($ch);
                            $error = curl_errno($ch);

                            curl_close($ch);

                            if(!$error) {
                                $imagetitle = substr($product->name, 0, 1).$product->upc.'.jpg';
                                $picture = ImageInt::make($imagelink)
                                    ->resize(500, null, function ($constraint) { $constraint->aspectRatio(); } )
                                    ->encode('jpg',100);
                                $thumbnail = ImageInt::make($imagelink)
                                    ->resize(170, null, function ($constraint) { $constraint->aspectRatio(); } )
                                    ->encode('jpg',100);
                                Storage::disk('images')->put($imagetitle, $picture);
                                Storage::disk('thumbnails')->put($imagetitle, $thumbnail);
                                $picture->destroy();
                                $thumbnail->destroy();
                                $product->images()->create([
                                    'title' => $imagetitle
                                ]);
                            }
                        }
                    }
                }
            }
        } else {
            $product = new Product([
                'category_id'           => $row['category_id'],
                'sku'                   => $sku,
                'name'                  => $row['artist'],
                'title'                 => $row['album'],
                'quantity'              => '1',
                'price'                 => $this->price($row['itemprice'], $row['exchangekey'], $this->skutitle, $row['category_id']),
                'release_date'          => $this->transformDate($row['releasedate']),
                'upc'                   => $row['barcode'],
                'item_qty'              => $row['unitsperset'],
                'short_description'     => $row['pack'],
                'subtype_description'   => $row['format'],
                'optional_description'  => $row['releasedate'],
                'weight'                => 0.321,
                'catalog_number'        => $row['catalognumber'],
                'repertuare_key'        => $row['label'],
                'slug'                  => $row['artist']
            ]);
        }

        return $product;
    }

    public function chunkSize(): int
    {
        return 30;
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
