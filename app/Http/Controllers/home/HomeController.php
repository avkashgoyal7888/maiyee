<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Size;
use App\Models\Color;
use App\Models\Cart;
use App\Models\ProductImage;
use App\Models\Head;
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
        $size = Size::whereIn('product_id', $product->pluck('id'))->whereIn('color_id', $color->pluck('id'))->get();
        $cartNav = Cart::get();
        $cartTotalnav = 0;
        $cartCount = 0;
        if(Auth::guard('web')->check()) {
        $cartNav = Cart::where('user_id', Auth::guard('web')->user()->id)->latest()->limit(2)->get();
        $cartCount = Cart::where('user_id', Auth::guard('web')->user()->id)->count();
        $cartTotalnav = $cartNav->sum('total');
        }
        $nav = Head::first();
        return view('front.home',compact('banner','product', 'color','size','cartNav','cartTotalnav','cartCount','nav'));
    }

    public function register()
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
        return view('front.auth.register', compact('cartNav','cartTotalnav','cartCount','nav'));
    }

    public function disclaimer()
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
        return view('front.disclaimer', compact('cartNav','cartTotalnav','cartCount','nav'));
    }

    public function subcategory(Request $req)
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
        $product = Product::where('sub_id',$req->id)->get();
        $size = Size::whereIn('product_id', $product->pluck('id'))->get();
        return view('front.sub', compact('cartNav','cartTotalnav','cartCount','nav','size','product'));
    }

    public function policy()
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
        return view('front.policy',compact('cartNav','cartTotalnav','cartCount','nav'));
    }

    public function refund()
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
        return view('front.refund', compact('cartNav','cartTotalnav','cartCount','nav'));
    }

    public function shipping()
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
        return view('front.shipping',compact('cartNav','cartTotalnav','cartCount','nav'));
    }

    public function cart()
    {
        $cartNav = Cart::get();
        $cartTotalnav = 0;
        $cartCount = 0;
        if(Auth::guard('web')->check()) {
        $cartNav = Cart::where('user_id', Auth::guard('web')->user()->id)->latest()->limit(2)->get();
        $cartCount = Cart::where('user_id', Auth::guard('web')->user()->id)->count();
        $cartTotalnav = $cartNav->sum('total');
        }
        $cart = Cart::where('user_id', Auth::guard('web')->user()->id)->get();
        $cartTotal = $cart->sum('total');
        $nav = Head::first();
        return view('front.cart', compact('cart', 'cartNav','cartTotal','cartTotalnav','cartCount','nav'));
    }

    public function productDetail(Request $req)
    {
        $cartNav = Cart::get();
        $cartTotalnav = 0;
        $cartCount = 0;
        if(Auth::guard('web')->check()) {
        $cartNav = Cart::where('user_id', Auth::guard('web')->user()->id)->latest()->limit(2)->get();
        $cartCount = Cart::where('user_id', Auth::guard('web')->user()->id)->count();
        $cartTotalnav = $cartNav->sum('total');
        }
        $color = Color::where('product_id', $req->id)->get();
        $product = Product::where('id', $req->id)->first();
        $size = Size::where('product_id', $req->id)->get();
        $colorzoom = Color::where('product_id', $req->id)->first();
        $proimage = ProductImage::where('product_id', $req->id)->get();
        $nav = Head::first();
        return view('front.product-detail', compact('product', 'color', 'size','colorzoom','cartNav','proimage','cartTotalnav','cartCount','nav'));
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
            if (Auth::guard('web')->attempt(['email' => $req->email, 'password' => $req->password]) || Auth::guard('web')->attempt(['number' => $req->email, 'password' => $req->password])) {
            return response()->json(['status' => true, 'msg' => 'Logged in Successfully.....']);
        } else {
            return response()->json(['status'=>false, 'msg'=>'Invalid User Id or password.....']);
        }

    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
    
        // insert user information into users table
        User::updateOrCreate([
            'email' => $user->getEmail(),
        ], [
            'name' => $user->getName(),
            'password' => Hash::make(Str::random(24)),
        ]);
    
        // log in the user  
        auth()->attempt(['email' => $user->getEmail(), 'password' => '']);
    
        return redirect()->route('web.home');
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
{
    $user = Socialite::driver('facebook')->user();

    // insert user information into users table
    User::updateOrCreate([
        'email' => $user->getEmail(),
    ], [
        'name' => $user->getName(),
        'password' => Hash::make(Str::random(24)),
    ]);

    // log in the user
    auth()->attempt(['email' => $user->getEmail(), 'password' => '']);

    return redirect()->route('web.home');
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
