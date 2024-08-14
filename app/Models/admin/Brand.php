<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Brand extends Model
{
    use HasFactory;
    protected $table = "brands";
    protected $fillable = ['name'];
    protected $primaryKey = 'brand_id';
    public function getlist()
    {
        $sql = "SELECT
        c.name,
        b.brand_id,
        b.name
        FROM
        products p
        JOIN
        categories c ON p.category_id = c.category_id
        JOIN
        brands b ON p.brand_id = b.brand_id
        GROUP BY
        c.name, b.brand_id, b.name
        ";
        $r = DB::select($sql);
        return $r;
    }


}
