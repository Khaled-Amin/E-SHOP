<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index() {
        $colors = Color:: select('id', 'name', 'code', 'status')->get();
        return view('admin.colors.index', compact('colors'));
    }

    public function create() {
        return view('admin.colors.create');
    }

    public function store(ColorFormRequest $request) {
        $validateData = $request->validated();
        if($validateData) {
            Color::create([
                'name' => $request->name,
                'code' => $request->code,
                'status' => $request->status == true ? 1 : 0 ,
            ]);
        }

        return redirect()->route('all.main.colors')->with('success', 'تم اضافة اللون');
    }
    public function edit($id) {
        $colors = Color::find($id);

        return view('admin.colors.edit', compact('colors'));
    }
    public function update(ColorFormRequest $request, $id) {
        $colors = Color::find($id);
        $colors->name = $request->name;
        $colors->code = $request->code;
        $colors->status = $request->status == true ? 1 : 0;
        $colors->update();

        return redirect()->route('all.main.colors')->with('success', 'تم تحديث اللون');
    }

    public function destroy($id) {
        $colors = Color::find($id);
        $colors->delete();

        return redirect()->route('all.main.colors')->with('success', 'تم حذف اللون');
    }
}
