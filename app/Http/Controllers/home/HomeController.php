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
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Review;
use App\Models\ReviewImage;
use App\Models\ProductDetail;
use App\Models\BadgeProduct;
use App\Models\Bash;
use App\Models\HomeBanner;
use App\Models\exhibition;
use App\Models\WishList;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Wardrobe;
use App\Models\Visitor;
use Validator;
use Hash;
use Auth;
use Session;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Mail;

class HomeController extends Controller
{
    public function index(Request $req)
    {
        $banner = Banner::get();
        $product = Product::get();
        $color = Color::whereIn('product_id', $product->pluck('id'))->get();
        $size = Size::whereIn('product_id', $product->pluck('id'))->whereIn('color_id', $color->pluck('id'))->get();
        $cartNav = Cart::get();
        $cartTotalnav = 0;
        $cartCount = 0;
        if (Auth::guard('web')->check()) {
            $cartNav = Cart::where('user_id', Auth::guard('web')->user()->id)->latest()->limit(2)->get();
            $cartCount = Cart::where('user_id', Auth::guard('web')->user()->id)->count();
            $cartTotalnav = $cartNav->sum('total');
        }
        $nav = Head::first();
        $sub = SubCategory::get();
        $cat = Category::get();
        $bashpr = BadgeProduct::get();
        $hbanner = HomeBanner::get();
        $bash = Bash::get();
        $ip = $req->ip();
        $today = now()->format('Y-m-d');
        $visitor = Visitor::where('ip_address', $ip)
            ->where('visit_date', $today)
            ->first();
        if ($visitor) {
            $visitor->incrementHits();
        } else {
            Visitor::create([
                'ip_address' => $ip,
                'visit_date' => $today,
                'hits' => 1,
            ]);
        }
        return view('front.home', compact('banner', 'product', 'color', 'size', 'cartNav', 'cartTotalnav', 'cartCount', 'nav', 'sub', 'cat', 'bash', 'bashpr', 'hbanner'));
    }

    public function getProductData($id)
    {
        $product = Product::find($id);
        $colors = Color::where('product_id', $product->id)->get();
        $size = size::where('product_id', $product->id)->get();
        $product->colors = $colors;
        $product->size = $size;
        return response()->json($product);
    }

    public function register()
    {
        $cartNav = Cart::get();
        $cartTotalnav = 0;
        $cartCount = 0;
        if (Auth::guard('web')->check()) {
            $cartNav = Cart::where('user_id', Auth::guard('web')->user()->id)->latest()->limit(2)->get();
            $cartCount = Cart::where('user_id', Auth::guard('web')->user()->id)->count();
            $cartTotalnav = $cartNav->sum('total');
        }
        $nav = Head::first();
        $cat = Category::get();
        return view('front.auth.register', compact('cartNav', 'cartTotalnav', 'cartCount', 'nav', 'cat'));
    }

    public function disclaimer()
    {
        $cartNav = Cart::get();
        $cartTotalnav = 0;
        $cartCount = 0;
        if (Auth::guard('web')->check()) {
            $cartNav = Cart::where('user_id', Auth::guard('web')->user()->id)->latest()->limit(2)->get();
            $cartCount = Cart::where('user_id', Auth::guard('web')->user()->id)->count();
            $cartTotalnav = $cartNav->sum('total');
        }
        $nav = Head::first();
        $cat = Category::get();
        return view('front.disclaimer', compact('cartNav', 'cartTotalnav', 'cartCount', 'nav', 'cat'));
    }

    public function about()
    {
        $cartNav = Cart::get();
        $cartTotalnav = 0;
        $cartCount = 0;
        if (Auth::guard('web')->check()) {
            $cartNav = Cart::where('user_id', Auth::guard('web')->user()->id)->latest()->limit(2)->get();
            $cartCount = Cart::where('user_id', Auth::guard('web')->user()->id)->count();
            $cartTotalnav = $cartNav->sum('total');
        }
        $nav = Head::first();
        $cat = Category::get();
        return view('front.about', compact('cartNav', 'cartTotalnav', 'cartCount', 'nav', 'cat'));
    }

