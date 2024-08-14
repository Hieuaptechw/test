<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\auth\Cart;
use App\Models\auth\CartItem;
use App\Models\auth\OrderItem;
use App\Models\auth\Product;
use App\Models\auth\Payment;
use Illuminate\Support\Str;

use App\Models\auth\Order;
use Illuminate\Support\Facades\Auth;

class OrderAuthController extends Controller
{
    public function createOrder(Request $request)
    {
        $user = Auth::user();    
        $cart = Cart::where('user_id', $user->id)->first();      
        if ($cart) {
            $shipping_address = $request->input('shipping_address');
            $orderCode =  strtoupper(Str::random(4)) . rand(1000, 9999);
            $notes = $request->input('notes', '');  
            $payment_method = $request->input('payment');         
            $total_price = $cart->total_price; 
            if ($total_price <= 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'The cart has no products.',
                ], 400); 
            }     
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $total_price,
                'shipping_address' => $shipping_address,
                'order_code' => $orderCode,
                'notes' => $notes,
                'status' => 'pending', 
            ]);
            $payment = Payment::create([
                'order_id' => $order->order_id,
                'payment_method' => $payment_method,
                'payment_status' => 'pending', 
         
            ]);
        
            $cartItems = CartItem::where('cart_id', $cart->cart_id)->get();
            $cart->total_price = 0;
            $cart->save();
            foreach ($cartItems as $item) {
                $product = Product::find($item->product_id);
                
                OrderItem::create([
                    'order_id' => $order->order_id,
                    'product_id' => $product->product_id,
                    'quantity' => $item->quantity,
                    'price' => $product->price_sale,
                ]);
            }
            CartItem::where('cart_id', $cart->cart_id)->delete();
            $cart->total_price = 0;
            $cart->save();
            return response()->json([
                'success' => true,
                'order' => $order,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cart not found',
            ], 404);
        }
    }
    public function getUserOrders()
    {
        $user = Auth::user();
    

        $orders = Order::where('user_id', $user->id)->with('orderItems.product')->get();
    
        return response()->json([
            'success' => true,
            'orders' => $orders,
        ]);
    }
    public function getOrderDetails($order_id)
    {
        $order = Order::with('orderItems')->find($order_id);

        if ($order) {
            return response()->json([
                'order' => $order,
                'orderItems' => $order->orderItems
            ]);
        } else {
            return response()->json(['message' => 'Order not found'], 404);
        }
    }
}
