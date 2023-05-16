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
use Auth;
use Validator;
use DB;
use Session;

class PaymentController extends Controller
{



    public function pay()
{
    $payment = Order::where('user_id', Auth::guard('web')->user()->id)->first();
    $amount = $payment->payable;
    $product = 'product'; // You should set this to an appropriate value
    $email = $payment->email;
    $phone = $payment->contact;
    $firstName = $payment->name;
    $address = $payment->address;
    $city = $payment->city;
    $state = $payment->state;
    $zip = $payment->zip;

    $merchantKey = 'cSATia'; // Your merchant key
    $merchantSalt = 'h4l22zSM'; // Your merchant salt
    $payuEndpoint = 'https://secure.payu.in/_payment/';

    $params = [
        'key' => $merchantKey,
        'txnid' => uniqid(),
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



    public function success(Request $request)
    {
        return "Payment success";
    }
    
    public function failure(Request $request)
    {
        return "Payment failure";
    }
    
    public function cancel(Request $request)
    {
        return "Payment canceled";
    }


}
