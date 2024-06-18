<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v2\AuthController;
use App\Http\Controllers\api\v2\BaseController;
use App\Http\Controllers\api\v2\BlogController;
use App\Http\Controllers\api\v2\HomeController;
use App\Http\Controllers\api\v2\ReviewController;
use App\Http\Controllers\api\v2\ContactController;
use App\Http\Controllers\api\v2\PaymentController;
use App\Http\Controllers\api\v2\ProductController;
use App\Http\Controllers\api\v2\CategoryController;
use App\Http\Controllers\api\v2\DashboardController;
use App\Http\Controllers\api\v2\AuthRegisterController;


Route::prefix('v2')->middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'tokenUser']);
    });


Route::prefix('v2')->group(function () {

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);


    //token user
    
    // Route::get('/user', [AuthController::class, 'tokenUser']);
    
   //admin login
   Route::post('/admin/register', [AuthRegisterController::class, 'register']);
Route::post('/admin/login', [AuthRegisterController::class, 'login']);

      
   

// Category
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categorys/create', [CategoryController::class, 'create']);
    Route::post('/categorys/store', [CategoryController::class, 'store']);
    Route::delete('/categorys/delete/{id}', [CategoryController::class, 'destroy']);

    // solutions with category
    Route::get('/category/solutions', [CategoryController::class, 'solutions']);


    
// Serices route
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/products/view/{id}', [ProductController::class, 'show'])->name('product.view');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::PUT('/products/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/products/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');

// Home page Route
Route::get('/categoryProduct', [HomeController::class, 'index']);
Route::get('/single/category/product', [HomeController::class, 'singleCatProduct']);


// Dashoboard Route

Route::get('/dashobard/index', [DashboardController::class, 'index']);
Route::get('/user/list', [DashboardController::class, 'UserList']);


Route::controller(BlogController::class)->group(function () {
    Route::get('blogs', 'index');
    Route::post('blog/store', 'store');
    Route::get('blog/{id}', 'show');
    Route::post('blog/{id}', 'update');
    Route::patch('blog/status/{id}', 'updateStatus');
    Route::delete('blog/{id}', 'destroy');
});
Route::controller(ContactController::class)->group(function () {
    Route::get('contacts', 'index');
    Route::post('contact/store', 'store');
    Route::get('contact/{id}', 'show');
    Route::delete('delete/{id}', 'destroy');
});


Route::controller(PaymentController::class)->group(function () {
    Route::get('payments', 'index');
    
});

// review Controller

Route::controller(ReviewController::class)->group(function () {
    Route::get('reviews', 'index');
    Route::get('review/{id}', 'show');
    Route::post('review/store', 'store');
    Route::post('review/{id}', 'update');
    Route::delete('review/{id}', 'destroy');
    
});



})->middleware('auth:sanctum');
