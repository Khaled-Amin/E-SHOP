<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/******************** Admin Route **********************/

Route::prefix('admin')->group(function(){
    /**********************************************   part login   ****************************************************************** */
    Route::get('/login' , [App\Http\Controllers\dashboard\AdminController::class, 'index'])->name('login_form');
    Route::post('/login/owner' , [App\Http\Controllers\dashboard\AdminController::class, 'Login'])->name('admin.login');
    Route::get('/dashboard' , [App\Http\Controllers\dashboard\AdminController::class, 'Dashboard'])->name('admin.dashboard')
    ->middleware('admin');
    Route::get('/logout' , [App\Http\Controllers\dashboard\AdminController::class, 'AdminLogout'])->name('admin.logout')
    ->middleware('admin');
    Route::get('/register' , [App\Http\Controllers\dashboard\AdminController::class, 'AdminRegister'])->name('admin.register');
    Route::post('/register/create' , [App\Http\Controllers\dashboard\AdminController::class, 'AdminRegisterCreate'])->name('admin.register.create');
/**********************************************   end part login   ****************************************************************** */

/*========================================== Add Slider ==========================================*/
Route::get('/slider' , [App\Http\Controllers\dashboard\SliderController::class, 'index'])->name('slider.main');
Route::get('/slider/create' , [App\Http\Controllers\dashboard\SliderController::class, 'create'])->name('create.slider');
Route::post('/slider/store' , [App\Http\Controllers\dashboard\SliderController::class, 'store'])->name('store.slider');
Route::get('/slider/edit/{id}' , [App\Http\Controllers\dashboard\SliderController::class, 'edit'])->name('edit.slider');
Route::post('/slider/update/{id}' , [App\Http\Controllers\dashboard\SliderController::class, 'update'])->name('update.slider');
Route::get('/slider/destroy/{id}' , [App\Http\Controllers\dashboard\SliderController::class, 'destroy'])->name('destroy.slider');
/*==========================================  End Slider ==========================================*/



/**********************************************   Categories   ****************************************************************** */
    Route::get('/categories' , [App\Http\Controllers\dashboard\CategoryController::class, 'index'])->name('all.main.categories');
    Route::get('/create-category' , [App\Http\Controllers\dashboard\CategoryController::class, 'create'])->name('create.categories');
    Route::post('/store-categories' , [App\Http\Controllers\dashboard\CategoryController::class, 'store'])->name('store.categories');
    Route::get('/edit-categories/{id}' , [App\Http\Controllers\dashboard\CategoryController::class, 'edit'])->name('edit.categories');
    Route::post('/update-categories/{id}' , [App\Http\Controllers\dashboard\CategoryController::class, 'update'])->name('update.categories');
    Route::get('/destroy-categories/{id}' , [App\Http\Controllers\dashboard\CategoryController::class, 'destroy'])->name('destroy.categories');
/**********************************************   End Categories   ****************************************************************** */

/**********************************************   Products   ****************************************************************** */
Route::get('/products' , [App\Http\Controllers\dashboard\ProductController::class, 'index'])->name('all.main.products');
Route::get('/create-products' , [App\Http\Controllers\dashboard\ProductController::class, 'create'])->name('create.products');
Route::post('/store-products' , [App\Http\Controllers\dashboard\ProductController::class, 'store'])->name('store.products');
Route::get('/edit-products/{id}' , [App\Http\Controllers\dashboard\ProductController::class, 'edit'])->name('edit.products');
Route::post('/update-products/{id}' , [App\Http\Controllers\dashboard\ProductController::class, 'update'])->name('update.products');
Route::get('/destroy-products/{id}' , [App\Http\Controllers\dashboard\ProductController::class, 'destroy'])->name('destroy.products');
/**********************************************   End Products   ****************************************************************** */



/**********************************************   Start Orders   ****************************************************************** */

Route::get('/orders' , [App\Http\Controllers\dashboard\OrderController::class, 'index'])->name('all.main.orders');
Route::get('view-order/{id}' , [App\Http\Controllers\dashboard\OrderController::class, 'view'])->name('show.orders');
Route::put('update-order/{id}' , [App\Http\Controllers\dashboard\OrderController::class, 'updateOrder'])->name('update.orders');
Route::get('order-history' , [App\Http\Controllers\dashboard\OrderController::class, 'orderHistory'])->name('history.orders');

/**********************************************   End Orders   ****************************************************************** */



/**********************************************   Start Users   ****************************************************************** */

Route::get('users' , [App\Http\Controllers\dashboard\DashboardController::class, 'users'])->name('users');
Route::get('view-users/{id}' , [App\Http\Controllers\dashboard\DashboardController::class, 'viewUsers'])->name('view.users');

/**********************************************   End Users   ****************************************************************** */

/*========================================== Settings ==============================================*/
Route::get('/sittings', [App\Http\Controllers\dashboard\SettingController::class, 'getSetting'])->name('admin.sittings');
Route::post('/setter', [App\Http\Controllers\dashboard\SettingController::class, 'setSittings'])->name('admin.setSittings');
/*========================================== End Settings ==========================================*/

});
/******************** End Admin Route **********************/



