<?php

use App\Http\Controllers\heroSectionController;
use App\Http\Controllers\userApiCalling;
use App\Http\Controllers\userController;
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

// Route::get('/', function() {
//     return view('HeroSection.heroSectionTable');
// });
// Route::get('/dashboard', function() {
//     return view('front-end.index');
// });

Route::get('/' , function() {
    return view('login');
});

Route::get('/register' , function() {
    return view('register');
});

Route::get('/dashboard' , function() {
    return view('front-end.index');
});

Route::get('/heroSection' , function() {
    return view('front-end.heroSection.herosSection');
});
Route::get('/permission' , function() {
    return view('front-end.permission.permission');
});
Route::get('/role' , function() {
    return view('front-end.role.role');
});
// Route::get('post',[userApiCalling::class,'index']);
// Route::middleware('checkUserLogin')->group(function() {
    // Route::get('/dashboard',[homeController::class, 'index'])->name('dashboard');

//      function index() {
//         return view('front-end.index');
//     }
//     Route::get('/logout',[authController::class, 'logout'])->name('logout');

//     Route::get('/product',[productController::class, 'index'])->name('product');
// // });

// // Route::middleware('checkUserLogout')->group(function() {
//     Route::get('/login', function() {
//         return view('login');
//     });
//     Route::post('/ ',[authController::class, 'login'])->name('login');

//     Route::get('/register',[authController::class, 'register_user'])->name('register_view');

//     Route::post('/register',[authController::class, 'register'])->name('register');
// });
