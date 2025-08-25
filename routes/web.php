<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BannerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('index');
})-> name('index');


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('role-index',[RoleController::class,'index'])->name('role.index');
Route::get('role-create',[RoleController::class,'create'])->name('role.create');
Route::post('role-store',[RoleController::class,'store'])->name('role.store');
Route::get('role-edit/{id}',[RoleController::class,'edit'])->name('role.edit');
Route::put('role-update/{id}',[RoleController::class,'update'])->name('role.update');
Route::delete('role-delete/{id}',[RoleController::class,'destroy'])->name('role.delete');

Route::get('menu-index',[MenuController::class,'index'])->name('menu.index');
Route::get('menu-create',[MenuController::class,'create'])->name('menu.create');
Route::post('menu-store',[MenuController::class,'store'])->name('menu.store');
Route::get('menu-edit/{id}',[MenuController::class,'edit'])->name('menu.edit');
Route::put('menu-update/{id}',[MenuController::class,'update'])->name('menu.update');
Route::delete('menu-delete/{id}',[MenuController::class,'destroy'])->name('menu.delete');

Route::get('site-setting-index', [SiteSettingController::class, 'index'])->name('site_setting.index');
Route::get('site-setting-create', [SiteSettingController::class, 'create'])->name('site_setting.create');
Route::post('site-setting-store', [SiteSettingController::class, 'store'])->name('site_setting.store');
Route::get('site-setting-edit/{id}', [SiteSettingController::class, 'edit'])->name('site_setting.edit');
Route::put('site-setting-update/{id}', [SiteSettingController::class, 'update'])->name('site_setting.update');
Route::delete('site-setting-delete/{id}', [SiteSettingController::class, 'destroy'])->name('site_setting.delete');

Route::get('post-index',[PostController::class,'index'])->name('post.index');
Route::get('post-create',[PostController::class,'create'])->name('post.create');
Route::post('post-store',[PostController::class,'store'])->name('post.store');
Route::get('post-edit/{id}',[PostController::class,'edit'])->name('post.edit');
Route::put('post-update/{id}',[PostController::class,'update'])->name('post.update');
Route::delete('post-delete/{id}',[PostController::class,'destroy'])->name('post.delete');

Route::get('banner-index', [BannerController::class, 'index'])->name('banner.index');
Route::get('banner-create', [BannerController::class, 'create'])->name('banner.create');
Route::post('banner-store', [BannerController::class, 'store'])->name('banner.store');
Route::get('banner-edit/{id}', [BannerController::class, 'edit'])->name('banner.edit');
Route::put('banner-update/{id}', [BannerController::class, 'update'])->name('banner.update');
Route::delete('banner-delete/{id}', [BannerController::class, 'delete'])->name('banner.delete');
