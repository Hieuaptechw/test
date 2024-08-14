<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\admin\ProductDetails;
use App\Models\admin\ProductImages;
class Product extends Model
{
    protected $table = "products";
    protected $fillable = ['name'];
    protected $primaryKey = 'product_id';

    public function getlist()
    {
        $sql = "SELECT *
                FROM products
               ";
        $r = DB::select($sql);
        return $r;
    }

    public function insert($arrData)
    {
       DB::table($this->table)->insert($arrData);
    }
    public function images()
    {
        return $this->hasMany(ProductImages::class, 'product_id');
    }

    public function details()
    {
        return $this->hasMany(ProductDetails::class, 'product_id');
    }

}
