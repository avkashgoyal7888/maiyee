<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Head;
use App\Models\Exchange;
use Auth;
use Validator;
use DB;

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
        $ex = Exchange::whereIn('order_id', $orderdetail->pluck('order_id'))
        ->get();
        return view('front.orders',compact('cartNav','cartTotalnav','cartCount','nav','cat','order', 'orderdetail','ex'));
    }

    public function returnOrReplace(Request $req)
    {
        $val = Validator::make($req->all(), [
            'option' => 'required',
            'reason' => 'required',
            'order_id' => 'unique:exchanges,order_id',
        ], [
            'option.required' => 'Select One Return or Replace...',
            'reason.required' => 'Reason is Required...',
            'order_id.unique' => 'Request Already Raised wait for response...'
        ]);

        if ($val->fails()) {
            return response()->json(['status'=>false, 'msg'=>$val->errors()->first()]);
        } else {
            $order = orderdetail::where('id', $req->returnid)->first();
            $data = new Exchange();
            $data->order_id = $req->order_id;
            $data->user_id = $order->user_id;
            $data->product_id = $order->product_id;
            $data->color_id = $order->color_id;
            $data->size_id = $order->size_id;
            $data->price = $order->price;
            $data->quantity = $order->quantity;
            $data->taxable = $order->taxable;
            $data->gst = $order->gst;
            $data->cgst = $order->cgst;
            $data->sgst = $order->sgst;
            $data->igst = $order->igst;
            $data->total = $order->total;
            $data->option = $req->option;
            $data->reason = $req->reason;
            $data->return_payment = $req->return_payment;
            $return = $data->save();

            if ($return) {
                return response()->json(['status'=>true, 'msg'=>'Success...']);
            } else {
                return response()->json(['status'=>false, 'msg'=>'Something went wrong try again later...']);
            }

        }
    }
}
