<?php

use App\Ganre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GanresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ganres')->truncate();

        Ganre::create(['title' => 'Blues']);
        Ganre::create(['title' => 'Classical']);
        Ganre::create(['title' => 'Jazz']);
        Ganre::create(['title' => 'Rock']);
        Ganre::create(['title' => 'Electronic']);
        Ganre::create(['title' => 'Rap & Hip Hop']);
        Ganre::create(['title' => 'Soul, R&B, Funk']);
    }
}
