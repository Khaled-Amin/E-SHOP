<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Slider;
use Intervention\Image\Facades\Image;
class SliderController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function index()
    {
        $allSlider = Slider::all();
        return view('admin.slider.AllSlider' , compact('allSlider'));
    }


    public function create()
    {
        return view('admin.slider.createSlider');
    }


    public function store(Request $request)
    {
        $validate = $request->validate([
            'slider_img' => 'required | mimes:png,jpg,jpeg',
        ]);

            if($request->hasFile('slider_img')){
                $myImg = $request->file('slider_img');
                $time = time();
                $newImage = Image::make($myImg->getRealPath())->encode('webp' , 100)->resize(1280 , 768)->save(public_path('uploading/' .  $time . '.webp' ));
            }
            else{
                $time = Null;
            }
            if($validate){
                $insertSlider = DB::table('sliders')->insert([
                    'slider_pic' => $time . '.' .'webp',
                ]);
            }

        return redirect()->route('slider.main')->with('success' , 'تم اضافة سلايدر');

    }

    // public function show($id)
    // {
    //     //
    // }


    public function edit($id)
    {
        $slider = Slider::find($id);
        return view('admin.slider.editSlider' , compact('slider'));
    }


    public function update(Request $request, $id)
    {
        $slider = Slider::find($id);
        $validate = $request->validate([
            'slider_img' => 'required | mimes:png,jpg,jpeg',
        ]);
        $pathImg = str_replace('\\', '/', public_path('uploading/')) . $slider->slider_pic;
        if($request->hasFile('slider_img')){
            if(File::exists($pathImg)){
                File::delete($pathImg);
            }
            $myImg = $request->slider_img;
            $time = time();
            $newImage = Image::make($myImg->getRealPath())->encode('webp' , 100)->resize(1280 , 768)->save(public_path('uploading/' .  $time . '.webp' ));
            DB::table('sliders')->where('id' , $id)->update([
                'slider_pic'  => $time . '.' .'webp'
            ]);
        }

        return redirect()->route('slider.main')->with('success' , 'تم تحديث سلايدر');

    }


    public function destroy($id)
    {
        $slider = Slider::find($id);
        $destination =  str_replace('\\' , '/' ,public_path('uploading/')) . $slider->slider_pic;
        if(File::exists($destination)){
            File::delete($destination);
        }
        $slider->delete();
        return  redirect()->route('slider.main')
            ->with('success' , 'تم حذف بنجاح');
    }
}
