<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\auth\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandAuthController extends Controller
{
    public function getBrand($categories_slug)
    {
        $sql = "SELECT
    
                    c.name AS category_name,
                    b.name AS brand_name,
                    b.brand_id,
                    COUNT(p.product_id) AS product_count
                FROM
                    products p
                JOIN
                    categories c ON p.category_id = c.category_id
                JOIN
                    brands b ON p.brand_id = b.brand_id
                WHERE
                    c.slug = ?
                GROUP BY
                    c.name, b.name,b.brand_id";
        $brands = DB::select($sql, [$categories_slug]);
    
        return response()->json($brands);
    }
    
}
