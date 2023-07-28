<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LinkCategory;
use App\Models\LinkProduct;
use App\Models\LinkUser;
use Illuminate\Support\Str;
use Session;
use Validator;

class LinkController extends Controller
{
    public function index(Request $request)
    {
        $cat = LinkCategory::get();
        $products = LinkProduct::get();

        // Retrieve the selected product IDs from the session
        $selectedProducts = $request->session()->get('selectedProducts', []);

        return view('link.index', compact('cat', 'products', 'selectedProducts'));
    }

    public function linkUserView(Request $request)
    {
        $requestUniqueId = $request->id;
        $sessionUniqueId = Session::get('selectedProducts.uniqueId');
        if ($requestUniqueId && $requestUniqueId === $sessionUniqueId) {
            return view('link.user_form', compact('requestUniqueId'));
        } else {
            return "No data found.";
        }
    }
public function linkUserProductView(Request $request)
{
    $requestUniqueId = $request->id; // The ID from the request URL
    $sessionUniqueId = Session::get('selectedProducts.uniqueId'); // The uniqueId stored in the session
    $sessionData = Session::get('selectedProducts', []); // The array of product IDs stored in the session

    if ($requestUniqueId && $requestUniqueId === $sessionUniqueId) {
        // Fetch the LinkProduct data based on the product IDs in the session
        $linkProducts = LinkProduct::whereIn('id', $sessionData)->get();
        
        return view('link.user_product', compact('linkProducts', 'sessionUniqueId'));
    } else {
        return "No data found.";
    }
}
    public function storeSelectedProducts(Request $request)
{
    $val = Validator::make($request->all(), [
        'selected_products' => 'array|min:36|max:45',
        'selected_products.*' => 'exists:link_products,id',
    ]);

    if ($val->fails()) {
        return response()->json(['status' => false, 'msg' => $val->errors()->first()]);
    } else {
        $uniqueId = $request->input('uniqueId');
        if ($uniqueId && $uniqueId === Session::get('selectedProducts.uniqueId')) {
            return redirect()->route('link.user.view', ['uniqueId' => $uniqueId]);
        }
        $uniqueId = Str::uuid()->toString();
        $selectedProducts = $request->input('selected_products', []);
        Session::put('selectedProducts', $selectedProducts);
        Session::put('selectedProducts.uniqueId', $uniqueId);

        return redirect()->route('link.user.view', ['id' => $uniqueId]);
    }
}


    public function sessionData(Request $request)
    {
        $selectedProducts = $request->session()->get('selectedProducts', []);
        dd($selectedProducts);
    }

    public function clearSelectedProducts(Request $request)
    {
        $request->session()->forget('selectedProducts');
    }

    public function linkUserSubmit(Request $req)
    {
        $validator = Validator::make(
            $req->all(),
            [
                "name" => "required",
                "number" => "required",
                "size" => "required",
                "address" => "required",
            ],
            [
                "name.required" => "Name cannot be blank",
                "number.required" => "Contact number cannot be blank",
                "size.required" => "Size cannot be blank",
                "address.required" => "Address cannot be blank",
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "nameError" => $validator->errors()->first('name'),
                "numberError" => $validator->errors()->first('number'),
                "sizeError" => $validator->errors()->first('size'),
                "addressError" => $validator->errors()->first('address'),
            ]);
        }
        $data = new LinkUser;
        $data->name = $req->name;
        $data->number = $req->number;
        $data->size = $req->size;
        $data->address = $req->address;
        $reg = $data->save();
        $uid = $req->sessionid;
        if ($reg) {
            return response()->json(['status' => true, 'msg' => 'Registered successfully','data'=>['location'=>route('link.user.product.view',$uid)]]);
        } else {
            return response()->json(['status' => false, 'msg' => 'Something went wrong. Please try again later.']);
        }
    }
}
