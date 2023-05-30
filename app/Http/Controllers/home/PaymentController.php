<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Cart;
use App\Models\UserAddress;
use App\Models\Coupon;
use App\Models\Head;
use App\Models\Category;
use Auth;
use Validator;
use DB;
use Session;

class PaymentController extends Controller
{



    public function pay()
    {
        $payment = Order::where('user_id', Auth::guard('web')->user()->id)->orderByDesc('id')->first();
        $amount = $payment->payable;
        $product = 'product'; // You should set this to an appropriate value
        $email = $payment->email;
        $phone = $payment->contact;
        $firstName = $payment->name;
        $address = $payment->address;
        $city = $payment->city;
        $state = $payment->state;
        $zip = $payment->zip;
        $order = $payment->order_id;
        $merchantKey = 'cSATia'; // Your merchant key
        $merchantSalt = 'h4l22zSM'; // Your merchant salt
        $payuEndpoint = 'https://secure.payu.in/_payment/';

        $params = [
            'key' => $merchantKey,
            'txnid' => $order,
            'amount' => $amount,
            'productinfo' => $product,
            'firstname' => $firstName,
            'email' => $email,
            'phone' => $phone,
            'surl' => route('web.success'),
            'furl' => route('web.fail'),
            'curl' => route('web.cancel'),
            'hash' => '',
        ];

        // Calculate hash
        $hashSequence = $merchantKey . '|' . $params['txnid'] . '|' . $params['amount'] . '|' . $params['productinfo'] . '|' . $params['firstname'] . '|' . $params['email'] . '|||||||||||' . $merchantSalt;
        $hash = strtolower(hash('sha512', $hashSequence));
        $params['hash'] = $hash;

        // Temporarily disable auth middleware
        $this->middleware(\App\Http\Middleware\Authenticate::class)->except('payment.pay');

        // Store the user ID in the session to be used later
        session(['user_id' => Auth::guard('web')->user()->id]);

        return view('front.payment', ['params' => $params, 'payuEndpoint' => $payuEndpoint]);
    }

    public function orderCancel(Request $request)
    {
        $cancelData = $request->all();
        $ref = $cancelData['txnid'];
        $txnid = $cancelData['mihpayid'];
        $status = $cancelData['status'];
        $order = Order::where('order_id', $ref)->first();
        if ($order) {
            // Update the order status to indicate cancellation
            $order->txnid = $txnid;
            $order->order_status = $status;
            $order->update();
    
        }
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
            return view('front.cancel', compact('cartNav', 'cartTotalnav', 'cartCount', 'nav', 'cat', 'order'));
    }

    public function orderSuccess()
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
        $order = Order::where('user_id', Auth::guard('web')->user()->id)->orderByDesc('id')->first();
        return view('front.success',compact('cartNav','cartTotalnav','cartCount','nav','cat','order'));
    }

    public function orderFail()
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
        $order = Order::where('user_id', Auth::guard('web')->user()->id)->orderByDesc('id')->first();
        return view('front.fail',compact('cartNav','cartTotalnav','cartCount','nav','cat','order'));
    }

}
