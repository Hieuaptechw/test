<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Categori;
use Illuminate\Http\Request;


class CategoriController extends Controller
{
    // API LIST 
    public function getlist(){
        $Category = new Categori();
        $r = $Category->getlist();
        return response()->json($r);
    }
//   VIEW LIST
    public function viewList(){
        $perPage = 5;
        $categories = Categori::orderBy('category_id', 'desc')->paginate($perPage);
        return view('admin.categories', compact('categories'));
    
    }
    // INSERT 
    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
        ]);
    
     
        $exists = Categori::where('name', $request->name)->exists();
    
        if ($exists) {
            return redirect('/admin/categories')->with('fail', 'The category name has already been taken !');
        }
  
        $category = new Categori();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->save();
 
        return redirect('/admin/categories')->with('success', 'Category added successfully !');
    }
    public function delete($id)
    {
        $category = Categori::find($id);

        if ($category) {
            $category->delete();
            return redirect('/admin/categories')->with('success', 'Category deleted successfully');
        } else {
            return redirect('/admin/categories')->with('fail', 'Category not found');
        }
    }
    public function edit($id)
    {
        $category = Categori::find($id);

        if ($category) {
            $categories = Categori::orderBy('category_id', 'desc')->paginate(5);
            return view('admin.categories', compact('categories', 'category'));
        } else {
            return redirect()->route('categories.index')->with('fail', 'Category not found');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:category,name,' . $id . ',category_id',
        ]);

        $category = Categori::find($id);

        if ($category) {
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->save();
            return redirect('/admin/categories')->with('success', 'Category updated successfully');
        } else {
            return redirect('/admin/categories')->with('fail', 'Category not found');
        }
    }

}
