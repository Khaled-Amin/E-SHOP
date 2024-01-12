<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Color;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductColorSize;
use App\Models\Setting;
use App\Models\Shipping;
use App\Models\User;


class CheckoutController extends Controller
{
    public function index()
    {
        $old_cartitems = Cart::where('user_id', Auth::id())->get();
        foreach ($old_cartitems as $item) {
            if (!ProductColorSize::where('product_id', $item->prod_id)->where('qty', '>=', $item->prod_qty)->exists()) {
                $removeItem = Cart::where('user_id', Auth::id())->where('prod_id', $item->prod_id)->first();
                $removeItem->delete();
            }
        }
        $getCartData = Cart::where('user_id' , Auth::id())->get();
        $grandTotal = 0;
        foreach($getCartData as $item){
            $grandTotal += (int)$item->products->selling_price * (int)$item->prod_qty;
        }

        $cartitems = Cart::with('products.productColorSizes.color')->where('user_id', Auth::id())->get();
        // $color = Color::select('id', 'name')->get();
        // dd($cartitems);
        $categories = Category::take(4)->get();
        $getCate = Category::where('status' , '0')->get();
        $Settings = Setting::first();
        $shipping = Shipping::get();

        return view('frontend.checkoutPage', compact('shipping','Settings','getCate','categories','cartitems' , 'grandTotal'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'shipping' => 'required',
            'fname'    => 'required',
            'lname'    => 'required',
            'email'    => 'required',
            'phone_num' => 'required',
            'addr1' => 'required',
            'addr2' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'pincode' => 'required',

        ]);
        $order = new Order();
        $order->user_id = Auth::id();
        $order->fname = $request->input('fname');
        $order->lname = $request->input('lname');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone_num');
        $order->address1 = $request->input('addr1');
        $order->address2 = $request->input('addr2');
        $order->city = $request->input('city');
        $order->state = $request->input('state');
        $order->country = $request->input('country');
        $order->pincode = $request->input('pincode');

        // To Calculate the total price
        $total = 0;
        $cartitems_total = Cart::where('user_id' , Auth::id())->get();
        foreach($cartitems_total as $prod){
            $total += ((int)$prod->products->selling_price * (int)$prod->prod_qty);
        }
        $order->total_price = $total + (int)$request->shipping .'$';
        $order->shipping_costs = $request->shipping;

        $order->tracking_no = $request->fname . '' . $request->lname . random_int(1111, 9999);
        $order->save();


        $cartitems = Cart::where('user_id', Auth::id())->get();
        foreach ($cartitems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'prod_id'  => $item->prod_id,
                'colorID'  => $item->colorID,
                'sizeID'   => $item->sizeID,
                'qty'      => $item->prod_qty,
                'price'    => $item->products->selling_price,
            ]);

            $prod = ProductColorSize::where('product_id' , $item->prod_id)->first();
            $prod->qty = $prod->qty - $item->prod_qty;
            $prod->update();
        }
        if (Auth::user()->address1 == Null) {
            $user = User::where('id', Auth::id())->first();
            $user->name = $request->input('fname');
            $user->lname = $request->input('lname');
            // $user->email = $request->input('email');
            $user->phone = $request->input('phone_num');
            $user->address1 = $request->input('addr1');
            $user->address2 = $request->input('addr2');
            $user->city = $request->input('city');
            $user->state = $request->input('state');
            $user->country = $request->input('country');
            $user->pincode = $request->input('pincode');
            $user->update();
        }
        $cartitems = Cart::where('user_id', Auth::id())->get();
        Cart::destroy($cartitems);
        return redirect('/')->with('success' , 'The order was processed successfully');
    }

    public function razerpaycheck(Request $request){
        $cartitems = Cart::where('user_id' , Auth::id())->get();
        $total_price = 0;
        foreach($cartitems as $item){
            $total_price += (int)$item->products->selling_price * (int)$item->prod_qty;
        }
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address1 = $request->input('address1');
        $address2 = $request->input('address2');
        $city = $request->input('city');
        $state = $request->input('state');
        $country = $request->input('country');
        $pincode = $request->input('pincode');

        return response()->json([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'phone' => $phone,
            'address1' => $address1,
            'address2' => $address2,
            'city' => $city,
            'state' => $state,
            'country' => $country,
            'pincode' => $pincode,
            'total_price' => $total_price.'$'
        ]);
    }
}
