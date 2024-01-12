<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SizeFormRequest;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::select('id', 'value', 'status')->get();
        return view('admin.sizes.index', compact('sizes'));
    }

    public function create()
    {
        return view('admin.sizes.create');
    }

    public function store(SizeFormRequest $request)
    {
        $validateData = $request->validated();
        if ($validateData) {
            Size::create([
                'value' => $request->value,
                'status' => $request->status == true ? 1 : 0,
            ]);
        }

        return redirect()->route('all.main.sizes')->with('success', 'تم اضافة المقاس');
    }
    public function edit($id)
    {
        $sizes = Size::find($id);

        return view('admin.sizes.edit', compact('sizes'));
    }
    public function update(SizeFormRequest $request, $id)
    {
        $sizes = Size::find($id);
        $sizes->value = $request->value;
        $sizes->status = $request->status == true ? 1 : 0;
        $sizes->update();

        return redirect()->route('all.main.sizes')->with('success', 'تم تحديث المقاس');
    }

    public function destroy($id)
    {
        $sizes = Size::find($id);
        $sizes->delete();

        return redirect()->route('all.main.sizes')->with('success', 'تم حذف المقاس');
    }
}
