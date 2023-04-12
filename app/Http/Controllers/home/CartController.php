<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Validator;
use Hash;
use Auth;
use Session;

class CartController extends Controller
{
    public function addToCart(Request $req)
    {
        $val = Validator::make($req->all(), [
            'product_id' => 'required',
            'color_id' => 'required',
            'price' => 'required',
            'gst' => 'required',
        ]);

        if ($val->fails()) {
            return response()->json(['status'=>false, 'msg'=>$val->errors()->first()]);
        } else {

            $uid = Auth::guard('web')->user()->id;

            $data = new Cart();
            $data->product_id = $req->product_id;
            $data->size_id = null;
            $data->color_id = $req->color_id;
            $data->price = $req->price;
            $data->gst = $req->gst;
            $data->quantity = $req->quantity;
            $data->user_id = $uid;

            $ins = $data->save();

            if ($ins) {
                return response()->json(['status'=>true, 'msg'=>'Added Successfully.....']);
            } else {
                return response()->json(['status'=>false, 'msg'=>'Something went Wrong try again later....']);
            }
            

        }

    }
}
