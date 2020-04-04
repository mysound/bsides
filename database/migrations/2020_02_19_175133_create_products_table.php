<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id');
            $table->string('sku')->unique();
            $table->string('name');
            $table->string('title');
            $table->string('brand_id')->nullable();
            $table->string('ganre_id')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('subtype_description')->nullable();
            $table->text('optional_description')->nullable();
            $table->decimal('price', 8, 2);
            $table->decimal('weight', 3, 2)->nullable();
            $table->string('upc')->nullable();
            $table->string('catalog_number')->nullable();
            $table->string('ebayitem_id')->nullable();
            $table->integer('quantity')->default(0);
            $table->integer('item_qty')->nullable();
            $table->date('release_date')->nullable();
            $table->string('repertuare_key')->nullable();
            $table->boolean('availability')->nullable();
            $table->boolean('published')->nullable();
            $table->boolean('new_product')->nullable();
            $table->integer('top_rs')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
