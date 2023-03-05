<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index(){
        $category = Category::select('id' , 'name' , 'slug' , 'description' , 'status' , 'popular' , 'image')->get();
        return view('admin.category.allCategory' , compact('category'));
    }

    public function create(){
        return view('admin.category.createCategory');
    }

    public function store(Request $request){

        $request->validate([
            'category_name'         => 'required',
            'slug'         => 'required',
            'descrip'  => 'required',
            'photo'        => 'required|file|mimes:png,jpg,jpeg,svg,gif|max:1024'
        ]);
        // $category = new Category();

        // if($request->hasfile('image')){
        //     $file = $request->file('image');
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = time() . '.' . $extension;
        //     $file->move('uploading/', $filename);
        //     $category->image = $filename;
        // }
        if($request->hasFile('photo')){
            $time = time();
            $image = Image::make($request->file('photo')->getRealPath())->encode('webp', 100)->resize(1280 , 768)->save(public_path('uploading/'  .  $time . '.webp'));
            // $newImageName = time(). '.' . $request->photo->extension();
            // $request->photo->move(public_path('uploading/') , $newImageName);
        }else{
            $time = Null;
        }

        $category = Category::create([
            'name'          => $request->input('category_name'),
            'slug'          => $request->input('slug'),
            'description'   => $request->input('descrip'),
            'meta_title'    => $request->input('meta_title'),
            'meta_keywords' => $request->input('meta_keywords'),
            'meta_descrip'  => $request->input('meta_descrip'),
            'status'        => $request->input('status') == TRUE ? '1' : '0',
            'popular'       => $request->input('popular') == TRUE ? '1' : '0',
            'image'         => $time . '.' .'webp',
        ]);
        
        // $category = new Category();
        // dd($category);
        // $category->name = $request->input('category_name');
        // $category->slug = $request->input('slug');
        // $category->description = $request->input('descrip');
        // $category->meta_title = $request->input('meta_title');
        // $category->meta_keywords = $request->input('meta_keywords');
        // $category-> = $request->input('meta_descrip');
        // $category->status = $request->input('status') == TRUE ? '1' : '0';
        // $category->popular = $request->input('popular') == TRUE ? '1' : '0';

        return redirect()->route('all.main.categories')
            ->with('success' , 'تم اضافة البيانات بنجاح');
    }

    public function edit($id){
        $getCategory_Id = Category::findOrFail($id);
        $category = Category::all();
        return view('admin.category.editCategory' , compact('getCategory_Id' , 'category'));
    }
    public function update(Request $request, Category $category , $id){
        $category = Category::find($id);
        $request->validate([
            'category_name'  => 'required',
            'slug'           => 'required',
            'descrip'        => 'required',
            // 'photo'          => 'required|file|mimes:png,jpg,jpeg,svg,gif|max:1024'
        ]);
        if($request->hasFile('photo')){
            $path = str_replace('\\' , '/' ,public_path('uploading/')).$category->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $time = time();
            $image = Image::make($request->file('photo')->getRealPath())->encode('webp', 100)->resize(1280 , 768)->save(public_path('uploading/'  .  $time . '.webp'));
            DB::table('categories')->where('id' , $id)->update([
                'image' =>  $time . '.' . 'webp'
            ]);
        }
        else{
            $time = Null;
            $imgCurrently = $category->image;
        }
        $category->name = $request->category_name;
        $category->slug = $request->slug;
        $category->description = $request->descrip;
        $category->meta_title = $request->meta_title;
        $category->meta_keywords = $request->meta_keywords;
        $category->meta_descrip = $request->meta_descrip;
        $category->status = $request->status == TRUE ? '1' : '0';
        $category->popular = $request->popular == TRUE ? '1' : '0';
        $category->update();
        return redirect()->route('all.main.categories')
            ->with('success' , 'تم تحديث البيانات بنجاح');
    }

    public function destroy($id){
        $getCategory_Id = Category::findOrFail($id);
        $path = str_replace('\\' , '/' ,public_path('uploading/')).$getCategory_Id->image;
        if(File::exists($path)){
            File::delete($path);
        }
        $getCategory_Id->delete();

        return redirect()->route('all.main.categories')
            ->with('success' , 'تم حذف بنجاح');

    }
}
