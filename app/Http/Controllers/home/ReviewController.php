<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Auth;
use Validator;

class ReviewController extends Controller
{
    public function reviewSubmit(Request $req)
    {
        if (Auth::guard('web')->user() != '') {
    $val = Validator::make($req->all(), [
        'title' => 'required',
        'rating' => 'required',
        'review' => 'required',
    ]);
} else {
    $val = Validator::make($req->all(), [
        'name' => 'required',
        'email' => 'required',
        'title' => 'required',
        'rating' => 'required',
        'review' => 'required',
    ]);
}

        if ($val->fails()) {
            return response()->json(['status'=>false, 'msg'=>$val->errors()->first()]);
        } else {
            $data = new Review();
            $data->product_id = $req->product_id;
            $data->name = $req->name;
            $data->email = $req->email;
            $data->title = $req->title;
            $data->rating = $req->rating;
            $data->review = $req->review;

            $send = $data->save();

            if ($send) {
                return response()->json(['status'=>true, 'msg'=>'Message Sent Successfully...']);
            } else {
                return response()->json(['status'=>false, 'msg'=>'Something went wrong. Try again later....']);
            }
        }
    }
}
