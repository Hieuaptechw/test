<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'total_price','status','shipping_address','notes','order_code'];
    protected $hidden = [
        'updated_at',
        'created_at',
    ];
    protected $primaryKey = 'order_id';

   
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}
