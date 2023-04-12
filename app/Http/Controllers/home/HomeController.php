<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Size;
use App\Models\Color;
use Validator;
use Hash;
use Auth;
use Session;

class HomeController extends Controller
{
    public function index()
    {
        $banner = Banner::get();
        $product = Product::get();
        $color = Color::whereIn('product_id', $product->pluck('id'))->get();
        $size = Size::whereIn('product_id', $product->pluck('id'))
        ->whereIn('color_id', $color->pluck('id'))
        ->get();

        return view('front.home',compact('banner','product', 'color','size'));
    }

    public function register()
    {
        return view('front.auth.register');
    }

    public function disclaimer()
    {
        return view('front.disclaimer');
    }

    public function policy()
    {
        return view('front.policy');
    }

    public function refund()
    {
        return view('front.refund');
    }

    public function shipping()
    {
        return view('front.shipping');
    }

    public function cart()
    {
        return view('front.cart');
    }

    public function loginSubmit(Request $req)
    {
        $val = Validator::make($req->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($val->fails()) {
            return response()->json(['status'=>false, 'msg'=>$val->errors()->first()]);
        }
        if (Auth::guard('web')->attempt(['email'=>$req->email, 'password'=>$req->password])) {
            return response()->json(['status'=>true, 'msg'=>'Logged in Successfully.....']);
        } else {
            return response()->json(['status'=>false, 'msg'=>'Invalid User Id or password.....']);
        }

    }

    public function registerSubmit(Request $req)
    {
    
        $validator = Validator::make(
            $req->all(),
            [
                "name" => "required",
                "email" => "required|unique:users,email",
                "number" => "required|unique:users,number",
                "password" => "required|min:6",
                "confirm_password" => "required|same:password",
            ],
            [
                "name.required" => "Name can not be Blank",
                "email.required" => "Email Id can not be Blank",
                "email.unique" => "Email Id is already registered...",
                "number.required" => "Contact Number can not be Blank",
                "number.unique" => "Contact Number is already registered...",
                "password.required" => "Password Can not be blank",
                "password.min" => "Password Should be minimum 6 characters",
                "confirm_password.required" => "Confirm password can not be blank",
                "confirm_password.same" => "Confirm password does not match"
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                "status" => 400,
                "nameError" => $validator->errors()->first('name'),
                "numberError" => $validator->errors()->first('number'),
                "emailError" => $validator->errors()->first('email'),
                "passwordError" => $validator->errors()->first('password'),
                "confpasswordError" => $validator->errors()->first('confirm_password'),
            ]);
        } else {
            $data = new User;

            $data->name = $req->name;
            $data->number = $req->number;
            $data->email = $req->email;
            $data->password = Hash::make($req->password); // Save the hashed password
            $reg = $data->save();
    
            if ($reg) {
                return response()->json(['status' => 200, 'message' => 'Registerd Successfully']);
            } else {
                return response()->json(['status' => 400, 'message' => 'Something went Wrong try again later....']);
            }
        }
    }

    public function logOut()
    { 
        Auth::guard('web')->logOut();
        Session::flush();
        return redirect()->route('web.home');
    }
}
