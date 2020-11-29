<?php

use App\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->truncate();

        Status::create(['name' => 'в обработке']);
        Status::create(['name' => 'в обработке, ожидает оплаты']);
        Status::create(['name' => 'ожидает оплаты']);
        Status::create(['name' => 'оплачен']);
        Status::create(['name' => 'оплачен, ожидает отправки']);
        Status::create(['name' => 'ожидает отправки']);
        Status::create(['name' => 'отправлен']);
    }
}
