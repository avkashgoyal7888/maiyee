<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\UserAddress;
use App\Models\Head;
use App\Models\Category;
use App\Models\BuyNow;
use Auth;
use Validator;
use PDF;

class CheckOutController extends Controller
{
    public function index()
    {
        $cartNav = Cart::get();
        $cartCount = 0;
        if (Auth::guard('web')->check()) {
            $cartNav = Cart::where('user_id', Auth::guard('web')->user()->id)->latest()->limit(2)->get();
            $cartCount = Cart::where('user_id', Auth::guard('web')->user()->id)->count();
            $cartTotalnav = $cartNav->sum('total');
        }
        $cart = Cart::where('user_id', Auth::guard('web')->user()->id)->get();
        $cartTotal = $cart->sum('total');
        if ($cartTotal < 2000) {
            $cartTotal += 99;
        }
        $user = UserAddress::where('user_id', Auth::guard('web')->user()->id)->get();
        $nav = Head::first();
        $cat = Category::get();
        $coupon = Coupon::where(['type' => 'admin', 'status' => '0'])->get();
        return view('front.checkout.index', compact('cartNav', 'cartTotalnav', 'cart', 'cartTotal', 'user', 'cartCount', 'nav', 'nav', 'cat', 'coupon'));
    }

    public function buyView()
    {
        $cartNav = Cart::get();
        $cartCount = 0;
        if (Auth::guard('web')->check()) {
            $cartNav = Cart::where('user_id', Auth::guard('web')->user()->id)->latest()->limit(2)->get();
            $cartCount = Cart::where('user_id', Auth::guard('web')->user()->id)->count();
            $cartTotalnav = $cartNav->sum('total');
        }
        $cart = BuyNow::where('user_id', Auth::guard('web')->user()->id)->orderByDesc('id')->first();
        $cartTotal = $cart->total;
        if ($cartTotal < 2000) {
            $cartTotal += 99;
        }
        $user = UserAddress::where('user_id', Auth::guard('web')->user()->id)->get();
        $nav = Head::first();
        $cat = Category::get();
        $coupon = Coupon::where(['type' => 'admin', 'status' => '0'])->get();
        return view('front.checkout.buy', compact('cartNav', 'cartTotalnav', 'cart', 'cartTotal', 'user', 'cartCount', 'nav', 'nav', 'cat', 'coupon'));
    }

    public function applyCoupon(Request $req)
    {
        $val = Validator::make($req->all(), [
            'coupon_code' => 'required|exists:coupons,coupon_code',
            'status' => 'in:0,1'
        ], [
                'coupon_code.required' => 'Coupon Code can not be blank...',
                'coupon_code.exists' => 'Your Coupon Code is Wrong. Try Another One....',
                'status.in.1' => 'Coupon Code is already used....',
            ]);

        if ($val->fails()) {
            return response()->json(['status' => false, 'msg' => $val->errors()->first()]);
        } else {

            $data = Coupon::where('coupon_code', $req->coupon_code)->first();
            if ($data->status == 1) {
                $val->errors()->add('status', 'Coupon Code is already used.');
                $req->coupon_code = '';
                return response()->json(['status' => false, 'msg' => 'Coupon Code is already used....',]);
            }

            if (strtotime($data->exp_date) < strtotime(date('Y-m-d'))) {
                $val->errors()->add('status', 'Coupon Code has expired.');
                $req->coupon_code = '';
                return response()->json(['status' => false, 'msg' => 'Coupon Code has expired.']);
            }


            $data->coupon_code = $req->coupon_code;
            $upd = $data;
            $cartTotal = Cart::where('user_id', Auth::guard('web')->user()->id)->sum('total');

            if ($data->order_value > $cartTotal) {
                $val->errors()->add('status', 'Coupon Code Value is less your total.');
                $req->coupon_code = '';
                return response()->json(['status' => false, 'msg' => 'Coupon Code Value is less your total.',]);
            }

            if ($data->coupon_type == 'amount') {
                $newCartTotal = $cartTotal - $data->coupon_price;
            }

            if ($data->coupon_type == '%') {
                $newCartTotal = $cartTotal - ($cartTotal * ($data->coupon_price / 100));
            }

            if ($newCartTotal < 2000) {
                $newCartTotal += 99;
            }

            if ($upd) {
                if ($data->coupon_type == 'amount') {
                    $newCartTotal = $cartTotal - $data->coupon_price;
                    $discount = $data->coupon_price;
                }

                if ($data->coupon_type == '%') {
                    $discount = $cartTotal * ($data->coupon_price / 100);
                    $newCartTotal = $cartTotal - $discount;
                }

                if ($newCartTotal < 2000) {
                    $newCartTotal += 99;
                }

                return response()->json([
                    'status' => true,
                    'msg' => 'Coupon Applied Successfully....',
                    'discount' => $discount,
                    'newCartTotal' => $newCartTotal
                ]);
            } else {
                return response()->json(['status' => false, 'msg' => 'Something went Wrong try again later....']);
            }
        }
    }

