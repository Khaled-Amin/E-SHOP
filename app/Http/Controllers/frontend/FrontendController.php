<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Rating;
use App\Models\Setting;
use App\Models\Slider;

class FrontendController extends Controller
{
    public function index(){
        $getProductTrending = Product::where('trending' , '1')->take(4)->get();
        $getCate_Trending = Category::where('popular' , '1')->take(10)->get();
        $categories = Category::take(4)->get();
        $slider = Slider::all();
        $getcateslide = Category::take(4)->get();
        $getCate = Category::where('status' , '0')->get();
        $Settings = Setting::first();
        return view('frontend.index' , compact('Settings','getCate','getcateslide','slider','categories','getProductTrending' , 'getCate_Trending'));
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
            return redirect()->route('homePage')->with('status' , 'عذرا غير موجود هذا الرابط');
        }
    }
    public function productView($cate_slug , $prod_slug){
        $getCate = Category::where('status' , '0')->get();
        if(Category::where('slug' , $cate_slug)->exists()){
            if(Product::where('slug' , $prod_slug)->exists()){
                $products = Product::where('slug' , $prod_slug)->first();
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
                return view('frontend.products.detailsProduct' , compact('Settings','rating_value','ratings','getCate','categories','products'));
            }
            else{
                return redirect()->back()->with('success' , 'عذرا الرابط غير موجود');
            }
        }
        else{
            return redirect()->back()->with('success' , 'عذرا لايوجد مثل هذا التصنيف');
        }
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
                return redirect()->back()->with('success' , 'لم نعثر على ما تبحث عنه');
            }
        }
        else{
            return redirect()->back();
        }
    }
}
