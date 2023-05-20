<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\UserAddress;
use App\Models\Head;
use App\Models\Category;
use Auth;
use Validator;
use DB; 
use Carbon\Carbon; 
use Hash;
use Session;

class ForgetPasswordController extends Controller
{
    public function index()
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
        return view('front.auth.forget', compact('cartNav','cartTotalnav','cartCount','nav','cat'));
    }

    public function ForgetPasswordSubmit(Request $req)
    {
        $val = Validator::make($req->all(), [
            'email_or_contact' => [
                'required',
                function ($attribute, $value, $fail) {
                    $user = DB::table('users')
                                ->where('email', $value)
                                ->orWhere('number', $value)
                                ->first();
                    if (!$user) {
                        return $fail('Email or Contact is incorrect.');
                    }
                }
            ],
        ], [
            'email_or_contact.required' => 'Email or Contact is required.',
        ]);

        if ($val->fails()) {
            return response()->json(['status'=>false, 'msg'=>$val->errors()->first()]);
        } else {
            $token = mt_rand(100000, 999999);
            $emailOrContact = $req->input('email_or_contact');
            $user = User::where('email', $emailOrContact)
            ->orWhere('number', $emailOrContact)
            ->first();

            $pass = DB::table('password_reset_tokens')->insert([
                'user_id' => $user->id,
                'email' => $emailOrContact,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            if ($pass) {
                session()->put(['user_id' => $user->id, 'email'=>$emailOrContact, 'token'=>$token]);
                return response()->json(['status'=>true, 'msg'=>'We have e-mailed your password reset link!....']);
            } else {
                return response()->json(['status'=>false, 'msg'=>'Something went wrong. Try again later.....']);
            }
        }
    }

    public function otpView(Request $req)
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
        if(session()->has('token')) {
        return view('front.auth.otp', compact('cartNav','cartTotalnav','cartCount','nav','cat'));
        }else {
            return redirect()->route('web.home');
        }
    }


    public function otpVerify(Request $request)
      {
          $val = Validator::make($request->all(),[
              'otp' => 'required'
          ],[
            'otp.required' => 'OTP Can not be Blank']);

          if ($val->fails()) {
              return response()->json(['status'=>false, 'msg'=>$val->errors()->first()]);
          } else {
  
          $updatePassword = DB::table('password_reset_tokens')
                              ->where('token', $request->otp)->exists();
  
          if(!$updatePassword){
              return response()->json(['status'=>false, 'msg'=>'Enter Correct OTP....']);
          } else {

            return response()->json(['status'=>true, 'msg'=>'OTP Verified Successfully']);
          }

        }
      }

      public function resetPasswordView(Request $req)
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
        if(session()->has('token')) {
        return view('front.auth.reset', compact('cartNav','cartTotalnav','cartCount','nav','cat'));
        } else {
            return redirect()->route('web.home');
        }
    }


    public function resertPassword(Request $request)
      {
          $val = Validator::make($request->all(),[
              'password' => 'required|string|min:6|same:confirm_password|regex:/^(?=.*?[a-z,A-Z,0-9])(?=.*?[#?!@$%^&*_]).{6,}$/',
              'confirm_password' => 'required'
          ],[
            'password.min' => 'Password should be minimum 6 characters.',
            'password.same' => 'Password and Confirm Password should be same.',
            'password.regex' => 'Password should contain at least 1 uppercase letter, 1 lowercase letter, and 1 special character (#?!@$%^&*_).',
        ]);

          if ($val->fails()) {
              return response()->json(['status'=>false, 'msg'=>$val->errors()->first()]);
          } else {

          $user_id = session('user_id');
          $updatePassword = DB::table('password_reset_tokens')
                              ->where('user_id', $user_id)->first();
  
          if(!$updatePassword){
              return response()->json(['status'=>false, 'msg'=>'Enter Correct OTP....']);
          }
  
          $user = User::where('id', $user_id)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_reset_tokens')->where('user_id', $user_id)->delete();
          Session::flush();
          return response()->json(['status'=>true, 'msg'=>'Password Changed Successfully....']);
      }

  }

}
