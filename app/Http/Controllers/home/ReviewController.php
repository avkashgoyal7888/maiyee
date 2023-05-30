<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\ReviewImage;
use Auth;
use Validator;

class ReviewController extends Controller
{
    public function reviewSubmit(Request $req)
    {
        if (Auth::guard('web')->user() != '') {
            $val = Validator::make($req->all(), [
                'rating' => 'required',
            ]);
        } else {
            $val = Validator::make($req->all(), [
                'rating' => 'required',
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
                $images = $req->file('image');
            if($images) {
                $count = 0;
            foreach ($images as $image) {
                $ext = $image->getClientOriginalExtension();
                $name = uniqid() . '_' . $count . '.' . $ext;
                $count++;
                $image->move(public_path('admin/review'), $name);

                $reviewImage = new ReviewImage();
                $reviewImage->review_id = $data->id;
                $reviewImage->product_id = $data->product_id;
                $reviewImage->image = $name;
                $ins = $reviewImage->save();
            }
        }
        
            if ($ins) {
                return response()->json(['status'=>true, 'msg'=>'Message Sent Successfully...']);
            } else {
                return response()->json(['status'=>false, 'msg'=>'Something went wrong. Try again later....']);
            }
        }
    }
}
