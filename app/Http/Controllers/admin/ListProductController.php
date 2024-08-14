<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Product;
use App\Models\admin\ProductDetails;
use App\Models\admin\ProductImages;
use Illuminate\Http\Request;
use App\Models\admin\Brand;
use App\Models\admin\Categori;
use App\Models\admin\Subcategori;
use Illuminate\Support\Facades\DB;

use App\Models\admin\Store;

class ListProductController extends Controller
{
    public function getlist()
    {
        $Category = new Product();
        $r = $Category->getlist();
        return response()->json($r);
    }
    public function viewList()
    {
        $perPage = 5;
        $productlist = Product::orderBy('product_id', 'desc')->paginate($perPage);
        return view('admin.listproduct', compact('productlist'));
    }
    public function delete($id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();
            return redirect('/admin/products')->with('success', 'Product deleted successfully');
        } else {
            return redirect('/admin/products')->with('fail', 'Product not found');
        }
    }
   



    public function edit($id)
    {
        // Lấy sản phẩm cùng với hình ảnh
        $product = Product::with('images')->find($id);
        
        // Lấy danh sách các thể loại, phụ thể loại, thương hiệu và cửa hàng
        $categories = Categori::all();
        $subcategories = Subcategori::all();
        $brands = Brand::all();
        $stores = Store::all();
        
        // Khởi tạo các biến để lưu trữ thông tin thuộc tính
        $selectedColors = [];
        $selectedWeight = [];
        $selectedInch = [];
    
        // Nếu sản phẩm tồn tại
        if ($product) {
            // Sử dụng câu lệnh SQL để lấy thông tin màu sắc
            $sqlColor = "SELECT * 
                FROM product_details 
                WHERE attribute_name = 'color' 
                AND product_id = ?";
            $selectedColors = DB::select($sqlColor, [$product->product_id]);
    
            // Sử dụng câu lệnh SQL để lấy thông tin trọng lượng
            $sqlWeight = "SELECT * 
                FROM product_details 
                WHERE attribute_name = 'weight' 
                AND product_id = ?";
            $selectedWeight = DB::select($sqlWeight, [$product->product_id]);
    
            // Sử dụng câu lệnh SQL để lấy thông tin kích thước
            $sqlInch = "SELECT * 
                FROM product_details 
                WHERE attribute_name = 'inch' 
                AND product_id = ?";
            $selectedInch = DB::select($sqlInch, [$product->product_id]);
    
            // Chuyển đổi dữ liệu từ bảng product_details sang dạng mảng
            $selectedColorsArray = array_map(function ($item) {
                return $item->attribute_value;
            }, $selectedColors);
    
            $selectedWeightArray = array_map(function ($item) {
                return $item->attribute_value;
            }, $selectedWeight);
    
            $selectedInchArray = array_map(function ($item) {
                return $item->attribute_value;
            }, $selectedInch);
        }
    
        // Trả về view với các biến cần thiết
        return view('admin.editproduct', compact(
            'product',
            'categories',
            'subcategories',
            'brands',
            'stores',
            'selectedColorsArray',
            'selectedWeightArray',
            'selectedInchArray'
        ));
    }
    




    public function update(Request $request, $id)
    {
       
        $product = Product::findOrFail($id);
    
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->subcategory_id = $request->input('subcategory_id');
        $product->brand_id = $request->input('brand_id');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->price_sale = $request->input('price_sale');
        $product->quantity = $request->input('quantity');
        $product->store_id = $request->input('store_id');
    
        // Xử lý ảnh đại diện
        if ($request->hasFile('product_avatar')) {
            if (file_exists(public_path($product->avatar_product))) {
                unlink(public_path($product->avatar_product));
            }
    
            $avatar = $request->file('product_avatar');
            $avatarName = time() . '-' . $avatar->getClientOriginalName();
            $avatar->storeAs('public/images', $avatarName);
            $product->avatar_product = 'storage/images/' . $avatarName;
        }
    
        $product->save();
    
      
        if ($request->hasFile('product_images')) {
           
            $product->images()->delete();
    
            foreach ($request->file('product_images') as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->storeAs('public/images', $imageName);
    
                $productImage = new ProductImages();
                $productImage->product_id = $product->product_id;
                $productImage->image_url = 'storage/images/' . $imageName;
                $productImage->save();
            }
        }
    
        // Cập nhật thuộc tính của sản phẩm
        $attributes = [
            'color' => $request->input('color', []),
            'weight' => $request->input('weight', []),
            'inch' => $request->input('inch', [])
        ];
    
        foreach ($attributes as $key => $values) {
            // Xóa thuộc tính cũ
            $product->details()->where('attribute_name', $key)->delete();
    
            foreach ($values as $value) {
                $productDetail = new ProductDetails();
                $productDetail->product_id = $product->product_id;
                $productDetail->attribute_name = $key;
                $productDetail->attribute_value = $value;
                $productDetail->save();
            }
        }
    
        return redirect()->back()->with('success', 'Product updated successfully.');
    }
    
    
    

}