/******************** Frontend Route **********************/
Route::get('/' , [App\Http\Controllers\frontend\FrontendController::class , 'index'])->name('homePage');
Route::get('category/' , [App\Http\Controllers\frontend\FrontendController::class , 'getAllCategory'])->name('categoryAll');
Route::get('view-category/{slug}' , [App\Http\Controllers\frontend\FrontendController::class , 'viewCategory'])->name('productBycategory');
Route::get('category/{cate_slug}/{prod_slug}' , [App\Http\Controllers\frontend\FrontendController::class , 'productView'])->name('showProduct');
// Cart
Route::post('add-to-cart' , [App\Http\Controllers\frontend\CartController::class , 'addProduct'])->name("getProduct.cart");
Route::post('delete-cart-item' , [App\Http\Controllers\frontend\CartController::class , 'removeProduct'])->name("removeProductIn.cart");
Route::post('update-cart' , [App\Http\Controllers\frontend\CartController::class , 'updateCart'])->name("update.cart");
// Wishlist
Route::post('add-to-wishlist' , [App\Http\Controllers\frontend\WishlistController::class , 'add'])->name('wishlist.add');
Route::post('delete-wishlist-item' , [App\Http\Controllers\frontend\WishlistController::class , 'deleteItem'])->name("deleteItem.wishlist");


// count cart route
Route::get('load-cart-data' , [App\Http\Controllers\frontend\CartController::class , 'cartCount'])->name("load.cart");
// count wishlist route
Route::get('load-wishlist-data' , [App\Http\Controllers\frontend\WishlistController::class , 'wishlistCount'])->name("load.wishlist");
// Proced to pay
Route::post('proced-to-pay' , [App\Http\Controllers\frontend\CheckoutController::class , 'razerpaycheck'])->name("razor.check");
// search Auto Complete
Route::get('product-list' , [App\Http\Controllers\frontend\FrontendController::class , 'productListAjax'])->name("autoComplete.productList");
// searchProduct
Route::post('searchProduct' , [App\Http\Controllers\frontend\FrontendController::class , 'searchProduct'])->name("search");

Route::middleware(['auth'])->group(function () {
    Route::get('cart' , [App\Http\Controllers\frontend\CartController::class , 'viewCart'])->name('show.cart');
    Route::get('checkout' , [App\Http\Controllers\frontend\CheckoutController::class , 'index'])->name('show.checkout');
    Route::post('place-order' , [App\Http\Controllers\frontend\CheckoutController::class , 'placeOrder'])->name('set.placeOrder');
    Route::get('my-orders' , [App\Http\Controllers\frontend\UserController::class , 'index'])->name('user.oreder');
    Route::get('view-order/{id}' , [App\Http\Controllers\frontend\UserController::class , 'view'])->name('user.ViewOreder');
    Route::get('wishlist' , [App\Http\Controllers\frontend\WishlistController::class , 'index'])->name('wishlist');
    Route::post('add-rating' , [App\Http\Controllers\frontend\RatingController::class , 'add'])->name('rate');

});

/******************** End Frontend Route **********************/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboardd', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
