<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\admin\Brand;
use App\Models\admin\Categori;
use App\Models\admin\Subcategori;
use App\Models\admin\Product;
use App\Models\admin\ProductDetails;
use App\Models\admin\ProductImages;
use App\Models\admin\Store;

class AddProductController extends Controller
{

    public function create()
    {
        $categories = Categori::all();
        $subcategories = Subcategori::all();
        $brands = Brand::all();
        $stores = Store::all();
        return view('admin.addproduct', compact('categories', 'subcategories', 'brands', 'stores'));
    }
    public function store(Request $request)
    {

        $product = new Product();
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->subcategory_id = $request->input('subcategory_id');
        $product->brand_id = $request->input('brand_id');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->price_sale = $request->input('price_sale');
        $product->quantity = $request->input('quantity');
        $product->store_id = $request->input('store_id');
        if ($request->hasFile('product_avatar')) {
            $avatar = $request->file('product_avatar');
            $avatarName = time() . '-' . $avatar->getClientOriginalName();
            if ($avatar->storeAs('public/images', $avatarName)) {
                $product->avatar_product = 'storage/images/' . $avatarName;
            } else {
                return response()->json(['error' => 'File upload failed'], 500);
            }
        }
        
        $product->save();

        if ($request->hasFile('product_avatar')) {
            $avatar = $request->file('product_avatar');
            $avatarName = time() . '-' . $avatar->getClientOriginalName();
            $avatar->storeAs('public/images', $avatarName);

            $productImage = new ProductImages();
            $productImage->product_id = $product->product_id;
            $productImage->image_url = 'storage/images/' . $avatarName;
            $productImage->save();
        }

        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->storeAs('public/images', $imageName);

                $productImage = new ProductImages();
                $productImage->product_id = $product->product_id;
                $productImage->image_url = 'storage/images/' . $imageName;
                $productImage->save();
            }
        }
        $attributes = [
            'color' => $request->input('color'),
            'weight' => $request->input('weight'),
            'inch' => $request->input('inch'),
        ];

        foreach ($attributes as $key => $value) {
            if (!empty($value)) {
                if (is_array($value)) {
                  $value = json_encode($value);
                }
                $productDetail = new ProductDetails();
                $productDetail->product_id = $product->product_id;
                $productDetail->attribute_name = $key;
                $productDetail->attribute_value = $value;
                $productDetail->save();
            }
        }

        return redirect()->back()->with('success', 'Product added successfully.');
    }
}
