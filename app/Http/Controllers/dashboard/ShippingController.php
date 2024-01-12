<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function index() {
        $shipp = Shipping:: select('id', 'name', 'price')->get();
        return view('admin.shipping.index', compact('shipp'));
    }

    public function create() {
        return view('admin.shipping.create');
    }

    public function store(Request $request) {
        $validateData = $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);
        if($validateData) {
            Shipping::create([
                'name' => $request->name,
                'price' => $request->price . '$',
            ]);
        }

        return redirect()->route('all.main.shipping')->with('success', 'تم اضافة سعر الشحن');
    }
    public function edit($id) {
        $shipp = Shipping::find($id);

        return view('admin.shipping.edit', compact('shipp'));
    }
    public function update(Request $request, $id) {
        $shipp = Shipping::find($id);
        $shipp->name = $request->name;
        $priceWithoutDollarSign = str_replace('$', '', $request->price);
$shipp->price = $priceWithoutDollarSign . '$';
        $shipp->update();

        return redirect()->route('all.main.shipping')->with('success', 'تم تحديث سعر الشحن');
    }

    public function destroy($id) {
        $shipp = Shipping::find($id);
        $shipp->delete();

        return redirect()->route('all.main.shipping')->with('success', 'تم حذف سعر الشحن');
    }
}
