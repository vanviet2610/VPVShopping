<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Clients\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [UserController::class, 'index'])->name('login');
Route::get('/register', [UserController::class, 'create'])->name('register');
Route::post('/store', [UserController::class, 'store'])->name('auth.regis');
Route::post('/account', [UserController::class, 'account'])->name('auth.account');
Route::get('/logout', [UserController::class, 'logOut'])->name('auth.logout');
Route::get('/error403', function () {
    return view('layoutmaster.403');
})->name('403');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::prefix('menu')->group(function () {
            Route::get('/', [MenuController::class, 'index'])->name('menu.index')->middleware('checkpermis:view-menu');
            Route::get('/create', [MenuController::class, 'create'])->name('menu.create')->middleware('checkpermis:create-menu');
            Route::post('/store', [MenuController::class, 'store'])->name('menu.store');
            Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('menu.edit')->middleware('checkpermis:edit-menu');
            Route::post('/update/{id}', [MenuController::class, 'update'])->name('menu.update');
            Route::get('/delete/{id}', [MenuController::class, 'delete'])->name('menu.delete')->middleware('checkpermis:delete-menu');
            Route::get('/trash', [MenuController::class, 'trash'])->name('menu.trash')->middleware('checkpermis:trash-permission');
            Route::get('/restore/{id}', [MenuController::class, 'restore'])->name('menu.restore');
            Route::get('/forever/{id}', [MenuController::class, 'forever'])->name('menu.forever');
        });
        Route::prefix('slider')->group(function () {
            Route::get('/', [SliderController::class, 'index'])->name('slider.index')->middleware('checkpermis:view-slider');
            Route::get('/create', [SliderController::class, 'create'])->name('slider.create')->middleware('checkpermis:create-slider');
            Route::post('/store', [SliderController::class, 'store'])->name('slider.store');
            Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit')->middleware('checkpermis:edit-slider');
            Route::post('/update/{id}', [SliderController::class, 'update'])->name('slider.update');
            Route::post('/state/{id}', [SliderController::class, 'state'])->name('slider.state');
            Route::get('/trash', [SliderController::class, 'trash'])->name('slider.trash')->middleware('checkpermis:trash-slider');
            Route::get('/delete/{id}', [SliderController::class, 'delete'])->name('slider.delete')->middleware('checkpermis:delete-slider');
            Route::get('/restore/{id}', [SliderController::class, 'restore'])->name('slider.restore');
            Route::get('/forever/{id}', [SliderController::class, 'forever'])->name('slider.forever');
        });
        Route::prefix('category')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('category.index');
            Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
            Route::post('/create', [CategoryController::class, 'store'])->name('category.store');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
            Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
            Route::post('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
            Route::get('/trash', [CategoryController::class, 'trash'])->name('category.trash');
            Route::post('/restore/{id}', [CategoryController::class, 'restore'])->name('category.restore');
            Route::post('/forever/{id}', [CategoryController::class, 'forever'])->name('category.forever');
        });
        Route::prefix('category')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('category.index')->middleware('checkpermis:view-category');
            Route::get('/create', [CategoryController::class, 'create'])->name('category.create')->middleware('checkpermis:create-category');
            Route::post('/create', [CategoryController::class, 'store'])->name('category.store');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit')->middleware('checkpermis:edit-category');
            Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
            Route::post('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete')->middleware('checkpermis:delete-category');
            Route::get('/trash', [CategoryController::class, 'trash'])->name('category.trash')->middleware('checkpermis:trash-category');
            Route::post('/restore/{id}', [CategoryController::class, 'restore'])->name('category.restore');
            Route::post('/forever/{id}', [CategoryController::class, 'forever'])->name('category.forever');
        });
        Route::prefix('permission')->group(function () {
            Route::get('/', [PermissionController::class, 'index'])->name('permission.index')->middleware('checkpermis:view-permission');
            Route::get('/create', [PermissionController::class, 'create'])->name('permission.create')->middleware('checkpermis:create-permission');
            Route::post('/create', [PermissionController::class, 'store'])->name('permission.store');
            Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit')->middleware('checkpermis:edit-permission');
            Route::post('/edit/{id}', [PermissionController::class, 'update'])->name('permission.update');
            Route::delete('/delete/{id}', [PermissionController::class, 'delete'])->name('permission.delete')->middleware('checkpermis:delete-permission');
            Route::get('/trash', [PermissionController::class, 'trash'])->name('permission.trash')->middleware('checkpermis:trash-permission');
            Route::post('/trash/{id}', [PermissionController::class, 'restore'])->name('permission.restore');
            Route::post('/destroy/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy');
        });
        Route::prefix('roles')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('role.index')->middleware('checkpermis:view-role');
            Route::get('/create', [RoleController::class, 'create'])->name('role.create')->middleware('checkpermis:create-role');
            Route::post('/create', [RoleController::class, 'store'])->name('role.store');
            Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('role.edit')->middleware('checkpermis:edit-role');
            Route::post('/edit/{id}', [RoleController::class, 'update'])->name('role.update');
            Route::post('/delete/{id}', [RoleController::class, 'delete'])->name('role.delete')->middleware('checkpermis:delete-role');
            Route::get('/trash', [RoleController::class, 'trash'])->name('role.trash')->middleware('checkpermis:trash-role');
            Route::post('/restore/{id}', [RoleController::class, 'restore'])->name('role.restore');
            Route::post('/destroy/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
        });
        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'adminIndex'])->name('user.index')->middleware('checkpermis:view-user');
            Route::get('/profile/{id}', [UserController::class, 'adminViewsAddRole'])->name('user.dashboard.views')->middleware('checkpermis:profile-user');
            Route::post('/createrole/{id}', [UserController::class, 'adminCreateRole'])->name('user.dashboard.create')->middleware('checkpermis:create-role');
        });

        Route::prefix('product')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('product.index')->middleware('checkpermis:view-product');
            Route::get('/create', [ProductController::class, 'create'])->name('product.create')->middleware('checkpermis:create-product');
            Route::post('/create', [ProductController::class, 'store'])->name('product.store');
            Route::get('/detail/{id}', [ProductController::class, 'detail'])->name('product.detail');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit')->middleware('checkpermis:edit-product');
            Route::post('/approved', [ProductController::class, 'approved'])->name('product.approved');
            Route::post('/update/{id}', [ProductController::class, 'update'])->name('product.update');
            Route::post('/delete/{id}', [ProductController::class, 'delete'])->name('product.delete')->middleware('checkpermis:delete-product');
        });
    });
});
