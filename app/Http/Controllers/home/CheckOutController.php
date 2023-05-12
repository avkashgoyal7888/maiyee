<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\UserAddress;
use App\Models\Head;
use App\Models\Category;
use Auth;
use Validator;

class CheckOutController extends Controller
{
    public function index()
    {
        $cartNav = Cart::get();
        $cartCount = 0;
        if(Auth::guard('web')->check()) {
        $cartNav = Cart::where('user_id', Auth::guard('web')->user()->id)->latest()->limit(2)->get();
        $cartCount = Cart::where('user_id', Auth::guard('web')->user()->id)->count();
        $cartTotalnav = $cartNav->sum('total');
        }
        $cart = Cart::where('user_id', Auth::guard('web')->user()->id)->get();
        $cartTotal = $cart->sum('total');
        $user = UserAddress::where('user_id', Auth::guard('web')->user()->id)->get();
        $nav = Head::first();
        $cat = Category::get();
        $coupon = Coupon::where(['type'=>'admin','status'=>'0'])->get();
        return view('front.checkout.index', compact('cartNav', 'cartTotalnav','cart','cartTotal','user','cartCount','nav','nav','cat','coupon'));
    }

    public function applyCoupon(Request $req)
    {
        $val = Validator::make($req->all(), [
            'coupon_code' => 'required|exists:coupons,coupon_code',
            'status' => 'in:0,1'
        ],[
            'coupon_code.required' => 'Coupon Code can not be blank...',
            'coupon_code.exists' => 'Your Coupon Code is Wrong. Try Another One....',
            'status.in.1' => 'Coupon Code is already used....',
        ]);

        if($val->fails())
        {
            return response()->json(['status'=>false, 'msg'=>$val->errors()->first()]);
        } else {

            $data = Coupon::where('coupon_code',$req->coupon_code)->first();
            if ($data->status == 1) {
            $val->errors()->add('status', 'Coupon Code is already used.');
            $req->coupon_code = '';
            return response()->json(['status' => false,'msg' => 'Coupon Code is already used....',]);
        }

        if (strtotime($data->exp_date) < strtotime(date('Y-m-d'))) {
            $val->errors()->add('status', 'Coupon Code has expired.');
            $req->coupon_code = '';
            return response()->json(['status' => false, 'msg' => 'Coupon Code has expired.']);
            }


            $data->coupon_code = $req->coupon_code;
            $upd = $data;
            $cartTotal = Cart::where('user_id', Auth::guard('web')->user()->id)->sum('total');

            if ($data->order_value < $cartTotal) {
            $val->errors()->add('status', 'Coupon Code Value is less your total.');
            $req->coupon_code = '';
            return response()->json(['status' => false,'msg' => 'Coupon Code Value is less your total.',]);
        }

             if($data->coupon_type == 'amount') {
                $newCartTotal = $cartTotal - $data->coupon_price;
                }

                if($data->coupon_type == '%') {
                $newCartTotal = $cartTotal - ($cartTotal * ($data->coupon_price / 100));
                }


            if ($upd) {
                if($data->coupon_type == 'amount') {
                    $newCartTotal = $cartTotal - $data->coupon_price;
                    $discount = $data->coupon_price;
                }
                if($data->coupon_type == '%') {
                    $discount = $cartTotal * ($data->coupon_price / 100);
                    $newCartTotal = $cartTotal - $discount;
                }
                return response()->json([
                    'status'=>true,
                    'msg'=>'Coupon Applied Successfully....',
                    'discount' => $discount,
                    'newCartTotal' => $newCartTotal
                ]);
                } else {
                    return response()->json(['status'=>false, 'msg'=>'Something went Wrong try again later....']);
            }
        }
    }
}
