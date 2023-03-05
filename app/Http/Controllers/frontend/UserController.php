<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $orders = Order::where('user_id' , Auth::id())->get();
        $categories = Category::take(4)->get();
        $getCate = Category::where('status' , '0')->get();
        $Settings = Setting::first();
        return view('frontend.orders.index' , compact('Settings','getCate','categories','orders'));
    }

    public function view($id){
        $orders = Order::where('id' , $id)->where('user_id' , Auth::id())->first();
        $categories = Category::take(4)->get();
        $getCate = Category::where('status' , '0')->get();
        $Settings = Setting::first();
        return view('frontend.orders.view' , compact('Settings','getCate','categories','orders'));
    }
}
