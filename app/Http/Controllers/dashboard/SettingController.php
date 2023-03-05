<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
// use Image;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }
    public function getSetting()
    {
        $getShowSettings = Setting::first();
        // dd($getShowSettings);

        return view('admin.settings.addSettings', compact('getShowSettings'));
    }
    public function setSittings(Request $request)
    {
        $validate = $request->validate([
            'nameWebsite' => "max:30",
            'Description'
        ]);


        $get_id = Setting::select('id', 'favicon', 'meta_image')->first();
        // Check if record exits or Not
        if (isset($get_id->id)) {
            if ($request->hasFile('favicon')) {
                $pathImg = str_replace('\\', '/', public_path('uploading/')) . $get_id->favicon;
                if (File::exists($pathImg)) {
                    File::delete($pathImg);
                    $myimage = $request->favicon;
                    $time = time();
                    $newImage = Image::make($myimage->getRealPath())->encode('webp', 100)->resize(50, 50)->save(public_path('uploading/' .  $time . '.webp'));
                    DB::table('sittings')->where('id', $get_id->id)->update([
                        'favicon' => $time . '.' . 'webp'
                    ]);
                }
            }
            if ($request->hasFile('meta_image')) {
                $pathImg = str_replace('\\', '/', public_path('uploading/')) . $get_id->meta_image;
                if (File::exists($pathImg)) {
                    File::delete($pathImg);
                    $myimage = $request->meta_image;
                    $time_two = 'images' . time();
                    $newImage = Image::make($myimage->getRealPath())->encode('webp', 100)->resize(150, 150)->save(public_path('uploading/' .  $time_two . '.webp'));
                    DB::table('sittings')->where('id', $get_id->id)->update([
                        'meta_image' => $time_two . '.' . 'webp'
                    ]);
                }
            }
            $insertToDataBase = DB::table('sittings')->where('id', $get_id->id)->update([
                'nameWebsite' => $request->nameWebsite,
                'linkWebsite' => $request->linkWebsite,
                'Description' => $request->Description,
                'count_University' => $request->count_University,
                'socialMidiaFacebook' => $request->socialMidiaFacebook,
                'socialMidiaTelegram' => $request->socialMidiaTelegram,
                'socialMidiaInstagram' => $request->socialMidiaInstagram,
                'socialMidiaYoutube' => $request->socialMidiaYoutube,
                'Keywords' => $request->Keywords,
            ]);
            return redirect()->back()->with('msg', 'تم تحديث بنجاح');
        } else {
            if ($request->hasFile('favicon')) {
                $myimage = $request->favicon;
                $time = time();
                $newImage = Image::make($myimage->getRealPath())->encode('webp', 100)->resize(150, 150)->save(public_path('uploading/' .  $time . '.webp'));
            }
            if ($request->hasFile('meta_image')) {
                $myimage = $request->meta_image;
                $time_two = 'images' . time();
                $newImage = Image::make($myimage->getRealPath())->encode('webp', 100)->resize(150, 150)->save(public_path('uploading/' .  $time_two . '.webp'));
            }
            $insertToDataBase = DB::table('sittings')->insert([
                'nameWebsite' => $request->nameWebsite,
                'linkWebsite' => $request->linkWebsite,
                'Description' => $request->Description,
                'count_University' => $request->count_University,
                'socialMidiaFacebook' => $request->socialMidiaFacebook,
                'socialMidiaTelegram' => $request->socialMidiaTelegram,
                'socialMidiaInstagram' => $request->socialMidiaInstagram,
                'socialMidiaYoutube' => $request->socialMidiaYoutube,
                'Keywords' => $request->Keywords,
                'favicon' => $time . '.' . 'webp',
                'meta_image' => $time_two . '.' . 'webp'
            ]);
            return redirect()->back()->with('msg', 'تم الحفظ بنجاح');
        }
    }
}
