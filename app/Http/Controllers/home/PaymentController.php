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

class PaymentController extends Controller
{



    public function pay()
{
    $amount = 10.00;
    $product = 'product';
    $email = 'a@a.com';
    $phone = '0123456789';
    $firstName = 'first_name';
    $lastName = 'last_name';
    $address = 'address';
    $city = 'gurgaon';
    $state = 'haryana';
    $zip = '122017';

    $merchantKey = 'cSATia';
    $merchantId = 'e0312d0497eb3362b17ac4e324ac2c5669486b2c4db4ec0c51dbb906e4fbe225';
    $payuEndpoint = 'https://test.payumoney.com/';

    $params = [
        'key' => $merchantKey,
        'txnid' => uniqid(),
        'amount' => $amount,
        'productinfo' => $product,
        'firstname' => $firstName,
        'email' => $email,
        'phone' => $phone,
        'surl' => 'http://localhost/success',
        'furl' => 'http://localhost/failure',
        'hash' => '',
    ];

    // Calculate hash
    $hashSequence = $merchantKey . '|' . $params['txnid'] . '|' . $params['amount'] . '|' . $params['productinfo'] . '|' . $params['firstname'] . '|' . $params['email'] . '|||||||||||' . $merchantKey;
    $hash = strtolower(hash('sha512', $hashSequence));
    $params['hash'] = $hash;

    $paymentUrl = $payuEndpoint . '?' . http_build_query($params);
    return redirect($paymentUrl);
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
