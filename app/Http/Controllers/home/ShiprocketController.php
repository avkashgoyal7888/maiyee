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

class ShiprocketController extends Controller
{
    public function createOrder(Request $req)
{
    $client = new Client([
        'base_uri' => 'https://apiv2.shiprocket.in/v1/',
        'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic '.base64_encode('<tech@maiyee.in>:<Eduse@123>')
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

        $user_id = Auth::guard('web')->user()->id;
        $cart = Cart::where('user_id', $user_id)->get();
        $order_id = mt_rand(11111111, 99999999);
        
        $order_details = [];
        foreach ($cart as $cart_item) {
            if ($req->addressid != '') {
            $useradd = UserAddress::where('id', $req->addressid)->first();
            $state = $useradd->state;
        } else {
            $state = $req->state;
        }
        $var1 = $cart_item->product->discount *100;
        $var2 = 100+$cart_item->product->gst_rate;
        $price =  $var1/$var2;
        $taxable = $cart_item->quantity * $price;
        $tax = $taxable * $cart_item->gst / 100;
        
        if ($state == "Gujarat") {
            $cgst = $tax / 2;
            $sgst = $tax / 2;
            $igst = 0;
        } else {
            $cgst = 0;
            $sgst = 0;
            $igst = $tax;
        }
        
        $total = $taxable + $tax;
        
            $order_detail = new OrderDetail([
                'order_id' => $order_id,
                'user_id' => $user_id,
                'product_id' => $cart_item->product_id,
                'color_id' => $cart_item->color_id,
                'size_id' => $cart_item->size_id,
                'taxable' => $taxable,
                'price' => $price,
                'gst' => $cart_item->gst,
                'quantity' => $cart_item->quantity,
                'total' => $total,
                'cgst' => $cgst,
                'sgst' => $sgst,
                'igst' => $igst,
            ]);
        
            $order_detail->save();
        
            $order_details[] = $order_detail;
        }


        if ($req->coupon_code != '') {
            $data = Coupon::where('coupon_code', $req->coupon_code)->first();

        if ($data->status == 1) {
            $val->errors()->add('status', 'Coupon Code is already used.');
            return response()->json(['status' => false,'msg' => 'Coupon Code is already used....',]);
        }
        
            $cartTotal = OrderDetail::where('user_id', Auth::guard('web')->user()->id)->sum('total');
        
            if ($data->coupon_type == 'amount') {
                $discount = $data->coupon_price;
                $newCartTotal = max($cartTotal - $discount, 0);
            }
        
            if ($data->coupon_type == '%') {
                $discount = $cartTotal * ($data->coupon_price / 100);
                $newCartTotal = max($cartTotal - $discount, 0);
            }
        } else {
            $discount = 0;
            $total = OrderDetail::where('user_id', Auth::guard('web')->user()->id)->sum('total');
            $newCGST = OrderDetail::where('user_id', Auth::guard('web')->user()->id)->sum('cgst');
            $newSGST = OrderDetail::where('user_id', Auth::guard('web')->user()->id)->sum('sgst');
            $newIGST = OrderDetail::where('user_id', Auth::guard('web')->user()->id)->sum('igst');
            $taxable = OrderDetail::where('user_id', Auth::guard('web')->user()->id)->sum('taxable');
            $payable = $total - $discount + 100;
        }
            

//                 product = hsn

// price = discount_price *100 /100+gst_rate 

// taxable = quantity * price
// tax = taxable*gst_rate/100
// cgst = tax/2
// sgst = tax/2
// igst = tax

// total = taxable + tax

// cart = taxable cgst sgst igst

// coupon amount will - from taxable  in %
        
        $order = new Order();
        $order->order_id = $order_id;
        $order->user_id = $user_id;
        $order->name = Auth::guard('web')->user()->name;
        $order->contact = Auth::guard('web')->user()->number;
        $order->email = Auth::guard('web')->user()->email;
        $order->order_date = date('Y-m-d');
        $order->taxable = $taxable;
        $order->discount = $discount;
        $order->coupon_code = $req->coupon_code;;
        if ($req->addressid != '') {
            $useradd = UserAddress::where('id', $req->addressid)->first();
            $order->address = $useradd->address;
        $order->landmark = $useradd->landmark;
        $order->state = $useradd->state;
        $order->city = $useradd->city;
        $order->order_notes = $req->order_notes;
        } else {
        $order->address = $req->address;
        $order->landmark = $req->landmark;
        $order->state = $req->state;
        $order->city = $req->city;
        $order->order_notes = $req->order_notes;
        }
        $order->cgst = $newCGST;
        $order->sgst = $newSGST;
        $order->igst = $newIGST;
        $order->total = $total;
        $order->payable = $payable;
        // $order->shipping_charges = $order_detail->shipping_charges;
        $order->payment_method = 'CASH';
        $order->order_status = 'placed';
        $order->save();

        print_r($order); exit();
        $order_items = [];
        foreach ($order_details as $order_detail) {
            $order_items[] = [
                'name' => $order_detail->product_id,
                'sku' => $order_detail->quantity,
                'units' => $order_detail->quantity,
                'selling_price' => $order_detail->price,
                'discount' => 0.00,
                'tax' => 0.00,
            ];
        }

        if ($req->addressid != '') {
            $useradd = UserAddress::where('id', $req->addressid)->first();
        } else {
            $useradd = new UserAddress();
            $useradd->user_id = Auth::guard('web')->user()->id;
            $useradd->name = $req->name;
            $useradd->email = $req->email;
            $useradd->contact = $req->contact;
            $useradd->address = $req->address;
            $useradd->landmark = $req->landmark;
            $useradd->state = $req->state;
            $useradd->city = $req->city;
            $useradd->pin_code = $req->pin_code;
            if (isset($req->saveaddress) && $req->saveaddress == 'checked') {
                $useradd->save();
            }

        }

        
        $orderData = [
            'order_id' => $order->order_id,
            'order_date' => $order->order_date,
            'billing_customer_name' => $useradd->name,
            'billing_last_name' => '',
            'billing_address' => $useradd->address,
            'billing_city' => $useradd->city,
            'billing_pincode' => $useradd->pin_code,
            'billing_state' => $useradd->state,
            'billing_country' => 'INDIA',
            'billing_email' => $useradd->email,
            'billing_phone' => $useradd->contact,
            'shipping_is_billing' => true,
            'order_items' => $order_items,
            'payment_method' => 'COD',
            'shipping_charges' => 50.00,
            'giftwrap_charges' => 0.00,
            'transaction_charges' => 0.00,
            'total_discount' => 0.00,
            'sub_total' => 100.00,
            'length' => 10.00,
            'breadth' => 10.00,
            'height' => 10.00,
            'weight' => 10.00,
        ];
        // Create the order
        $response = $client->post('external/orders/create/adhoc', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$access_token,
            ],
            'json' => $orderData,
        ]);

        if ($response->getStatusCode() == 200) {
            $result = json_decode($response->getBody()->getContents());
            // Handle the successful order placement
            echo "Order created with ID: " . $order_id;
        } else {
            $result = json_decode($response->getBody()->getContents());
            $error_message = $result->message;
            // Handle the error
            echo "Error creating order: " . $error_message;
        }
    } else {
        // Handle the authentication error
        echo "Error authenticating with Shiprocket API";
    }
}



}
