<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use App\Models\ProductColorSize;
use App\Models\Size;
use App\Models\Wishlist;
use App\Traits\UploadSingleImageTrait;
use App\Traits\UploadMultipleImagesTrait;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
class ProductController extends Controller
{
    use UploadSingleImageTrait, UploadMultipleImagesTrait;
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
        $colors = Color::where('status', 1)->get();
        $sizes = Size::where('status', 1)->get();
        return view('admin.product.createProduct' , compact('sizes','colors','category'));
    }

    public function store(Request $request){
        $request->validate([
            'product_name'   => 'required',
            'slug'           => 'required',
            'small_descrip'  => 'required',
            'photo'          => 'required|file|mimes:png,jpg,jpeg,svg,gif,webp|max:2048'
        ],
        [
            'photo.required' => 'برجاء رفع صورة بحجم اصغر وبالصيغة المطلوبة'
        ]


        );

        // Process when a single image is uploaded
        $image = $request->file('photo');
        $uploadedImage = $this->processSingleImage($image, 'uploading/', true, 200, 310);

        // Process when multiple images are uploaded as albums
        $images = $request->file('albumsphoto');

        $uploadedMultipleImages = $this->processMultipleImages($images, 'uploadingMultiple/', true, 200, 310);

        $product = Product::create([
            'cate_id'               => $request->input('categor_id'),
            'name'                  => $request->input('product_name'),
            'slug'                  => $request->input('slug'),
            'small_description'     => $request->input('small_descrip'),
            'description'           => $request->input('descrip'),
            'original_price'        => $request->input('orig_price').'$',
            'selling_price'         => $request->input('sell_price').'$',
            'meta_title'            => $request->input('meta_title'),
            'meta_keywords'         => $request->input('meta_keywords'),
            'meta_description'      => $request->input('meta_descrip'),
            'status'                => $request->input('status') == TRUE ? '1' : '0',
            'trending'              => $request->input('popular') == TRUE ? '1' : '0',
            'image'                 => $uploadedImage,
            'albums'                => !empty($uploadedMultipleImages) && is_array($uploadedMultipleImages) ? implode(',', $uploadedMultipleImages) : null,
        ]);
        if($request->colors){
            if($request->sizes){
                foreach($request->colors as $colorId => $color){
                    foreach($request->sizes[$colorId] as $sizeId){

                        $product->productColorSizes()->create([
                            'product_id' => $product->id,
                            'color_id'   => $colorId,
                            'size_id'    => $sizeId,
                            'qty'        => $request->colorquantity[$colorId] ?? 0,
                        ]);
                    }
                }
            }
        }
        return redirect()->route('all.main.products')
            ->with('success' , 'تم اضافة البيانات بنجاح');
    }

    public function edit($id){
        $getProduct_Id = Product::with('productColorSizes')->find($id);
        $category = Category::all();
        $colors = Color::where('status', 1)->get();
        $sizes = Size::where('status', 1)->get();
        $productColorSizes = ProductColorSize::select('size_id', 'product_id')->where('product_id', $getProduct_Id->id)->get();
        // $quantities = $productColorSizes->flatMap(function ($item) {
        //     return [$item->size_id];
        // });
        // dd($quantities, $productColorSizes);

        return view('admin.product.editProduct' , compact('sizes', 'colors','getProduct_Id' , 'category'));
    }

    public function update(Request $request , Product $product , $id){

        $product = Product::find($id);
        $request->validate([
            'product_name'   => 'required',
            'slug'           => 'required',
            'small_descrip'  => 'required',
            // 'photo'          => 'required|file|mimes:png,jpg,jpeg,svg,gif,webp|max:1024'
        ]);
        // Process Update when single images are uploaded as Image
        $image = $request->file('photo');
        if ($image) {
            // Delete the old image if it exists
            $pathImage = public_path('uploading/' . $product->image);
            if (File::exists($pathImage)) {
                File::delete($pathImage);
            }
            $uploadedImage = $this->processSingleImage($image, 'uploading/', true, 350, 210);
            DB::table('products')->where('id', $product->id)->update([
                'image' => $uploadedImage,
            ]);
        }

        // Process when multiple images are uploaded as albums
        $images = $request->file('albumsphoto');
        if ($images) {
            $explodeAlbums = explode(',', $product->albums);
            foreach ($explodeAlbums as $key => $val) {
                $pathImage = public_path('uploadingMultiple/' . $val);
                if (File::exists($pathImage)) {
                    File::delete($pathImage);
                }
            }
            $uploadedMultipleImages = $this->processMultipleImages($images, 'uploadingMultiple/', true, 250, 252);
            // dd($uploadedImagesAlbums);
            $implodedImages = implode(',', $uploadedMultipleImages);
            $albums = $implodedImages !== '' ? $implodedImages : '';
            DB::table('products')->where('id', $product->id)->update([
                'albums' => $albums,
            ]);
        }

        $product->cate_id               = $request->categor_id;
        $product->name                  = $request->product_name;
        $product->slug                  = $request->slug;
        $product->small_description     = $request->small_descrip;
        $product->description           = $request->descrip;
        if (strpos($product->original_price, '$') !== false) {
            $product->original_price     = $request->orig_price;
        } else {
            $product->original_price     = $request->orig_price . '$';
        }
        if (strpos($product->selling_price, '$') !== false) {
            $product->selling_price         = $request->sell_price;
        } else {
            $product->selling_price         = $request->sell_price . '$';
        }

        $product->meta_title            = $request->meta_title;
        $product->meta_keywords         = $request->meta_keywords;
        $product->meta_description      = $request->meta_descrip;
        $product->status                = $request->status == TRUE ? '1' : '0';
        $product->trending               = $request->popular == TRUE ? '1' : '0';
        $product->update();
        if ($request->colors && $request->sizes) {
            foreach ($request->colors as $colorId => $color) {
                foreach ($request->sizes[$colorId] as $sizeId) {
                    // Check if the relationship already exists
                    $existingRecord = $product->productColorSizes()
                        ->where('color_id', $colorId)
                        ->where('size_id', $sizeId)
                        ->first();

                    if ($existingRecord) {
                        // Update the existing record
                        $existingRecord->update([
                            'qty' => $request->colorquantity[$colorId] ?? 0,
                        ]);
                    } else {
                        // Create a new record
                        $product->productColorSizes()->create([
                            'color_id' => $colorId,
                            'size_id' => $sizeId,
                            'qty' => $request->colorquantity[$colorId] ?? 0,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('all.main.products')->with('success' , 'تم تحديث البيانات بنجاح');


    }
    public function destroy($id){
        $getProduct_Id = Product::findOrFail($id);
        $path = str_replace('\\' , '/' ,public_path('uploading/')).$getProduct_Id->image;
        if(File::exists($path)){
            File::delete($path);
        }
        $show_Pic = Product::select('id', 'albums')->where('id', $getProduct_Id->id)->first();
        $get_Pictrue = explode(",", $show_Pic->albums);
        $this->deleteMultiImage($get_Pictrue);
        Cart::where('prod_id', $id)->delete();
        Wishlist::where('prod_id', $id)->delete();
        $getProduct_Id->delete();

        return redirect()->route('all.main.products')
            ->with('success' , 'تم حذف بنجاح');

    }

    public static function deleteMultiImage($getPictures)
    {
        foreach ($getPictures as $index => $val) {
            $pathImg_slider =  str_replace('\\', '/', public_path('uploadingMultiple/')) . $val;
            if (File::exists($pathImg_slider)) {
                File::delete($pathImg_slider);
            }
        }
        return $getPictures;
    }
}
