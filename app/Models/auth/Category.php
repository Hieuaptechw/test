<?php

namespace App\Models\auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Category extends Model
{
    use HasFactory;
    protected $table = "categories";
    public function getCategory()
    {
        $sql = "SELECT name,slug FROM " . $this->table;
        $r = DB::select($sql);
        return $r;
    }

}