    public function policy()
    {
        $cartNav = Cart::get();
        $cartTotalnav = 0;
        $cartCount = 0;
        if (Auth::guard('web')->check()) {
            $cartNav = Cart::where('user_id', Auth::guard('web')->user()->id)->latest()->limit(2)->get();
            $cartCount = Cart::where('user_id', Auth::guard('web')->user()->id)->count();
            $cartTotalnav = $cartNav->sum('total');
        }
        $nav = Head::first();
        $cat = Category::get();
        return view('front.policy', compact('cartNav', 'cartTotalnav', 'cartCount', 'nav', 'cat'));
    }

    public function exhibition()
    {
        $cartNav = Cart::get();
        $cartTotalnav = 0;
        $cartCount = 0;
        if (Auth::guard('web')->check()) {
            $cartNav = Cart::where('user_id', Auth::guard('web')->user()->id)->latest()->limit(2)->get();
            $cartCount = Cart::where('user_id', Auth::guard('web')->user()->id)->count();
            $cartTotalnav = $cartNav->sum('total');
        }
        $nav = Head::first();
        $cat = Category::get();
        $ex = exhibition::get();
        return view('front.exhibition', compact('cartNav', 'cartTotalnav', 'cartCount', 'nav', 'cat', 'ex'));
    }

    public function wardrobe()
    {
        $cartNav = Cart::get();
        $cartTotalnav = 0;
        $cartCount = 0;
        if (Auth::guard('web')->check()) {
            $cartNav = Cart::where('user_id', Auth::guard('web')->user()->id)->latest()->limit(2)->get();
            $cartCount = Cart::where('user_id', Auth::guard('web')->user()->id)->count();
            $cartTotalnav = $cartNav->sum('total');
        }
        $nav = Head::first();
        $cat = Category::get();
        $wardrobes = Wardrobe::get();
        return view('front.wardrobe', compact('cartNav', 'cartTotalnav', 'cartCount', 'nav', 'cat', 'wardrobes'));
    }

    public function refund()
    {
        $cartNav = Cart::get();
        $cartTotalnav = 0;
        $cartCount = 0;
        if (Auth::guard('web')->check()) {
            $cartNav = Cart::where('user_id', Auth::guard('web')->user()->id)->latest()->limit(2)->get();
            $cartCount = Cart::where('user_id', Auth::guard('web')->user()->id)->count();
            $cartTotalnav = $cartNav->sum('total');
        }
        $nav = Head::first();
        $cat = Category::get();
        return view('front.refund', compact('cartNav', 'cartTotalnav', 'cartCount', 'nav', 'cat'));
    }

    public function shipping()
    {
        $cartNav = Cart::get();
        $cartTotalnav = 0;
        $cartCount = 0;
        if (Auth::guard('web')->check()) {
            $cartNav = Cart::where('user_id', Auth::guard('web')->user()->id)->latest()->limit(2)->get();
            $cartCount = Cart::where('user_id', Auth::guard('web')->user()->id)->count();
            $cartTotalnav = $cartNav->sum('total');
        }
        $nav = Head::first();
        $cat = Category::get();
        return view('front.shipping', compact('cartNav', 'cartTotalnav', 'cartCount', 'nav', 'cat'));
    }

    public function cart()
    {
        $cartNav = Cart::get();
        $cartTotalnav = 0;
        $cartCount = 0;
        if (Auth::guard('web')->check()) {
            $cartNav = Cart::where('user_id', Auth::guard('web')->user()->id)->latest()->limit(2)->get();
            $cartCount = Cart::where('user_id', Auth::guard('web')->user()->id)->count();
            $cartTotalnav = $cartNav->sum('total');
        }
        $cart = Cart::where('user_id', Auth::guard('web')->user()->id)->get();
        $cartTotal = $cart->sum('total');
        $nav = Head::first();
        $cat = Category::get();
        return view('front.cart', compact('cart', 'cartNav', 'cartTotal', 'cartTotalnav', 'cartCount', 'nav', 'cat'));
    }

