<?php

// use App\Http\Controllers\cardController;
use App\Http\Controllers\cardController;
use App\Http\Controllers\cardSectionController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\demoController;
use App\Http\Controllers\heroSectionController;
use App\Http\Controllers\permissioncontroller;
use App\Http\Controllers\rolecontroller;
use App\Http\Controllers\userApiCalling;
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

    Route::post('refresh', [userController::class, 'refresh'])->name('refresh-post');
    Route::post('logout', [userController::class, 'logout'])->name('logout-post');
    Route::delete('delete-user/{id}', [userController::class, 'deleteUser']);
    Route::post('permission-create', [permissioncontroller::class, 'store']);
    Route::get('permission-view/{id}', [permissioncontroller::class, 'show']);
    Route::get('permission-all', [permissioncontroller::class, 'index']);
    Route::post('permission-update/{id}', [permissioncontroller::class, 'update']);
    Route::delete('permission-delete/{id}', [permissioncontroller::class, 'destroy']);
    Route::post('update-role', [permissioncontroller::class, 'update_role']);
    Route::post('assignrole', [permissioncontroller::class, 'assignrole']);
    Route::get('permission-all-drop', [permissioncontroller::class, 'permission_all']);

    Route::post('role-create', [rolecontroller::class, 'store']);
    Route::get('role-view/{id}', [rolecontroller::class, 'show']);
    Route::get('role-all', [rolecontroller::class, 'index']);
    Route::get('role-all-drop', [rolecontroller::class, 'role_all']);
    Route::post('role-update/{id}', [rolecontroller::class, 'update']);
    Route::delete('role-delete/{id}', [rolecontroller::class, 'destroy']);
    Route::post('update-permission', [rolecontroller::class, 'update_permission']);
    Route::post('assignpermission', [rolecontroller::class, 'assignpermission']);

    Route::post('store', [heroSectionController::class, 'store'])->name('store-post');
    Route::post('update/{id}', [heroSectionController::class, 'update'])->name('update-post');
    Route::delete('delete/{id}', [heroSectionController::class, 'destroy'])->name('delete-post');
    Route::get('view/{id}', [heroSectionController::class, 'show'])->name('show-get');
    Route::get('preview/{id}', [heroSectionController::class, 'preview'])->name('preview-get');
    Route::get('view-all', [heroSectionController::class, 'index'])->name('showAll-get');

    Route::get('count', [dashboardController::class, 'index']);
    Route::get('role', [dashboardController::class, 'role']);

    Route::post('card-create', [cardController::class, 'store']);
    Route::get('card-view', [cardController::class, 'index']);
    Route::get('card-view/{id}', [cardController::class, 'show']);
    Route::post('card-update/{id}', [cardController::class, 'update']);
    Route::delete('card-delete/{id}', [cardController::class, 'destroy']);

    Route::post('card-section-create', [cardSectionController::class, 'store']);
    Route::get('card-section-view', [cardSectionController::class, 'index']);
    Route::get('card-section-view/{id}', [cardSectionController::class, 'show']);
    Route::post('card-section-update/{id}', [cardSectionController::class, 'update']);
    Route::delete('card-section-delete/{id}', [cardSectionController::class, 'destroy']);

    Route::post('demo-create', [demoController::class, 'demo']);

});
