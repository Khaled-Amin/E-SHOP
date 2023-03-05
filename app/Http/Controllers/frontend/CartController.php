<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
class CartController extends Controller
{
    public function addProduct(Request $request){
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        if(Auth::check()){
            $prod_check = Product::where('id' , $product_id)->first();

            if($prod_check){
                if(Cart::where('prod_id' , $product_id)->where('user_id' , Auth::id())->exists()){
                    return response()->json(['status' => $prod_check->name . " " ."تم اضافته مسبقا"]);
                }
                else{
                    $cartItem = new Cart();
                    $cartItem->prod_id = $product_id;
                    $cartItem->prod_qty = $product_qty;
                    $cartItem->user_id = Auth::id();
                    $cartItem->save();
                    return response()->json(['status' => $prod_check->name . " " . "تمت الإضافة لعربة التسوق"]);
                }
            }
        }
        else{
            return response()->json(['status' => "الرجاء تسجيل الدخول لاستكمال العملية"]);
        }
    }

    public function viewCart(){
        $getAllCart = Cart::where('user_id' , Auth::id())->get();
        $categories = Category::take(4)->get();
        $getCate = Category::where('status' , '0')->get();
        $Settings = Setting::first();
        return view('frontend.showCart' , compact('Settings','getCate','categories','getAllCart'));
        // get_defined_vars()
    }

    public function updateCart(Request $request){
        $prod_id = $request->input('prod_id');
        $prod_qty = $request->input('prod_qty');
        if(Auth::check()){
            if(Cart::where('prod_id' , $prod_id)->where('user_id' , Auth::id())->exists()){
                $cart = Cart::where('prod_id' , $prod_id)->where('user_id' , Auth::id())->first();
                $cart->prod_qty = $prod_qty;
                $cart->update();
                return response()->json(['status' => "تم تحديث الكمية"]);
            }

        }
        else{
            return response()->json(['status' => "الرجاء تسجيل الدخول لاستكمال العملية"]);
        }
    }
    public function removeProduct(Request $request){
        if(Auth::check()){
            $prod_id = $request->input('prod_id');
            if(Cart::where('prod_id' , $prod_id)->where('user_id' , Auth::id())->exists()){
                $cartItem = Cart::where('prod_id' , $prod_id)->where('user_id' , Auth::id())->first();
                $cartItem->delete();
                return response()->json(['status' => "تم الحذف بنجاح"]);
            }
        }
        else{
            return response()->json(['status' => "الرجاء تسجيل الدخول لاستكمال العملية"]);
        }
    }

    public function cartCount(){
        $cartcount = Cart::where('user_id' , Auth::id())->count();

        return response()->json(['count' => $cartcount]);
    }


}
