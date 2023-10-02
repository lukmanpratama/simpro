<?php

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

Route::get( uri: '/', action: \App\Livewire\Auth\Login::class)->name( name: 'login')->middleware('guest');
Route::get( uri: '/registrasi', action: \App\Livewire\Auth\Registrasi::class)->name( name: 'registrasi')->middleware('guest');
Route::post( uri: '/logout', action: \App\Http\Controllers\LogoutController::class)->name( name: 'logout');

Route::group(['middleware' => ['auth', 'cekrole:admin']], function(){
    Route::get('/admin', \App\Livewire\Admin\Home::class)->name('admin.home');
    Route::get('/admin/proyek', \App\Livewire\Admin\Proyek::class)->name('admin.proyek');
});
Route::group(['middleware' => ['auth', 'cekrole:manager']], function(){
    Route::get('/manager', \App\Livewire\Manager\Home::class)->name('manager.home');
    Route::get('/manager/proyek', \App\Livewire\Manager\Proyek::class)->name('manager.proyek');
});
Route::group(['middleware' => ['auth', 'cekrole:team']], function(){
    Route::get('/team', \App\Livewire\Team\Home::class)->name('team.home');
    Route::get('/team/proyek', \App\Livewire\Team\Proyek::class)->name('team.proyek');
});
Route::group(['middleware' => ['auth', 'cekrole:owner']], function(){
    Route::get('/owner', \App\Livewire\Owner\Home::class)->name('owner.home');
    Route::get('/owner/proyek', \App\Livewire\Owner\Proyek::class)->name('owner.proyek');
});

