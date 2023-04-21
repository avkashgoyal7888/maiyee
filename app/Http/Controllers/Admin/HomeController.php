<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Head;
use Validator;

class HomeController extends Controller
{
    public function navEdit(Request $req)
    {
        $val = Validator::make($req->all(), [
            'id' => 'required|exists:heads,id',
        ]);

        if ($val->fails()) {
            return response()->json(['status'=>false, 'msg'=>$val->errors()->first()]);
        } else {

            $data = head::first();

            $data->code = $req->code;
            $data->order = $req->order;

            $up = $data->update();

            if ($up) {
                return response()->json(['status'=>true, 'msg'=>'Attorney Updated Successfully....']);
            } else {
                return response()->json(['status'=>false, 'msg'=>'Something went wrong try again later.....']);
            }
        }
    }
}
