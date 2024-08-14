<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\auth\Category;
class CategoriauthController extends Controller
{
    public function getCategory(){
        $Category = new Category();
        $r = $Category->getCategory();
        return response()->json($r);
    }

    public function getSubcategories($category_name)
    {
        $category = DB::table('categories')
                      ->where('slug', $category_name)
                      ->first();

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $subcategories = DB::table('subcategories')
                            ->where('category_id', $category->category_id)
                            ->get();

        return response()->json($subcategories);

    }
}