    public function applyCouponBuy(Request $req)
    {
        $val = Validator::make($req->all(), [
            'coupon_code' => 'required|exists:coupons,coupon_code',
            'status' => 'in:0,1'
        ], [
                'coupon_code.required' => 'Coupon Code can not be blank...',
                'coupon_code.exists' => 'Your Coupon Code is Wrong. Try Another One....',
                'status.in.1' => 'Coupon Code is already used....',
            ]);

        if ($val->fails()) {
            return response()->json(['status' => false, 'msg' => $val->errors()->first()]);
        } else {

            $data = Coupon::where('coupon_code', $req->coupon_code)->first();
            if ($data->status == 1) {
                $val->errors()->add('status', 'Coupon Code is already used.');
                $req->coupon_code = '';
                return response()->json(['status' => false, 'msg' => 'Coupon Code is already used....',]);
            }

            if (strtotime($data->exp_date) < strtotime(date('Y-m-d'))) {
                $val->errors()->add('status', 'Coupon Code has expired.');
                $req->coupon_code = '';
                return response()->json(['status' => false, 'msg' => 'Coupon Code has expired.']);
            }


            $data->coupon_code = $req->coupon_code;
            $upd = $data;
            $buy = BuyNow::where('user_id', Auth::guard('web')->user()->id)->orderByDesc('id')->first();
            $cartTotal = $buy->total;

            if ($data->order_value > $cartTotal) {
                $val->errors()->add('status', 'Coupon Code Value is less your total.');
                $req->coupon_code = '';
                return response()->json(['status' => false, 'msg' => 'Coupon Code Value is less your total.',]);
            }

            if ($data->coupon_type == 'amount') {
                $newCartTotal = $cartTotal - $data->coupon_price;
            }

            if ($data->coupon_type == '%') {
                $newCartTotal = $cartTotal - ($cartTotal * ($data->coupon_price / 100));
            }

            if ($newCartTotal < 2000) {
                $newCartTotal += 99;
            }

            if ($upd) {
                if ($data->coupon_type == 'amount') {
                    $newCartTotal = $cartTotal - $data->coupon_price;
                    $discount = $data->coupon_price;
                }

                if ($data->coupon_type == '%') {
                    $discount = $cartTotal * ($data->coupon_price / 100);
                    $newCartTotal = $cartTotal - $discount;
                }

                if ($newCartTotal < 2000) {
                    $newCartTotal += 99;
                }

                return response()->json([
                    'status' => true,
                    'msg' => 'Coupon Applied Successfully....',
                    'discount' => $discount,
                    'newCartTotal' => $newCartTotal
                ]);
            } else {
                return response()->json(['status' => false, 'msg' => 'Something went Wrong try again later....']);
            }
        }
    }

    public function addressView()
    {
        $cartNav = Cart::get();
        $cartTotalnav = 0;
        $cartCount = 0;
        if (Auth::guard('web')->check()) {
            $cartNav = Cart::where('user_id', Auth::guard('web')->user()->id)->latest()->limit(2)->get();
            $cartCount = Cart::where('user_id', Auth::guard('web')->user()->id)->count();
            $cartTotalnav = $cartNav->sum('total');
        }
        $nav = Head::first();
        $cat = Category::get();
        $user = UserAddress::where('user_id', Auth::guard('web')->user()->id)->get();
        return view('front.auth.address', compact('cartNav', 'cartTotalnav', 'cartCount', 'nav', 'cat', 'user'));
    }

    public function addressSubmit(Request $req)
    {
        $val = Validator::make($req->all(), [
            'name' => 'required',
            'email' => 'required',
            'contact' => 'required|min:10',
            'address' => 'required',
            'landmark' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pin' => 'required|min:6',
        ], [
                'name.required' => 'Name cannot be blank...',
                'email.required' => 'Email cannot be blank...',
                'contact.required' => 'Contact cannot be blank...',
                'contact.min' => 'Enter a correct contact number...',
                'address.required' => 'Address cannot be blank...',
                'landmark.required' => 'Landmark cannot be blank...',
                'state.required' => 'State cannot be blank...',
                'city.required' => 'City cannot be blank...',
                'pin.required' => 'Pin Code cannot be blank...',
                'pin.min' => 'Enter a correct Pin Code...',
            ]);

        if ($val->fails()) {
            return response()->json(['status' => false, 'msg' => $val->errors()->first()]);
        } else {
            $uid = Auth::guard('web')->user()->id;

            $selectedData = $req->input('state_id');

            if ($selectedData) {
                // If the user selected existing data, update it
                $userAddress = UserAddress::find($selectedData);

                if ($userAddress) {
                    $userAddress->name = $req->name;
                    $userAddress->email = $req->email;
                    $userAddress->contact = $req->contact;
                    $userAddress->address = $req->address;
                    $userAddress->state = $req->state;
                    $userAddress->landmark = $req->landmark;
                    $userAddress->city = $req->city;
                    $userAddress->pin_code = $req->pin;
                    $userAddress->update();

                    return response()->json(['status' => true, 'msg' => 'Update....']);
                } else {
                    return response()->json(['status' => false, 'msg' => 'Something went wrong. Please try again later....']);
                }
            } else {
                UserAddress::create([
                    'user_id' => $uid,
                    'name' => $req->name,
                    'email' => $req->email,
                    'contact' => $req->contact,
                    'address' => $req->address,
                    'state' => $req->state,
                    'landmark' => $req->landmark,
                    'city' => $req->city,
                    'pin_code' => $req->pin
                ]);

                return response()->json(['status' => true, 'msg' => 'Create....']);
            }
        }
    }

    function download()
    {
        $data = [
            'title' => 'Welcome to Tutsmake.com',
            'date' => date('m/d/Y')
        ];

        $pdf = PDF::loadView('testPDF', $data);
        $pdf->setPaper('A4', 'portrait'); // Set the paper size and orientation
        // dd($pdf);

        $filename = 'tutsmake.pdf';

        return $pdf->download($filename);
    }
}