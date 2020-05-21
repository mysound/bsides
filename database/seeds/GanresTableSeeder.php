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

        Ganre::create(['title' => 'Blues', 'slug' => 'blues']);
        Ganre::create(['title' => 'Classical', 'slug' => 'classical']);
        Ganre::create(['title' => 'Jazz', 'slug' => 'jazz']);
        Ganre::create(['title' => 'Rock', 'slug' => 'rock']);
        Ganre::create(['title' => 'Electronic', 'slug' => 'electronic']);
        Ganre::create(['title' => 'Rap & Hip Hop', 'slug' => 'rap-hip-hop']);
        Ganre::create(['title' => 'Soul, R&B, Funk', 'slug' => 'soul-r-and-b-funk']);
    }
}
