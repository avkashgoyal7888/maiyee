<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Head;
use App\Models\Visitor;
use Validator;
use Session;
use Auth;
use Hash;
use Illuminate\Support\Facades\Artisan;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use CloudinaryLabs\CloudinaryLaravel\CloudinaryEngine;

class AdminController extends Controller
{
    public function index()
    {
        if(Auth::guard('admin')->check())
        {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function dashboard()
    {
        $nav = Head::first();
        $visitorCount = Visitor::sum('hits');
        return view('admin.dashboard', compact('nav','visitorCount'));
    }

    public function loginSubmit(Request $req)
    {
        $val = Validator::make($req->all(), [
            'adminid' => 'required',
            'password' => 'required',
        ],
        [
            'adminid.required' => 'Admin Id Field can not be blank....',
            'password' => 'Password Can not be blank....',
        ]);
        if ($val->fails()) {
            return response()->json(['status'=>false, 'msg'=>$val->errors()->first()]);
        }
        if (Auth::guard('admin')->attempt(['adminid'=>$req->adminid, 'password'=>$req->password])) {
            return response()->json(['status'=>true, 'msg'=>'Logged in Successfully.....', 'data'=>['location'=>route('admin.dashboard')]]);
        } else {
            return response()->json(['status'=>false, 'msg'=>'Invalid User Id or password.....']);
        }
    }

    public function changePassword(Request $request)
    {
        $adminId = Auth::guard('admin')->user()->id;
        // print_r($adminId); exit();
        $admin = Admin::where('id', $adminId)->first();
        // print_r($admin); exit();
        if (!$admin) {
            return response()->json(['status' => false, 'message' => "User not found"]);
        }
    
        $rule = [
            'old_password' => ['required', 'min:6'],
            'new_password' => ['required', 'min:6', 'same:confirm_password']
        ];
        $validator = Validator::make($request->all(), $rule);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }
    
        if (Hash::check($request->old_password, $admin->password)) {
            $admin->password = Hash::make($request->new_password);
            $chnagepassword = $admin->save();
            if (!$chnagepassword) {
                return response()->json(['status' => false, 'msg' => "Old password does not match"]);
            } else {
                return response()->json(['status' => true, 'msg' => "Password changed successfully"]);
            }
        } else {
            return response()->json(['status' => false, 'msg' => "Something went wrong"]);
        }
    }

    public function updateImage(Request $request)
    {
        $userId = Auth::guard('admin')->user()->id;
        $user = Admin::find($userId);

        if (!$user) {
            return response()->json(['status' => false, 'msg' => 'User not found']);
        }

        $validator = Validator::make($request->all(), [
            'image' => 'required|file|image',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }

        if ($request->hasFile('image')) {
            // Delete the previous image from Cloudinary
            if ($user->image) {
                $publicId = pathinfo($user->image)['filename'];
                Cloudinary::destroy("admin/profile/{$publicId}");
            }

            // Upload the new image to Cloudinary
            $result = Cloudinary::upload($request->file('image')->getRealPath(), [
                'folder' => 'admin/profile',
            ]);

            if ($result && $result->getSecurePath()) {
                $user->image = $result->getSecurePath();
                $up = $user->save();

                if ($up) {
                    return response()->json(['status' => true, 'msg' => 'Updated successfully']);
                } else {
                    return response()->json(['status' => false, 'msg' => 'Something went wrong. Please try again later.']);
                }
            } else {
                return response()->json(['status' => false, 'msg' => 'Failed to upload image']);
            }
        }
    }

    public function deleteExpiredCoupons()
    {
        Artisan::call('coupons:delete-expired');
    }


    public function logOut()
    { 
        Auth::guard('admin')->logout();
        Session::flush();
        return redirect()->route('admin.login');
    }
}
