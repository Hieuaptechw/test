<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE VIEW product_full_view AS
            SELECT p.product_id, p.name, p.category_id, p.subcategory_id, p.brand_id, p.description, p.price, p.price_sale, p.quantity, p.store_id, p.avatar_product,
                   d.attribute_name, d.attribute_value,
                   pi.image_url
            FROM products p
            LEFT JOIN product_details d ON p.product_id = d.product_id
            LEFT JOIN product_images pi ON p.product_id = pi.product_id;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS product_full_view");
    }
};
