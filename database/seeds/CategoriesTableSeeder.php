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

        Category::create(['title' => 'Music', 'parent_id' => '0']);
        Category::create(['title' => 'Vinyl', 'parent_id' => '1']);
        Category::create(['title' => 'CD', 'parent_id' => '1']);
        Category::create(['title' => 'SACD', 'parent_id' => '1']);
        Category::create(['title' => 'DVD & Blu-Ray', 'parent_id' => '0']);
        Category::create(['title' => 'DVD', 'parent_id' => '5']);
        Category::create(['title' => 'Blu Ray', 'parent_id' => '5']);
    }
}
