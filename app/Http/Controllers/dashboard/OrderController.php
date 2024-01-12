<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index(){
        $orders = Order::where('status' , '0')->get();
        return view('admin.orders.allOrders' , compact('orders'));
    }

    public function view($id){
        $orders = Order::where('id' , $id)->first();
        $getCate = Category::where('status' , '0')->get();
        $categories = Category::take(4)->get();
        $Settings = Setting::first();
        return view('admin.orders.viewOrders' , compact('Settings','categories','getCate','orders'));
    }
    public function updateOrder(Request $request , $id){
        $orders = Order::find($id);
        DB::table('orders')->where('id' , $id)->update([
            'status' => $request->input('oreder_status')
        ]);
        // $orders->status = $request->input('oreder_status');
        // $orders->upadte();
        return redirect('admin/orders')->with('success' , 'تم تحديث الطلب');
    }
    public function orderHistory(){
        $orders = Order::where('status' , '1')->get();
        $getCate = Category::where('status' , '0')->get();
        return view('admin.orders.allHistoryOrder' , compact('getCate','orders'));
    }
}
