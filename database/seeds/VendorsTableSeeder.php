<?php

use App\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vendors')->truncate();

        Vendor::create(['title' => 'Warner Music', 'vendor_sku' => 'WMR']);
        Vendor::create(['title' => 'Universal Music', 'vendor_sku' => 'UMG']);
        Vendor::create(['title' => 'Universal Music CYR', 'vendor_sku' => 'UMRU']);
        Vendor::create(['title' => 'Audio-Technica', 'vendor_sku' => 'ATH']);
    }
}
