<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivoController;
use App\Http\Controllers\ActivoAsignacionController;
use App\Http\Controllers\ActivoDevolucionController;
use App\Http\Controllers\ActivoBajaController;
use App\Http\Controllers\DepreController;
use App\Http\Controllers\RolVistaController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\AmbienteController;
use App\Http\Controllers\ActivoGrupoController;
use App\Http\Controllers\ActivoMotivosController;
use App\Http\Controllers\ActivoAuxiliarController;

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
    // Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::post('activodestroy', [ActivoController::class, 'desabilitar'])->name('activodestroy');
    Route::resource('Activo', ActivoController::class);
    Route::get('/Activos', [ActivoController::class, 'index'])->name('activo.lista');  
    Route::get('/getall', [ActivoController::class, 'getall'])->name('getall');   
    Route::get('/ActivoReporte', [ActivoController::class, 'reporte'])->name('ActivoReporte'); 
     
    Route::resource('ActivoBaja', ActivoBajaController::class);
    Route::get('/ActivosBaja', [ActivoBajaController::class, 'index'])->name('activo.baja');  
    Route::post('activodestroy', [ActivoBajaController::class, 'desabilitar'])->name('activodestroy');

    Route::resource('ActivoAsig', ActivoAsignacionController::class); 
    Route::get('/ActivosAsig', [ActivoAsignacionController::class, 'index'])->name('activo.asig');  
    Route::get('/ActivoAsigReporte', [ActivoAsignacionController::class, 'reporte'])->name('ActivoAsigReporte'); 

    Route::resource('ActivoDev', ActivoDevolucionController::class); 
    Route::get('/ActivosDev', [ActivoDevolucionController::class, 'index'])->name('activo.dev'); 

    Route::resource('Empresa', EmpresaController::class); 
    Route::get('/EmpresaDatos', [EmpresaController::class, 'index'])->name('empresa.datos'); 
    
    Route::resource('Roles', RolController::class); 
    Route::get('/RolesDatos', [RolController::class, 'index'])->name('rol.datos'); 
    Route::post('Rolesdestroy', [RolController::class, 'desabilitar'])->name('Rolesdestroy');
    
    Route::resource('Ambiente', AmbienteController::class); 
    Route::get('/AmbienteDatos', [AmbienteController::class, 'index'])->name('ambiente.datos'); 
    Route::post('Ambientedestroy', [AmbienteController::class, 'desabilitar'])->name('Ambientedestroy');

    Route::resource('Grupo', ActivoGrupoController::class); 
    Route::get('/GrupoDatos', [ActivoGrupoController::class, 'index'])->name('grupo.datos'); 
    Route::post('Grupodestroy', [ActivoGrupoController::class, 'desabilitar'])->name('Grupodestroy');

    Route::resource('Auxiliar', ActivoAuxiliarController::class); 
    Route::get('/AuxDatos', [ActivoAuxiliarController::class, 'index'])->name('aux.datos'); 
    Route::post('Auxdestroy', [ActivoAuxiliarController::class, 'desabilitar'])->name('Auxdestroy');

    Route::resource('Motivo', ActivoMotivosController::class); 
    Route::get('/MotivoDatos', [ActivoMotivosController::class, 'index'])->name('motivo.datos'); 
    Route::post('Motivodestroy', [ActivoMotivosController::class, 'desabilitar'])->name('Motivodestroy');


    Route::resource('Depre', DepreController::class); 
    Route::get('/ActivosDepre', [DepreController::class, 'index'])->name('activo.depre'); 
    Route::post('deprecion', [DepreController::class, 'depre']);  
    Route::post('/trunn', [DepreController::class, 'trunn'])->name('trunn'); 
    Route::post('/getdepre', [DepreController::class, 'getdepre'])->name('getdepre'); 
});

require __DIR__.'/auth.php';
