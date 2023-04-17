<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Coupon;
use Auth;
use Validator;

class CheckOutController extends Controller
{
    public function index()
    {
        $cartNav = Cart::get();
        if(Auth::guard('web')->check()) {
        $cartNav = Cart::where('user_id', Auth::guard('web')->user()->id)->latest()->limit(2)->get();
        $cartTotalnav = $cartNav->sum('total');
        }
        $cart = Cart::where('user_id', Auth::guard('web')->user()->id)->get();
        $cartTotal = $cart->sum('total');
        return view('front.checkout.index', compact('cartNav', 'cartTotalnav','cart','cartTotal'));
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
            return response()->json(['status' => false,'msg' => 'Coupon Code is already used....',]);
        }


            $data->coupon_code = $req->coupon_code;
            $data->status = '1';
            $data->used_date = date('Y-m-d');
            $upd = $data->update();
            $cartTotal = Cart::where('user_id', Auth::guard('web')->user()->id)->sum('total');

            if ($data->coupon_type == 'amount') {
                $newCartTotal = $cartTotal - $data->coupon_amount;
            }


            if ($upd) {
                return response()->json(['status'=>true, 'msg'=>'Coupon Applied Successfully....']);
            } else {
                return response()->json(['status'=>false, 'msg'=>'Something went Wrong try again later....']);
            }
        }
    }
}
