<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index(){
        $products = Product::all();
        return view('admin.product.allProduct' , compact('products'));
    }

    public function create(){
        $category = Category::all();
        return view('admin.product.createProduct' , compact('category'));
    }

    public function store(Request $request){
        $request->validate([
            'product_name'   => 'required',
            'slug'           => 'required',
            'small_descrip'  => 'required',
            'photo'          => 'required|file|mimes:png,jpg,jpeg,svg,gif,webp|max:1024'
        ]);

        if($request->hasFile('photo')){
            $time = time();
            $image = Image::make($request->file('photo')->getRealPath())->encode('webp', 100)->resize(300, 300)->save(public_path('uploading/'  .  $time . '.webp'));
            // $newImageName = time(). '.' . $request->photo->extension();
            // $request->photo->move(public_path('uploading/') , $newImageName);
        }else{
            $time = Null;
        }
        $product = Product::create([
            'cate_id'               => $request->input('categor_id'),
            'name'                  => $request->input('product_name'),
            'slug'                  => $request->input('slug'),
            'small_description'     => $request->input('small_descrip'),
            'description'           => $request->input('descrip'),
            'original_price'        => $request->input('orig_price').'$',
            'selling_price'         => $request->input('sell_price').'$',
            'qty'                   => $request->input('quantity'),
            'tax'                   => $request->input('taxx'),
            'meta_title'            => $request->input('meta_title'),
            'meta_keywords'         => $request->input('meta_keywords'),
            'meta_description'      => $request->input('meta_descrip'),
            'status'                => $request->input('status') == TRUE ? '1' : '0',
            'trending'              => $request->input('popular') == TRUE ? '1' : '0',
            'image'                 => $time . '.' .'webp',
        ]);

        return redirect()->route('all.main.products')
            ->with('success' , 'تم اضافة البيانات بنجاح');
    }

    public function edit($id){
        $getProduct_Id = Product::find($id);
        $category = Category::all();
        // dd($getProduct_Id->trending);
        return view('admin.product.editProduct' , compact('getProduct_Id' , 'category'));
    }

    public function update(Request $request , Product $product , $id){
        $product = Product::find($id);
        $request->validate([
            'product_name'   => 'required',
            'slug'           => 'required',
            'small_descrip'  => 'required',
            // 'photo'          => 'required|file|mimes:png,jpg,jpeg,svg,gif,webp|max:1024'
        ]);
        // if($request->photo !=null){
            if($request->hasFile('photo')){
                $path = str_replace('\\' , '/' ,public_path('uploading/')).$product->image;
                if(File::exists($path)){
                    File::delete($path);
                }
                $time = time();
                $image = Image::make($request->file('photo')->getRealPath())->encode('webp', 100)->resize(300 , 300)->save(public_path('uploading/'  .  $time . '.webp'));
                DB::table('products')->where('id' , $id)->update([
                    'image' =>  $time . '.' . 'webp'
                ]);
            }
            else{
                $time = Null;
                $imgCurrently = $product->image;
            }
            $product->cate_id               = $request->categor_id;
            $product->name                  = $request->product_name;
            $product->slug                  = $request->slug;
            $product->small_description     = $request->small_descrip;
            $product->description           = $request->descrip;
            $product->original_price        = $request->orig_price;
            $product->selling_price         = $request->sell_price;
            $product->qty                   = $request->quantity;
            $product->tax                   = $request->taxx;
            $product->meta_title            = $request->meta_title;
            $product->meta_keywords         = $request->meta_keywords;
            $product->meta_description      = $request->meta_descrip;
            $product->status                = $request->status == TRUE ? '1' : '0';
            $product->trending               = $request->popular == TRUE ? '1' : '0';
            $product->update();

            return redirect()->route('all.main.products')->with('success' , 'تم تحديث البيانات بنجاح');

        // }
    }
    public function destroy($id){
        $getProduct_Id = Product::findOrFail($id);
        $path = str_replace('\\' , '/' ,public_path('uploading/')).$getProduct_Id->image;
        if(File::exists($path)){
            File::delete($path);
        }
        $getProduct_Id->delete();

        return redirect()->route('all.main.products')
            ->with('success' , 'تم حذف بنجاح');

    }
}
