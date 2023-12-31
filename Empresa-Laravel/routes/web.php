<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use Illuminate\Routing\RouteGroup;

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


//Redirigir pagina de inicio a login en lugar de welcome
Route::get('/', function () {
    return view('auth.login');
});

//Ruta resource para todos los metodos (GET, POST, PUT, DELETE)

Route::resource('empleado', EmpleadoController::class)->middleware('auth');

//Quitar registro y reser del pass en el login
Auth::routes(['register'=>false,'reset'=>false]);


//Ruta de home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

