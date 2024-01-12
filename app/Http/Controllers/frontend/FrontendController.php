<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use App\Models\ProductColorSize;
use Illuminate\Support\Facades\DB;
use App\Models\Rating;
use App\Models\Setting;
use App\Models\Slider;

class FrontendController extends Controller
{
    public function index(){
        $getProductTrending = Product::inRandomOrder()->get();
        $getCate_Trending = Category::where('popular' , '1')->take(10)->get();
        $statusC = Category::where('popular' , '1')->first();
        $categories = Category::take(4)->get();
        $slider = Slider::all();
        $getcateslide = Category::take(4)->get();
        $getCate = Category::where('status' , '0')->get();
        $Settings = Setting::first();
        return view('frontend.index' , compact('statusC','Settings','getCate','getcateslide','slider','categories','getProductTrending' , 'getCate_Trending'));
    }


    public function productInFooter()
    {
        $getCate = Category::where('status' , '0')->get();
        $categories = Category::take(4)->get();
        $Settings = Setting::first();
        return view('layouts.front' , compact('Settings','getCate','categories'));
    }

    public function getAllCategory(){
        $getCate = Category::where('status' , '0')->get();
        $categories = Category::take(4)->get();
        $Settings = Setting::first();
        return view('frontend.categoryall' , compact('Settings','categories','getCate'));
    }

    public function viewCategory($slug){
        $getCate = Category::where('status' , '0')->get();
        if(Category::where('slug' , $slug)->exists()){
            $category = Category::where('slug' , $slug)->first();
            $products = Product::where('cate_id' , $category->id)->where('status' , '0')->get();
            $categories = Category::take(4)->get();
            $Settings = Setting::first();
            return view('frontend.products.index' , compact('Settings','getCate','category' , 'products' , 'categories'));
        }
        else{
            return redirect()->route('homePage')->with('status' , 'Sorry, the link does not exist');
        }
    }
    public function productView($cate_slug , $prod_slug){
        $getCate = Category::where('status' , '0')->get();
        if(Category::where('slug' , $cate_slug)->exists()){
            if(Product::where('slug' , $prod_slug)->exists()){
                $products = Product::with('productColorSizes')->where('slug' , $prod_slug)->first();
                $getMultiImageOfProduct = Product::with('productColorSizes')->where('slug' , $prod_slug)->get();
                $color = Color::get();
                $getProdQTY = ProductColorSize::where('product_id', $products->id)->sum('qty');
                $productID = $products->id;
                $product = ProductColorSize::select('products.id as product_id', 'products.name as product_name', 'products.selling_price', 'colors.name as color_name', 'sizes.value as size_value', 'product_attr.qty')
                    ->join('products', 'product_attr.product_id', '=', 'products.id')
                    ->join('colors', 'product_attr.color_id', '=', 'colors.id')
                    ->join('sizes', 'product_attr.size_id', '=', 'sizes.id')
                    ->where('products.id', $productID)
                    ->get();

                // dd($product);

                $ratings = Rating::where('prod_id' , $products->id)->get();
                $rating_sum = Rating::where('prod_id', $products->id)->sum('stars_rated');
                if($ratings->count()){
                    $rating_value = $rating_sum / $ratings->count();
                }
                else{
                    $rating_value = 0;
                }

                $categories = Category::take(4)->get();
                $Settings = Setting::first();
                return view('frontend.products.detailsProduct' , compact('getMultiImageOfProduct', 'getProdQTY','Settings','rating_value','ratings','getCate','categories','products'));
            }
            else{
                return redirect()->back()->with('success' , 'Sorry, the link does not exist');
            }
        }
        else{
            return redirect()->back()->with('success' , 'Sorry, there is no such category');
        }
    }

    public function getSize(Request $request) {
        $id_color = $request->colorID;
        $PoductID = $request->product_id;
        $sizesOfColor = ProductColorSize::with('size')->select('product_id','color_id', 'size_id', 'qty')
        ->where('product_id', $PoductID)
        ->where('color_id', $id_color)->get();

        return $sizesOfColor;
    }
    public function productListAjax()
    {
        $products = Product::select('name')->where('status' , '0')->get();
        $data=[];
        foreach($products as $item){
            $data[] = $item['name'];
        }
        return $data;
    }

    public function searchProduct(Request $request)
    {
        $searched_product = $request->q;

        if($searched_product != ''){
            $product = Product::where("name" , "LIKE" , "%$searched_product%")->first();
            if($product){
                return redirect('category/' . $product->category->slug . '/' . $product->slug);
            }
            else{
                return redirect()->back()->with('success' , 'We did not find what you are looking for');
            }
        }
        else{
            return redirect()->back();
        }
    }
}
