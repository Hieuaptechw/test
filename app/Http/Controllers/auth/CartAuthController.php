<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\auth\Cart;
use App\Models\auth\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\auth\Product;

class CartAuthController extends Controller
{
    public function addToCart(Request $request)
{
    $validatedData = $request->validate([
        'product_id' => 'required|exists:products,product_id',
       'quantity' => 'required|integer|min:1',
        'color' => 'nullable|string',
        'size' => 'nullable|string',
        'weight' => 'nullable|numeric',
    ]);

    $userId = Auth::id();
    $productId = $request->input('product_id');
    $quantity = $request->input('quantity');
    $color = $request->input('color');
    $size = $request->input('size');
    $weight = $request->input('weight');
    $cart = Cart::firstOrCreate([
        'user_id' => $userId,
    ]);
    if (!$cart->cart_id) {
        return response()->json([
            'status' => false,
            'message' => 'Failed to create or find cart',
        ], 500);
    }
    $product = Product::where('product_id', $productId)->firstOrFail();

    $cartItem = CartItem::where('cart_id', $cart->cart_id)
        ->where('product_id', $productId)
        ->where('color', $color)
        ->where('size', $size)
        ->where('weight', $weight)
        ->first();

    if ($cartItem) {
        $cartItem->quantity += $quantity;
        $cartItem->save();
    } else {
        $cartItem = CartItem::create([
            'cart_id' => $cart->cart_id,
            'product_id' => $productId,
            'quantity' => $quantity,
            'price' => $product->price_sale,
            'color' => $color,
            'size' => $size,
            'weight' => $weight,
        ]);
    }

    $totalPrice = CartItem::where('cart_id', $cart->cart_id)
        ->sum(DB::raw('quantity * price'));

    $cart->total_price = $totalPrice;
    $cart->save();

    return response()->json([
        'status' => true,
        'message' => 'Product added to cart successfully',
        'cart' => $cart,
        'cartitem'=> $cartItem // Trả về cartItem vừa tạo hoặc cập nhật
    ], 200);
}



    public function productcard()
    {
        $userId = Auth::id();
        $sql = "SELECT carts.total_price,
                        products.price_sale,
                        products.name,
                        carts_items.quantity,
                        carts_items.size,
                        carts_items.color,
                        carts_items.weight,
                        products.avatar_product,
                        products.product_id  
                FROM users
                JOIN carts ON carts.user_id = users.id
                LEFT JOIN carts_items ON carts_items.cart_id = carts.cart_id
                LEFT JOIN products ON products.product_id = carts_items.product_id
                WHERE users.id = ? AND carts_items.quantity IS NOT NULL
                ";
        $pc = DB::select($sql, [$userId]);
        $cart = Cart::where('user_id', $userId)->first();
        return response()->json([
            'products' => $pc,
            'cart' => $cart
        ]);
    }
    public function deleteCart(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        
        if ($cart) {
            $productId = $request->input('product_id');
            $size = $request->input('size');
            $color = $request->input('color');
            $weight = $request->input('weight');
            
            $product = CartItem::where('cart_id', $cart->cart_id)
                ->where('product_id', $productId)
                ->where('size', $size)
                ->where('color', $color)
                ->where('weight', $weight)
                ->first();
                
            if ($product) {
                $totalUpdate = $cart->total_price - ($product->price * $product->quantity);
                CartItem::where('cart_id', $cart->cart_id)
                    ->where('product_id', $productId)
                    ->where('size', $size)
                    ->where('color', $color)
                    ->where('weight', $weight)
                    ->delete();               
                $cart->total_price = $totalUpdate;
                $cart->save();        
                return response()->json([
                    'success' => true,
                    'message' => 'Cart item removed and total price updated successfully!',
                ]);
            }
        }
        return response()->json([
            'success' => false,
            'message' => 'Cart not found.',
        ]);
    }
    
}