    public function wish()
    {
        $cartNav = Cart::get();
        $cartTotalnav = 0;
        $cartCount = 0;
        if (Auth::guard('web')->check()) {
            $cartNav = Cart::where('user_id', Auth::guard('web')->user()->id)->latest()->limit(2)->get();
            $cartCount = Cart::where('user_id', Auth::guard('web')->user()->id)->count();
            $cartTotalnav = $cartNav->sum('total');
        }
        $wish = WishList::where('user_id', Auth::guard('web')->user()->id)->get();
        $nav = Head::first();
        $cat = Category::get();
        return view('front.wish', compact('wish', 'cartNav', 'cartTotalnav', 'cartCount', 'nav', 'cat'));
    }

    public function productDetail(Request $req)
    {
        $cartNav = Cart::get();
        $cartTotalnav = 0;
        $cartCount = 0;
        if (Auth::guard('web')->check()) {
            $cartNav = Cart::where('user_id', Auth::guard('web')->user()->id)->latest()->limit(2)->get();
            $cartCount = Cart::where('user_id', Auth::guard('web')->user()->id)->count();
            $cartTotalnav = $cartNav->sum('total');
        }
        $color = Color::where('product_id', $req->id)->get();
        $product = Product::where('id', $req->id)->first();
        $productdetail = ProductDetail::where('product_id', $req->id)->first();
        $size = Size::where('product_id', $req->id)->get();
        $colorzoom = Color::where('product_id', $req->id)->first();
        $proimage = ProductImage::where('product_id', $req->id)->get();
        $nav = Head::first();
        $review = Review::where('product_id', $req->id)->get();
        $quantity = Size::where('product_id', $req->id)->first();
        $rating = DB::table("reviews")->where("product_id", $req->id)->sum("rating");
        $count = DB::table("reviews")->where("product_id", $req->id)->count();
        $avg = $count > 0 ? $rating / $count : 0;
        $rim = ReviewImage::where('product_id', $req->id)->get();
        $cat = Category::get();
        $discount = $product->mrp - $product->discount;
        $startDate = Carbon::today();
        $endDate = $startDate->copy()->addDays(7);
        $startFormatted = $startDate->format('D. M j');
        $endFormatted = $endDate->format('D. M j');
        $shareButton = \Share::page('https://maiyee.in/product-detail/' . $req->id, $product->name)->facebook()->twitter()->linkedin()->telegram()->whatsapp()->reddit();
        $user = Auth::guard('web')->user();
        $userId = $user ? $user->id : null;
        $wish = WishList::where(['user_id' => $userId, 'product_id' => $req->id])->first();
        return view('front.product-detail', compact('product', 'color', 'size', 'colorzoom', 'cartNav', 'proimage', 'cartTotalnav', 'cartCount', 'nav', 'review', 'count', 'rating', 'avg', 'rim', 'cat', 'productdetail', 'discount', 'startFormatted', 'endFormatted', 'shareButton', 'quantity', 'wish'));
    }

    public function subcategory(Request $request)
    {
        // Get cart data
        $cartNav = Cart::get();
        $cartTotalnav = 0;
        $cartCount = 0;
        if (Auth::guard('web')->check()) {
            $cartNav = Cart::where('user_id', Auth::guard('web')->user()->id)->latest()->limit(2)->get();
            $cartCount = Cart::where('user_id', Auth::guard('web')->user()->id)->count();
            $cartTotalnav = $cartNav->sum('total');
        }
        // Get navigation data
        $nav = Head::first();
        // Get subcategory data
        $productsQuery = Product::where('sub_id', $request->id);
        $size = Size::whereIn('product_id', $productsQuery->pluck('id'))->groupBy('size')->distinct()->get('size');
        $category = Category::get();
        $sub = SubCategory::get();
        $color = Color::whereIn('product_id', $productsQuery->pluck('id'))->groupBy('color_category')->distinct()->get('color_category');
        $subimg = SubCategory::where('id', $request->id)->first();
        // Apply sorting to the query
        $sortBy = $request->input('SortBy', 'name-ascending');
        switch ($sortBy) {
            // case 'Best Selling':
            //     $productsQuery->orderBy('sales_count', 'desc');
            //     break;
            case 'Alphabetically, A-Z':
                $productsQuery->orderBy('name', 'asc');
                break;
            case 'Alphabetically, Z-A':
                $productsQuery->orderBy('name', 'desc');
                break;
            case 'Price, low to high':
                $productsQuery->orderBy('discount', 'asc');
                break;
            case 'Price, high to low':
                $productsQuery->orderBy('discount', 'desc');
                break;
            case 'Date, new to old':
                $productsQuery->orderBy('created_at', 'desc');
                break;
            case 'Date, old to new':
                $productsQuery->orderBy('created_at', 'asc');
                break;
            default:
                $productsQuery->orderBy('name', 'asc');
                break;
        }
        // Get the sorted products
        $product = $productsQuery->get();
        $cat = Category::get();
        $count = 0;
        $rating = 0;
        foreach ($product as $p) {
            $count += DB::table("reviews")->where("product_id", $p->id)->count();
            $rating += DB::table("reviews")->where("product_id", $p->id)->sum('rating');
        }
        $avg = $count > 0 ? $rating / $count : 0;
        $subid = $request->id;
        return view('front.sub', compact('cartNav', 'cartTotalnav', 'cartCount', 'nav', 'size', 'category', 'sub', 'color', 'subimg', 'product', 'sortBy', 'cat', 'avg', 'subid'));
    }

