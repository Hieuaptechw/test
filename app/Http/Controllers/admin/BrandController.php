<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Brand;

class BrandController extends Controller
{

    public function getlist()
    {
        $brands = Brand::all(); 
        return response()->json($brands);
    }


    public function viewList()
    {
        $perPage = 5;
        $brands = Brand::orderBy('brand_id', 'desc')->paginate($perPage); // Variable name changed to plural for clarity
        return view('admin.brand', compact('brands'));
    }


    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $exists = Brand::where('name', $request->name)->exists();

        if ($exists) {
            return redirect('/admin/brand')->with('fail', 'The brand name has already been taken!');
        }

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->save();

        return redirect('/admin/brand')->with('success', 'Brand added successfully!');
    }


    public function delete($id)
    {
        $brand = Brand::find($id);

        if ($brand) {
            $brand->delete();
            return redirect('/admin/brand')->with('success', 'Brand deleted successfully');
        } else {
            return redirect('/admin/brand')->with('fail', 'Brand not found');
        }
    }

  
    public function edit($id)
    {
        $brand = Brand::find($id);

        if ($brand) {
            $brands = Brand::orderBy('brand_id', 'desc')->paginate(5); 
            return view('admin.brand', compact('brand', 'brands'));
        } else {
            return redirect('/admin/brand')->with('fail', 'Brand not found');
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brand,name,' . $id . ',brand_id',
        ]);

        $brand = Brand::find($id);

        if ($brand) {
            $brand->name = $request->name;
            $brand->save();
            return redirect('/admin/brand')->with('success', 'Brand updated successfully');
        } else {
            return redirect('/admin/brand')->with('fail', 'Brand not found');
        }
    }
}
