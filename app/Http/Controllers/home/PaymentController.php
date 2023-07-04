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
use App\Models\BuyNow;
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
            'curl' => route('web.success'),
            'hash' => '',
        ];
        $hashSequence = $merchantKey . '|' . $params['txnid'] . '|' . $params['amount'] . '|' . $params['productinfo'] . '|' . $params['firstname'] . '|' . $params['email'] . '|||||||||||' . $merchantSalt;
        $hash = strtolower(hash('sha512', $hashSequence));
        $params['hash'] = $hash;
        $this->middleware(\App\Http\Middleware\Authenticate::class)->except('payment.pay');
        session(['user_id' => Auth::guard('web')->user()->id]);
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

        return view('front.payment', ['params' => $params, 'payuEndpoint' => $payuEndpoint], compact('cartNav', 'cartTotalnav', 'cartCount', 'nav', 'cat', 'payment'));
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

    public function orderSuccess(Request $request)
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

        $client = new Client([
            'base_uri' => 'https://apiv2.shiprocket.in/v1/',
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode('<tech@maiyee.in>:<Eduse@123>')
            ]
        ]);
        // Authenticate the user
        $response = $client->post('external/auth/login', [
            'json' => [
                'email' => 'tech@maiyee.in',
                'password' => 'Eduse@123',
            ]
        ]);

        if ($response->getStatusCode() == 200) {
            $result = json_decode($response->getBody()->getContents());
            $access_token = $result->token;
            $order_details = OrderDetail::where('order_id', $ref)->get();

            $order_items = [];
            foreach ($order_details as $order_detail) {
                $order_items[] = [
                    'name' => $order_detail->product->name,
                    'sku' => $order_detail->product->style_code,
                    'units' => $order_detail->quantity,
                    'selling_price' => $order_detail->price,
                    'discount' => 0.00,
                    'tax' => 0.00,
                ];
            }
            $orderData = [
                'order_id' => $order->order_id,
                'order_date' => $order->order_date,
                'billing_customer_name' => $order->name,
                'billing_last_name' => '',
                'billing_address' => $order->address,
                'billing_city' => $order->city,
                'billing_pincode' => $order->pin_code,
                'billing_state' => $order->state,
                'billing_country' => 'INDIA',
                'billing_email' => $order->email,
                'billing_phone' => $order->contact,
                'shipping_is_billing' => true,
                'order_items' => $order_items,
                'payment_method' => 'prepaid',
                'shipping_charges' => 0.00,
                'giftwrap_charges' => 0.00,
                'transaction_charges' => 0.00,
                'total_discount' => 0.00,
                'sub_total' => $order->payable,
                'length' => 12.00,
                'breadth' => 10.00,
                'height' => 1.00,
                'weight' => 0.300,
            ];
            $response = $client->post('external/orders/create/adhoc', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $access_token,
                ],
                'json' => $orderData,
            ]);
            if ($response->getStatusCode() == 200) {
                if ($order->buy_mode == '1' && $order->order_id == $ref) {
                    BuyNow::where('user_id', $order->user_id)->delete();
                } elseif ($order->buy_mode == '0' && $order->order_id == $ref) {
                    Cart::where('user_id', $order->user_id)->delete();
                }

            }
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
        $order = Order::where('user_id', Auth::guard('web')->user()->id)->orderByDesc('id')->first();
        return view('front.success', compact('cartNav', 'cartTotalnav', 'cartCount', 'nav', 'cat', 'order'));
    }

    public function orderFail(Request $request)
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
        $order = Order::where('user_id', Auth::guard('web')->user()->id)->orderByDesc('id')->first();
        return view('front.fail', compact('cartNav', 'cartTotalnav', 'cartCount', 'nav', 'cat', 'order'));
    }

    public function orderCOD()
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
        $order = Order::where('user_id', Auth::guard('web')->user()->id)->orderByDesc('id')->first();
        return view('front.cod', compact('cartNav', 'cartTotalnav', 'cartCount', 'nav', 'cat', 'order'));
    }

}