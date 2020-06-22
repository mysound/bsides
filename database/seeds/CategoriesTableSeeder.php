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

        Category::create(['title' => 'Music', 'parent_id' => '0', 'slug' => 'music', 'ru_title' => 'Музыка']);
        Category::create(['title' => 'Vinyl', 'parent_id' => '1', 'slug' => 'vinyl', 'ru_title' => 'Виниловая пластинка']);
        Category::create(['title' => 'CD', 'parent_id' => '1', 'slug' => 'cd', 'ru_title' => 'Компакт-диск']);
        Category::create(['title' => 'SACD', 'parent_id' => '1', 'slug' => 'sacd', 'ru_title' => 'Компакт диск Super Audio CD']);
        Category::create(['title' => 'DVD & Blu-Ray', 'parent_id' => '0', 'slug' => 'dvd-blu-ray', 'ru_title' => '']);
        Category::create(['title' => 'DVD', 'parent_id' => '5', 'slug' => 'dvd', 'ru_title' => '']);
        Category::create(['title' => 'Blu Ray', 'parent_id' => '5', 'slug' => 'blu-ray', 'ru_title' => '']);
    }
}
