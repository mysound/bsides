<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();

        Category::create(['title' => 'Music', 'parent_id' => '0', 'slug' => 'music']);
        Category::create(['title' => 'Vinyl', 'parent_id' => '1', 'slug' => 'vinyl']);
        Category::create(['title' => 'CD', 'parent_id' => '1', 'slug' => 'cd']);
        Category::create(['title' => 'SACD', 'parent_id' => '1', 'slug' => 'sacd']);
        Category::create(['title' => 'DVD & Blu-Ray', 'parent_id' => '0', 'slug' => 'dvd-blu-ray']);
        Category::create(['title' => 'DVD', 'parent_id' => '5', 'slug' => 'dvd']);
        Category::create(['title' => 'Blu Ray', 'parent_id' => '5', 'slug' => 'blu-ray']);
    }
}
