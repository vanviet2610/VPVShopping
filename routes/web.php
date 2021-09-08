<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginRegisterController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SliderController;
use App\Models\Permission;
use Illuminate\Support\Facades\Route;


Route::get('/login', [LoginRegisterController::class, 'index'])->name('login');
Route::get('/register', [LoginRegisterController::class, 'create'])->name('register');
Route::post('/store', [LoginRegisterController::class, 'store'])->name('auth.regis');
Route::post('/account', [LoginRegisterController::class, 'account'])->name('auth.account');
Route::get('/logout', [LoginRegisterController::class, 'logOut'])->name('auth.logout');

Route::prefix('admin')->group(function () {
    Route::prefix('menu')->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('menu.index');
        Route::get('/create', [MenuController::class, 'create'])->name('menu.create');
        Route::post('/store', [MenuController::class, 'store'])->name('menu.store');
        Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('menu.edit');
        Route::post('/update/{id}', [MenuController::class, 'update'])->name('menu.update');
        Route::get('/delete/{id}', [MenuController::class, 'delete'])->name('menu.delete');
        Route::get('/trash', [MenuController::class, 'trash'])->name('menu.trash');
        Route::get('/restore/{id}', [MenuController::class, 'restore'])->name('menu.restore');
        Route::get('/forever/{id}', [MenuController::class, 'forever'])->name('menu.forever');
    });
    Route::prefix('slider')->group(function () {
        Route::get('/', [SliderController::class, 'index'])->name('slider.index');
        Route::get('/create', [SliderController::class, 'create'])->name('slider.create');
        Route::post('/store', [SliderController::class, 'store'])->name('slider.store');
        Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
        Route::post('/update/{id}', [SliderController::class, 'update'])->name('slider.update');
        Route::get('/trash', [SliderController::class, 'trash'])->name('slider.trash');
        Route::get('/delete/{id}', [SliderController::class, 'delete'])->name('slider.delete');
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
    Route::prefix('permission')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('permission.index');
        Route::get('/create', [PermissionController::class, 'create'])->name('permission.create');
        Route::post('/create', [PermissionController::class, 'store'])->name('permission.store');
        Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit');
        Route::post('/edit/{id}', [PermissionController::class, 'update'])->name('permission.update');
        Route::delete('/delete/{id}', [PermissionController::class, 'delete'])->name('permission.delete');
        Route::get('/trash', [PermissionController::class, 'trash'])->name('permission.trash');
        Route::post('/trash/{id}', [PermissionController::class, 'restore'])->name('permission.restore');
        Route::post('/destroy/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy');
    });
    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('role.index');
        Route::get('/create', [RoleController::class, 'create'])->name('role.create');
    });
});
