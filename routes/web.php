<?php

use App\Http\Controllers\heroSectionController;
use App\Http\Controllers\userApiCalling;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('login');
})->name('login');
Route::get('/register', function () {
    return view('register');
});
// Route::middleware('auth')->group(function () {
Route::group(['middleware' => 'auth'], function () {
    // Route::auth();
    Route::get('/dashboard', function () {
        // dd(Auth::user());
        return view('front-end.index');
    });

    Route::get('/heroSection', function () {
        return view('front-end.heroSection.herosSection');
    });
});
Route::get('/permission', function () {
    return view('front-end.permission.permission');
});

Route::get('/role', function () {
    return view('front-end.role.role');
});

Route::get('/hero-add', function () {
    return view('front-end.heroSection.heroAdd');
});

Route::get('/permission-add', function () {
    return view('front-end.permission.permissionAdd');
});

Route::get('/role-add', function () {
    return view('front-end.role.roleAdd');
});

Route::get('/hero-update/{id}', function ($id) {
    return view('front-end.heroSection.heroUpdate');
});

Route::get('/permission-update/{id}', function () {
    return view('front-end.permission.permissionUpdate');
});

Route::get('/role-assign', function () {
    return view('front-end.role.roleAssign');
});

Route::get('/role-update/{id}', function () {
    return view('front-end.role.roleUpdate');
});
Route::get('/roleUpdate-Permission', function () {
    return view('front-end.role.rolePermissionUpdate');
});

Route::get('/permission-roleUpdate', function () {
    return view('front-end.permission.permissionRoleUpdate');
});

Route::get('/preview-data/{id}', function () {
    return view('front-end.heroSection.preview-data');
});
// });
