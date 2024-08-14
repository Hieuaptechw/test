<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Subcategori;
use App\Models\admin\Categori;
use Illuminate\Http\Request;

class SubcategoriController extends Controller
{
    // API LIST 
      public function category()
    {
        return $this->belongsTo(Categori::class, 'category_id', 'category_id');
    }
    public function getlist()
    {
        $Subcategory = new Subcategori();
        $r = $Subcategory->getlist();
        return response()->json($r);
    }

    // VIEW LIST
    public function viewList()
    {
        $perPage = 5;
        $subcategories = Subcategori::select('subcategories.*', 'categories.name as category_name')
            ->leftJoin('categories', 'subcategories.category_id', '=', 'categories.category_id')
            ->orderBy('subcategories.subcategory_id', 'desc')
            ->paginate($perPage);

        $categories = Categori::all();
        return view('admin.subcategories', compact('subcategories', 'categories'));
    }

    // INSERT 
    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
        ]);

        $exists = Subcategori::where('name', $request->name)->exists();

        if ($exists) {
            return redirect('/admin/subcategories')->with('fail', 'The subcategory name has already been taken!');
        }

        $Subcategory = new Subcategori();
        $Subcategory->name = $request->name;
        $Subcategory->category_id = $request->category_id;
        $Subcategory->save();

        return redirect('/admin/subcategories')->with('success', 'Subcategory added successfully!');
    }

    // DELETE
    public function delete($id)
    {
        $Subcategory = Subcategori::find($id);

        if ($Subcategory) {
            $Subcategory->delete();
            return redirect('/admin/subcategories')->with('success', 'Subcategory deleted successfully');
        } else {
            return redirect('/admin/subcategories')->with('fail', 'Subcategory not found');
        }
    }

    // EDIT
    public function edit($id)
    {
        $subcategory = Subcategori::find($id);
        $categories = Categori::all();
        $subcategories = Subcategori::orderBy('subcategory_id', 'desc')->paginate(5);

        if ($subcategory) {
            return view('admin.subcategories', compact('subcategory', 'categories', 'subcategories'));
        } else {
            return redirect('/admin/subcategories')->with('fail', 'Subcategory not found');
        }
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:subcategories,name,' . $id . ',subcategory_id',
            'category_id' => 'required|integer',
        ]);

        $Subcategory = Subcategori::find($id);

        if ($Subcategory) {
            $Subcategory->name = $request->name;
            $Subcategory->category_id = $request->category_id;
            $Subcategory->save();
            return redirect('/admin/subcategories')->with('success', 'Subcategory updated successfully');
        } else {
            return redirect('/admin/subcategories')->with('fail', 'Subcategory not found');
        }
    }
}
