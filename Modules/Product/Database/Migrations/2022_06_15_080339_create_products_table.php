<?php

namespace Modules\Product\Database;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade')->onUpdate('cascade');
            
            $table->boolean('status')->default(1);

            $table->boolean('new_arrival')->default(0);
            $table->boolean('most_selling')->default(0);
            $table->boolean('featured')->default(0);

            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();

            $table->longText('short_desc_ar')->nullable();
            $table->longText('short_desc_en')->nullable();

            $table->longText('long_desc_ar')->nullable();
            $table->longText('long_desc_en')->nullable();

            $table->string('header')->nullable();

            $table->decimal('price', 8, 3)->nullable()->default(0.000);
            
            $table->integer('quantity')->nullable()->default(0);
            
            $table->integer('discount_value')->nullable()->default(0);
            $table->timestamp('discount_from')->nullable();
            $table->timestamp('discount_to')->nullable();

            $table->timestamps();
        });

        Schema::create('product_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('item_id');
            $table->string('item_type'); // This column will store the type of item (e.g., 'App\Models\Color', 'App\Models\Size')
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->index(['item_id', 'item_type']); // Add an index for polymorphic relationships
        });

        Schema::create('product_category', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });


        Schema::create('product_gallery', function (Blueprint $table) {
            $table->id();

            $table->string('image')->nullable();

            $table->boolean('status')->default(1);

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');


            $table->unsignedBigInteger('color_id')->nullable();
            $table->foreign('color_id')->nullable()->references('id')->on('colors')->onDelete('cascade')->onUpdate('cascade');


            $table->timestamps();
        });


        Schema::create('product_size', function (Blueprint $table) {
            $table->id();

            $table->boolean('status')->default(1);

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('size_id')->nullable();
            $table->foreign('size_id')->nullable()->references('id')->on('sizes')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });


    }

    public function down()
    {
        Schema::dropIfExists('product_gallery');
        Schema::dropIfExists('product_category');
        Schema::dropIfExists('products');
    }
}
