<?php

use App\Http\Controllers\Backend\AdminAuthController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontendController::class,'index']);
Route::get('/category-products/{slug}/{id}',[FrontendController::class,'categoryProducts']);
Route::get('/subcategory-products/{slug}/{id}',[FrontendController::class,'subCategoryProducts']);
Route::get('/shop', [FrontendController::class,'shopProducts']);
Route::get('/return-process', [FrontendController::class, 'returnProcess']);
Route::get('/product-details/{slug}', [FrontendController::class, 'productDetails']);
Route::get('/type-products/{type}', [FrontendController::class, 'typeProducts']);
Route::get('/view-cart-products',[FrontendController::class,'viewCart']);
Route::get('/checkout', [FrontendController::class,'checkOut']);

//Order placing process...
Route::post('/confirm-order', [FrontendController::class,'confirmOrder']);
Route::get('/success-order/{invoiceid}', [FrontendController::class,'successOrder']);



//add to cart routes..
Route::post('/product-details/add-to-cart/{product_id}',[FrontendController::class,'addToCartDetails']);
Route::get('/add-to-cart/{product_id}',[FrontendController::class,'addToCart']);
Route::get('/add-to-cart/delete/{id}',[FrontendController::class,'addToCartDelete']);


//Policy...

Route::get('/privacy-policy', [FrontendController::class,'privacyPolicy']);
Route::get('/terms-condition', [FrontendController::class,'termsCondition']);
Route::get('/refund-policy', [FrontendController::class,'refundPolicy']);
Route::get('/payment-policy', [FrontendController::class,'paymentPolicy']);
Route::get('/about-us', [FrontendController::class,'aboutUs']);
Route::get('/contact-us', [FrontendController::class,'contactUs']);
Route::post('/contact-message/store', [FrontendController::class,'contactMessageStore']);

//product searching.....
Route::get('/search-products',[FrontendController::class,'searchProducts']);

//Admin auth routes...
Route::get('/admin/login',[AdminAuthController::class,'loginForm']);
Route::get('/admin/logout',[AdminAuthController::class,'logoutAdmin']);
Auth::routes();
Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard']);

//Category routes...
Route::get('/admin/category/create',[CategoryController::class,'categoryCreate']);
Route::post('/admin/category/store',[CategoryController::class,'categoryStore']);
Route::get('/admin/category/list',[CategoryController::class,'categoryList']);
Route::get('/admin/category/delete/{id}',[CategoryController::class,'categoryDelete']);
Route::get('/admin/category/edit/{id}',[CategoryController::class,'categoryEdit']);
Route::post('/admin/category/update/{id}',[CategoryController::class,'categoryUpdate']);

//subcategory routes...

Route::get('/admin/sub-category/create',[SubCategoryController::class,'subCategoryCreate']);
Route::post('/admin/sub-category/store',[SubCategoryController::class,'subCategoryStore']);
Route::get('/admin/sub-category/list',[SubCategoryController::class,'subCategoryList']);
Route::get('/admin/sub-category/delete/{id}',[SubCategoryController::class,'subCategoryDelete']);
Route::get('/admin/sub-category/edit/{id}',[SubCategoryController::class,'subCategoryEdit']);
Route::post('/admin/sub-category/update/{id}',[SubCategoryController::class,'subCategoryUpdate']);

//Product routes...

Route::get('/admin/product/create',[ProductController::class,'productCreate']);
Route::post('/admin/product/store',[ProductController::class,'productStore']);
Route::get('/admin/product/list',[ProductController::class,'productList']);
Route::get('/admin/product/delete/{id}',[ProductController::class,'productDelete']);
Route::get('/admin/product/edit/{id}',[ProductController::class,'productEdit']);
Route::post('/admin/product/update/{id}',[ProductController::class,'productUpdate']);
Route::get('/admin/product/color/delete/{id}',[ProductController::class,'colorDelete']);
Route::get('/admin/product/size/delete/{id}',[ProductController::class,'sizeDelete']);
Route::get('/admin/product/galleryImage/delete/{id}',[ProductController::class,'galleryImageDelete']);
Route::get('/admin/product/galleryImage/edit/{id}',[ProductController::class,'galleryImageEdit']);
Route::post('/admin/product/galleryImage/update/{id}',[ProductController::class,'galleryImageUpdate']);


//settings....
Route::get('/admin/general-settings',[SettingController::class,'showSettings']);
Route::post('/admin/general-settings/update',[SettingController::class,'updateSettings']);

//policies and about us....
Route::get('/admin/policies',[SettingController::class,'showPolicies']);
Route::post('/admin/policies/update',[SettingController::class,'updatePolicies']);

//banner..
Route::get('/admin/show-banners',[SettingController::class,'showBanners']);
Route::get('/admin/edit-banners/{id}',[SettingController::class,'editBanners']);
Route::post('/admin/update-banners/{id}',[SettingController::class,'updateBanners']);

//contact message....
Route::get('/admin/contact-message/list',[SettingController::class,'showContactMessage']);
Route::get('/admin/contact-message/delete/{id}',[SettingController::class,'deleteContactMessage']);

//orders...
Route::get('/admin/orders/{status}',[OrderController::class,'showOrders']);
Route::post('/admin/orders/status/{id}',[OrderController::class,'updateOrderStatus']);
Route::get('/admin/orders/delete/{id}',[OrderController::class,'orderDelete']);
Route::get('/admin/orders/edit/{id}',[OrderController::class,'editOrder']);
Route::post('/admin/orders/update/{id}',[OrderController::class,'updateOrder']);




















