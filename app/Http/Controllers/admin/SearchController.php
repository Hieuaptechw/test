<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Product;
use App\Models\admin\Categori;
use App\Models\admin\Subcategori;
use App\Models\admin\Brand;
use App\Models\admin\Order;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('product_id', 'like', '%' . $query . '%')
            ->orWhere('name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->get();

        $categories = Categori::where('category_id', 'like', '%' . $query . '%')
            ->orWhere('name', 'like', '%' . $query . '%')
            ->get();

            $subcategories = Subcategori::where('subcategory_id', 'like', '%' . $query . '%')
            ->orWhere('name', 'like', '%' . $query . '%')
            ->get();

        $brands = Brand::where('brand_id', 'like', '%' . $query . '%')
            ->orWhere('name', 'like', '%' . $query . '%')
            ->get();

        return view('admin.layouts.searchresult', compact('products', 'categories', 'subcategories', 'brands', 'query'));
    }
    public function searchapi($query)
    {
        $products = Product::where('product_id', 'like', '%' . $query . '%')
            ->orWhere('name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->get();
        return response()->json([
            'status' => true,
            'products' => $products,
            'query' => $query
        ]);
    }
}
