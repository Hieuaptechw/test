<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('carts_items', function (Blueprint $table) {
            $table->id('cart_items_id'); 
            $table->unsignedBigInteger('cart_id'); 
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity'); 
            $table->decimal('price', 10, 2); 
            $table->string('color')->nullable(); 
            $table->string('size')->nullable(); 
            $table->decimal('weight', 8, 2)->nullable(); 
            $table->timestamps(); 
              
            $table->foreign('cart_id')->references('cart_id')->on('carts')->onDelete('cascade');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('carts_items');
    }
};
