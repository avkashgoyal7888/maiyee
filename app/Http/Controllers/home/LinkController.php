<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LinkCategory;
use App\Models\LinkProduct;
use App\Models\LinkUser;
use App\Models\LinkUserProduct;
use App\Models\LinkBanner;
use Illuminate\Support\Str;
use Session;
use Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LinkController extends Controller
{
    public function generate() {
        $qrCodes = QrCode::size(150)->generate('https://maiyee.in/link-product');
        return $qrCodes;
    }

    public function index(Request $request)
    {
        $cat = LinkCategory::get();
        $products = LinkProduct::get();
        $banner = LinkBanner::get();
        $request->session()->forget('selectedProducts');
        return view('link.index', compact('cat', 'products', 'banner'));
    }

    public function orderPlaced(Request $request)
    {
        return view('link.success');
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
        $sessionUniqueId = Session::get('selectedProducts.uniqueId');
        $sessionData = Session::get('selectedProducts', []);
        $linkUserId = Session::get('link_user_id');
    
        if ($requestUniqueId && $requestUniqueId === $sessionUniqueId) {
            $linkProducts = LinkProduct::whereIn('id', $sessionData)->get();
            return view('link.user_product', compact('linkProducts', 'sessionUniqueId', 'linkUserId'));
        } else {
            return "No data found.";
        }
    }

    public function storeSelectedProducts(Request $request)
    {
        $val = Validator::make($request->all(), [
            'selected_products' => 'array|min:30|max:45',
            'selected_products.*' => 'exists:link_products,id',
        ],[
            'selected_products.min' => 'Please select at least 30 products.',
            'selected_products.max' => 'Please select at most 45 products.',]);

        if ($val->fails()) {
            return response()->json(['status' => false, 'msg' => $val->errors()->first()]);
        }

        $selectedProducts = $request->input('selected_products', []);

        if (empty($selectedProducts)) {
            return response()->json(['status' => false, 'msg' => 'Please select at least 36 product.']);
        }

        $uniqueId = Str::uuid()->toString();
        Session::put('selectedProducts', $selectedProducts);
        Session::put('selectedProducts.uniqueId', $uniqueId);

        return response()->json(['status' => true,'msg'=>'Added Successfully....', 'redirectTo' => route('link.user.view', ['id' => $uniqueId])]);
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
                "delivery_date" => "required|date_format:Y-m-d",
                "time" => "required",
            ],
            [
                "name.required" => "Name cannot be blank",
                "number.required" => "Contact number cannot be blank",
                "size.required" => "Size cannot be blank",
                "address.required" => "Address cannot be blank",
                "delivery_date.required" => "Select Deliver Date...",
                "time.required" => "Select Time Slot...",
            ]
        );
    
        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "nameError" => $validator->errors()->first('name'),
                "numberError" => $validator->errors()->first('number'),
                "sizeError" => $validator->errors()->first('size'),
                "addressError" => $validator->errors()->first('address'),
                "deliveryError" => $validator->errors()->first('delivery_date'),
                "timeError" => $validator->errors()->first('time'),
            ]);
        }
    
        $data = new LinkUser;
        $start = null;
        $end = null;
        if ($req->time == 1) {
            $start = '10:00:00';
            $end = '12:00:00';
        } elseif ($req->time == 2) {
            $start = '13:00:00';
            $end = '15:00:00';
        } elseif ($req->time == 3) {
            $start = '16:00:00';
            $end = '20:00:00';
        }

        $data->name = $req->name;
        $data->number = $req->number;
        $data->size = $req->size;
        $data->address = $req->address;
        $data->delivery_date = $req->delivery_date;
        $data->start_time = $start;
        $data->end_time = $end;
        $reg = $data->save();
        if ($reg) {
            $linkUser = $data; // Store the LinkUser instance, not just the ID
            $selectedProducts = Session::get('selectedProducts', []);
    
            foreach ($selectedProducts as $productId) {
                $linkProduct = LinkProduct::find($productId);
                if ($linkProduct) {
                    LinkUserProduct::create([
                        'user_id' => $linkUser->id,
                        'product_id' => $linkProduct->id,
                    ]);
                }
            }
            session()->flush();
            $fields = array(
                "sender_id" => "TXTIND",
                "message" => "Congratulations!! " . $data->name . " We're glad you found what you were looking for!! We contact you for delivery details soon.. Feel free to contact our Customer Care executive for your queries : +91-9904141427 ",
                "route" => "v3",
                "numbers" => $data->number,
            );
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($fields),
                CURLOPT_HTTPHEADER => array(
                    "authorization: 4OTtNOKY3Sh7bZb20tc4wfQmNUj7GQqkpHUl7khxmo9whfuGjHYb6aGEekLJ",
                    "accept: /",
                    "cache-control: no-cache",
                    "content-type: application/json"
                ),
            )
            );
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            return response()->json(['status' => true, 'msg' => 'Order successfully Placed...']);
        } else {
            return response()->json(['status' => false, 'msg' => 'Something went wrong. Please try again later.']); 
        }
    }
}
