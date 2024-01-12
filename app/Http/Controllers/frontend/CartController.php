<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;
use App\Models\ProductColorSize;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
class CartController extends Controller
{
    public function addProduct(Request $request){
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');
        $colorName = $request->colorName;
        $sizeValue = $request->sizeValue;


        if(Auth::check()){
            $compareQTY = ProductColorSize::select('id', 'product_Id', 'color_id', 'size_id', 'qty')
                ->where('product_id', $product_id)
                ->where('color_id', $colorName)
                ->where('size_id', $sizeValue)
                ->sum('qty');
            // dd($compareQTY);
            if($product_qty <= $compareQTY) {
                $prod_check = Product::where('id' , $product_id)->first();
                if($prod_check){
                    if(Cart::where('prod_id' , $product_id)->where('user_id' , Auth::id())->exists()){
                        return response()->json(['status' => $prod_check->name . " " ."It has already been added"]);
                    }
                    else{
                        $cartItem = new Cart();
                        $cartItem->prod_id = $product_id;
                        $cartItem->colorID = $colorName;
                        $cartItem->sizeID = $sizeValue;
                        $cartItem->prod_qty = $product_qty;
                        $cartItem->user_id = Auth::id();
                        $cartItem->save();
                        return response()->json(['status' => $prod_check->name . " " . "Added to cart"]);
                    }
                }
            }
            else {
                return response()->json(['status' => "There is not enough quantity, please choose the quantity according to the available quantity."]);
            }
        }
        else{
            return response()->json(['status' => "Please log in to complete the process"]);
        }
    }

    public function viewCart(){
        $getAllCart = Cart::where('user_id' , Auth::id())->get();
        $categories = Category::take(4)->get();
        $getCate = Category::where('status' , '0')->get();
        $Settings = Setting::first();
        // dd($getAllCart->proudcts);
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
                return response()->json(['status' => "Quantity has been updated"]);
            }

        }
        else{
            return response()->json(['status' => "Please log in to complete the process"]);
        }
    }
    public function removeProduct(Request $request){
        if(Auth::check()){
            $prod_id = $request->input('prod_id');
            if(Cart::where('prod_id' , $prod_id)->where('user_id' , Auth::id())->exists()){
                $cartItem = Cart::where('prod_id' , $prod_id)->where('user_id' , Auth::id())->first();
                $cartItem->delete();
                return response()->json(['status' => "Deleted successfully"]);
            }
        }
        else{
            return response()->json(['status' => "Please log in to complete the process"]);
        }
    }

    public function cartCount(){
        $cartcount = Cart::where('user_id' , Auth::id())->count();

        return response()->json(['count' => $cartcount]);
    }


}
