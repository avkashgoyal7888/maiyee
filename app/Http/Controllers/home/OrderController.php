<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    public function orders()
    {
        $cartNav = Cart::get();
        $cartTotalnav = 0;
        $cartCount = 0;
        if(Auth::guard('web')->check()) {
        $cartNav = Cart::where('user_id', Auth::guard('web')->user()->id)->latest()->limit(2)->get();
        $cartCount = Cart::where('user_id', Auth::guard('web')->user()->id)->count();
        $cartTotalnav = $cartNav->sum('total');
        }
        $nav = Head::first();
        $cat = Category::get();
        $order = Order::where(['user_id' => Auth::guard('web')->user()->id, 'order_status'=>'success'])->orderByDesc('id')->get();
        $orderdetail = OrderDetail::get();
        return view('front.orders',compact('cartNav','cartTotalnav','cartCount','nav','cat','order', 'orderdetail'));
    }
}
