<?php

use App\Http\Controllers\heroSectionController;
use App\Http\Controllers\permissioncontroller;
use App\Http\Controllers\rolecontroller;
use App\Http\Controllers\userController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [userController::class, 'register'])->name('register-post');
Route::post('login', [userController::class, 'login'])->name('login-post');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [userController::class, 'logout'])->name('logout-post');
    Route::group(['middleware' => ['role:Admin']], function () {
        Route::post('permission-create', [permissioncontroller::class, 'store']);
        Route::get('permission-view/{id}', [permissioncontroller::class, 'show']);
        Route::get('permission-all', [permissioncontroller::class, 'index']);
        Route::put('permission-update', [permissioncontroller::class, 'update']);
        Route::delete('permission-delete/{id}', [permissioncontroller::class, 'destroy']);
        Route::post('assignrole', [permissioncontroller::class, 'assignrole']);

        Route::post('role-create', [rolecontroller::class, 'store']);
        Route::get('role-view/{id}', [rolecontroller::class, 'show']);
        Route::get('role-all', [rolecontroller::class, 'index']);
        Route::put('role-update', [rolecontroller::class, 'update']);
        Route::delete('role-delete/{id}', [rolecontroller::class, 'destroy']);
        Route::post('assignpermission', [rolecontroller::class, 'assignpermission']);
    });
    Route::post('store', [heroSectionController::class, 'store'])->name('store-post');
    // });
    Route::put('update/{id}', [heroSectionController::class, 'update'])->name('update-post');
    Route::delete('delete/{id}', [heroSectionController::class, 'destroy'])->name('delete-post');
    Route::get('view/{id}', [heroSectionController::class, 'show'])->name('show-get');
    Route::get('view', [heroSectionController::class, 'showAll'])->name('showAll-get');
});
