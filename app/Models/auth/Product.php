<?php

namespace App\Models\auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; 
class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    public function getSubcategories($category_name)
    {
    $sql = "SELECT subcategories.*
            FROM `categories`
            JOIN `subcategories` ON subcategories.category_id = categories.category_id
            WHERE categories.name = $category_name;";
    $subCategory = DB::select($sql);
    return $subCategory;
   }
   public function getProduct(){
        $sql=" SELECT * FROM products";
        $p= DB::select($sql);
        return $p;
   }
}
