<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivoController;
use App\Http\Controllers\ActivoAsignacionController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  
    if(Auth::check()){ 
        return redirect('dashboard') ;
    }else{
        return Inertia::render('Auth/Login');
    }
});

 
Route::middleware('auth')->group(function () {
    Route::get('/Users', [UserController::class, 'ruta'])->name('empresa.personal'); 
    Route::resource('User', UserController::class);
    Route::post('userdestroy', [UserController::class, 'desabilitar'])->name('userdestroy');
    Route::get('/dashboard', [MenuController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/Activos', [ActivoController::class, 'ruta'])->name('activo.lista'); 
    Route::post('activodestroy', [ActivoController::class, 'desabilitar'])->name('activodestroy');
    Route::resource('Activo', ActivoController::class);

    Route::resource('ActivoAsig', ActivoAsignacionController::class);
});

require __DIR__.'/auth.php';
