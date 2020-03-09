<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\Facades\Image as ImageInt;
use Storage;

class ImageImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $products;
    protected $startstr;
    protected $endstr;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($products, $startstr, $endstr)
    {
        $this->products = $products;
        $this->startstr = $startstr;
        $this->endstr = $endstr;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->products as $product) {
            $link = $this->startstr.$product->upc.$this->endstr;
            $headers = get_headers($link);
            
            if(preg_match("/^HTTP.+\s(\d\d\d)\s/",$headers[0],$m)) $code=$m[1];

            if ($code == 200) {
                $imageType = exif_imagetype($link);
                if ($imageType <= 3) {

                    $ch = curl_init($link);

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
                        $picture = ImageInt::make($link)
                            ->resize(500, null, function ($constraint) { $constraint->aspectRatio(); } )
                            ->encode('jpg',100);
                        $thumbnail = ImageInt::make($link)
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
}