    public function category(Request $request)
    {
        // Get cart data
        $cartNav = Cart::get();
        $cartTotalnav = 0;
        $cartCount = 0;
        if (Auth::guard('web')->check()) {
            $cartNav = Cart::where('user_id', Auth::guard('web')->user()->id)->latest()->limit(2)->get();
            $cartCount = Cart::where('user_id', Auth::guard('web')->user()->id)->count();
            $cartTotalnav = $cartNav->sum('total');
        }
        // Get navigation data
        $nav = Head::first();
        // Get subcategory data
        $productsQuery = Product::where('cat_id', $request->id);
        $size = Size::whereIn('product_id', $productsQuery->pluck('id'))->groupBy('size')->distinct()->get('size');
        $category = Category::get();
        $sub = SubCategory::get();
        $color = Color::whereIn('product_id', $productsQuery->pluck('id'))->groupBy('code')->distinct()->get('code');
        $catimg = Category::where('id', $request->id)->first();
        // Apply sorting to the query
        $sortBy = $request->input('SortBy', 'Alphabetically, A-Z');
        switch ($sortBy) {
            case 'Best Selling':
                $productsQuery->orderBy('sales_count', 'desc');
                break;
            case 'Alphabetically, A-Z':
                $productsQuery->orderBy('name', 'asc');
                break;
            case 'Alphabetically, Z-A':
                $productsQuery->orderBy('name', 'desc');
                break;
            case 'Price, low to high':
                $productsQuery->orderBy('discount', 'asc');
                break;
            case 'Price, high to low':
                $productsQuery->orderBy('discount', 'desc');
                break;
            case 'Date, new to old':
                $productsQuery->orderBy('created_at', 'desc');
                break;
            case 'Date, old to new':
                $productsQuery->orderBy('created_at', 'asc');
                break;
            default:
                $productsQuery->orderBy('name', 'asc');
                break;
        }

        // Get the sorted products
        $product = $productsQuery->get();
        $cat = Category::get();
        $count = 0;
        $rating = 0;
        foreach ($product as $p) {
            $count += DB::table("reviews")->where("product_id", $p->id)->count();
            $rating += DB::table("reviews")->where("product_id", $p->id)->sum('rating');
        }
        $avg = $count > 0 ? $rating / $count : 0;
        $catid = $request->id;
        return view('front.cat', compact('cartNav', 'cartTotalnav', 'cartCount', 'nav', 'size', 'category', 'sub', 'color', 'catimg', 'product', 'sortBy', 'cat', 'avg', 'catid'));
    }

