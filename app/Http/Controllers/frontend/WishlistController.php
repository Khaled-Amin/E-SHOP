<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        $categories = Category::take(4)->get();
        $getCate = Category::where('status' , '0')->get();
        $Settings = Setting::first();
        return view('frontend.wishlist' , compact('Settings','getCate','categories','wishlist'));
    }

    public function add(Request $request)
    {

        if(Auth::check()){
            // $prod_check = Product::where('id' , $product_id)->first();
            $prod_id = $request->input('product_id');
            if(Product::find($prod_id)){
                $wish = new Wishlist();
                $wish->prod_id = $prod_id;
                $wish->user_id = Auth::id();
                $wish->save();
                return response()->json(['status' =>  "تمت الإضافة لقائمة الرغبات"]);
            }
            else{
                return response()->json(['status' => "تم اضافته مسبقا"]);
            }
        }
        else{
            return response()->json(['status' => "الرجاء تسجيل الدخول لاستكمال العملية"]);
        }
    }

    public function deleteItem(Request $request)
    {
        if(Auth::check()){
            $prod_id = $request->input('prod_id');
            if(Wishlist::where('prod_id' , $prod_id)->where('user_id' , Auth::id())->exists()){
                $wish = Wishlist::where('prod_id' , $prod_id)->where('user_id' , Auth::id())->first();
                $wish->delete();
                return response()->json(['status' => "تم حذف منتج بنجاح"]);
            }
        }
        else{
            return response()->json(['status' => "الرجاء تسجيل الدخول لاستكمال العملية"]);
        }
    }

    public function wishlistCount(){
        $wishlistLoad = Wishlist::where('user_id' , Auth::id())->count();

        return response()->json(['count' => $wishlistLoad]);
    }
}
