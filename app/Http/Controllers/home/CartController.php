<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\WishList;
use App\Models\BuyNow;
use Validator;
use Hash;
use Auth;
use Session;

class CartController extends Controller
{
    public function addToWishList(Request $req)
    {
        $val = Validator::make($req->all(), [
        'product_id' => 'required|integer|unique:wish_lists,product_id,NULL,id,user_id,' . Auth::guard('web')->user()->id,
        ],[
            'product_id.unique' => 'Product is already in Wish List...'
        ]);

        if ($val->fails()) {
            return response()->json(['status'=>false, 'msg'=>$val->errors()->first()]);
        } else {
            $uid = Auth::guard('web')->user()->id;

            $data = new WishList();
            $data->user_id = $uid;
            $data->product_id = $req->product_id;
            $add = $data->save();

            if ($add) {
                return response()->json(['status'=>true, 'msg'=>'Congratulations | Added Successfully.....']);
            } else {
                return response()->json(['status'=>false, 'msg'=>'Something went wrong try again later...']);
            }
        }
    }

    public function addToCart(Request $req)
    {
        $val = Validator::make($req->all(), [
            'product_id' => 'required',
            'color_id' => 'required',
            'size_id' => 'required',
            'price' => 'required',
            'gst' => 'required',
        ],[
            'color_id.required' => 'Select Your Color...',
            'size_id.required' => 'Select Your Size...']);

        if ($val->fails()) {
            return response()->json(['status'=>false, 'msg'=>$val->errors()->first()]);
        } else {

            $uid = Auth::guard('web')->user()->id;
            $data = new Cart();
            $data->product_id = $req->product_id;
            $data->size_id = $req->size_id;
            $data->color_id = $req->color_id;
            $data->price = $req->price;
            $data->gst = $req->gst;
            $data->quantity = $req->quantity;
            $data->total = $req->quantity*$req->price;
            $data->user_id = $uid;

            $ins = $data->save();

            if ($ins) {
                return response()->json(['status'=>true, 'msg'=>'Added Successfully.....']);
            } else {
                return response()->json(['status'=>false, 'msg'=>'Something went Wrong try again later....']);
            }
            

        }
    }

    public function buyNow(Request $req)
    {
        $val = Validator::make($req->all(), [
            'product_id' => 'required',
            'color_id' => 'required',
            'size_id' => 'required',
            'price' => 'required',
            'gst' => 'required',
        ],[
            'color_id.required' => 'Select Your Color...',
            'size_id.required' => 'Select Your Size...']);

        if ($val->fails()) {
            return response()->json(['status'=>false, 'msg'=>$val->errors()->first()]);
        } else {

            $uid = Auth::guard('web')->user()->id;
            $data = new BuyNow();
            $data->product_id = $req->product_id;
            $data->size_id = $req->size_id;
            $data->color_id = $req->color_id;
            $data->price = $req->price;
            $data->gst = $req->gst;
            $data->quantity = $req->quantity;
            $data->total = $req->quantity*$req->price;
            $data->user_id = $uid;

            $ins = $data->save();

            if ($ins) {
                return response()->json(['status'=>true, 'msg'=>'Added Successfully.....']);
            } else {
                return response()->json(['status'=>false, 'msg'=>'Something went Wrong try again later....']);
            }
            

        }
    }

    public function cartEdit(Request $req)
    {
        $val = Validator::make($req->all(), [
            'id' => 'required|exists:carts,id',
        ]);

        if ($val->fails()) {
            return response()->json(['status'=>false, 'msg'=>$val->errors()->first()]);
        } else {
            $data = Cart::findOrFail($req->id);
            $data->quantity = $req->quantity;
            $data->total = $req->quantity*$data->price;
            $up = $data->update();

            if ($up) {
                return response()->json(['status'=>true, 'msg'=>'Updated Successfully....']);
            } else {
                return response()->json(['status'=>false, 'msg'=>'Something went wrong try again later.....']);
            }
        }
    }

    public function cartDelete(Request $req)
    {
        $val = Validator::make($req->all(), [
            'id' => 'required|exists:carts,id',
        ]);

        if ($val->fails()) {
            return response()->json(['status'=>false, 'msg'=>$val->errors()->first()]);
        } else {

            $rem = Cart::findOrFail($req->id);

            $del = $rem->delete();

            if ($del) {
                return response()->json(['status'=>true,'msg'=>'deleted Successfully.....']);
            } else {
                return response()->json(['status'=>false, 'msg'=>'Something went wrong try again later....']);
            }
        }
    }
}