    public function loginSubmit(Request $req)
    {
        $val = Validator::make($req->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($val->fails()) {
            return response()->json(['status' => false, 'msg' => $val->errors()->first()]);
        }
        if (Auth::guard('web')->attempt(['email' => $req->email, 'password' => $req->password]) || Auth::guard('web')->attempt(['number' => $req->email, 'password' => $req->password])) {
            return response()->json(['status' => true, 'msg' => 'Logged in Successfully.....']);
        } else {
            return response()->json(['status' => false, 'msg' => 'Invalid User Id or password.....']);
        }

    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        $authUser = User::where('email', $user->getEmail())->first();

        if ($authUser) {
            Auth::login($authUser, true);
        } else {
            $password = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(8 / strlen($x)))), 1, 8);
            $hashedPassword = Hash::make($password);
            $authUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => $hashedPassword,
                'avatar' => $user->getAvatar(),
                'provider_id' => $user->getId(),
            ]);

            Auth::login($authUser, true);
        }

        return redirect()->route('web.home');
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->stateless()->redirect();
    }

    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->stateless()->user();

        $authUser = User::where('email', $user->getEmail())->first();
        if ($authUser) {
            Auth::login($authUser, true);
        } else {
            $password = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(8 / strlen($x)))), 1, 8);
            $hashedPassword = Hash::make($password);
            $authUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => $hashedPassword,
                'avatar' => $user->getAvatar(),
                'provider_id' => $user->getId(),
            ]);

            Auth::login($authUser, true);
        }

        return redirect()->route('web.home');
    }

    public function registerSubmit(Request $req)
    {
        $enteredOtp = $req->otp;
        $generatedOtp = session('generatedOTP');
        if ($enteredOtp !== $generatedOtp) {
            return response()->json([
                "status" => 400,
                "otpError" => "Invalid OTP",
            ]);
        }
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
                "name.required" => "Name cannot be blank",
                "email.required" => "Email ID cannot be blank",
                "email.unique" => "Email ID is already registered",
                "number.required" => "Contact number cannot be blank",
                "number.unique" => "Contact number is already registered",
                "password.required" => "Password cannot be blank",
                "password.min" => "Password should be a minimum of 6 characters",
                "confirm_password.required" => "Confirm password cannot be blank",
                "confirm_password.same" => "Confirm password does not match",
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
                "otpError" => "Invalid OTP",
            ]);
        }
        $data = new User;
        $data->name = $req->name;
        $data->number = $req->number;
        $data->email = $req->email;
        $data->password = Hash::make($req->password);
        $reg = $data->save();
        if ($reg) {
            session()->forget('generatedOTP');
            Auth::attempt(['email' => $req->email, 'password' => $req->password]);
            // Authentication passed

            return response()->json(['status' => 200, 'message' => 'Registered successfully']);
        } else {
            return response()->json(['status' => 400, 'message' => 'Something went wrong. Please try again later.']);
        }
    }

    public function sendSMS(Request $request)
    {
        $fields = [
            "sender_id" => "TXTIND",
            // Replace with your sender ID
            "message" => $request->input('message'),
            "route" => "v3",
            "numbers" => $request->input('numbers')
        ];

        $response = Http::withHeaders([
            'authorization' => '4OTtNOKY3Sh7bZb20tc4wfQmNUj7GQqkpHUl7khxmo9whfuGjHYb6aGEekLJ',
            // Replace with your Fast2SMS authorization key
            'accept' => '/',
            'cache-control' => 'no-cache',
            'content-type' => 'application/json',
        ])->post('https://www.fast2sms.com/dev/bulkV2', $fields);

        // Send OTP to the email address if it is provided
        $generatedOtp = session('generatedOTP');
        $email = $request->input('email');
        if (!empty($email)) {
            Mail::send('front.auth.registeremail', ['token' => $generatedOtp], function ($message) use ($email) {
                $message->to($email);
                $message->subject('Reset Password');
            });
        }

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json($response->json(), $response->status());
        }
    }


    public function checkPhoneNumber(Request $request)
    {
        $phoneNumber = $request->input('number');
        $email = $request->input('email');

        // Check if the phone number or email already exists in the User model
        $user = User::where('number', $phoneNumber)->orWhere('email', $email)->first();

        if ($user) {
            if ($user->number === $phoneNumber) {
                // Phone number already registered
                return response()->json(['error' => 'Phone number already registered'], 400);
            }

            if ($user->email === $email) {
                // Email already registered
                return response()->json(['error' => 'Email already registered'], 400);
            }
        }

        // Phone number and email are valid and not registered
        return response()->json(['message' => 'Phone number and email are valid']);
    }



    public function logOut()
    {
        Auth::guard('web')->logOut();
        Session::flush();
        return redirect()->route('web.home');
    }
}