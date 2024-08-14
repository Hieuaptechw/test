<?php

namespace App\Http\Controllers\admin;
use App\Models\admin\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function viewList()

    {
    $perPage = 5;

    $users = DB::table('users')
        ->leftJoin('orders', 'users.id', '=', 'orders.user_id')
        ->leftJoin('carts', 'users.id', '=', 'carts.cart_id')
        ->leftJoin('carts_items', 'carts.cart_id', '=', 'carts_items.cart_id')
        ->select(
            'users.id',
            'users.name',
            'users.email',
            'users.phone',
            'users.address',
            DB::raw('COUNT(DISTINCT orders.order_id) AS total_orders'),
            DB::raw('COUNT(DISTINCT carts_items.cart_items_id) AS total_cart_items')
        )
        ->groupBy('users.id', 'users.name', 'users.email', 'users.phone', 'users.address')
        ->orderBy('users.id', 'desc')
        ->paginate($perPage);
        $perPage = 5;
        return view('admin.listuser', compact('users'));
    }
}
