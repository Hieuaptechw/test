<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('price_sale', 10, 2);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('store_id')->nullable();
            $table->integer('quantity');
            $table->string('avatar_product');
            $table->timestamps();
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('set null');
            $table->foreign('subcategory_id')->references('subcategory_id')->on('subcategories')->onDelete('set null');
            $table->foreign('brand_id')->references('brand_id')->on('brands')->onDelete('set null');
            $table->foreign('store_id')->references('store_id')->on('stores')->onDelete('set null');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};