<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Categori extends Model
{
    use HasFactory;
    protected $table = "categories";
    protected $fillable = ['name'];
    protected $primaryKey = 'category_id';
    public function getlist()
    {
        $sql = "SELECT * FROM " . $this->table;
        $r = DB::select($sql);
        return $r;
    }

    public function insert($arrData)
    {
       DB::table($this->table)->insert($arrData);
    }
    
}
