<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/',[App\Http\Controllers\frontEnd\InicioController::class, 'index']);
Route::get('/categoria/{name}',[App\Http\Controllers\frontEnd\CategoriaController::class, 'index']);
Route::get('/rubro/{name}',[App\Http\Controllers\frontEnd\CategoriaController::class, 'rubro']);
Route::get('/producto/{name}',[App\Http\Controllers\frontEnd\ProductoController::class, 'index']);
Route::get('/contactenos',[App\Http\Controllers\frontEnd\ContactoController::class, 'contacto']);
Route::get('/acerca-de-nosotros',[App\Http\Controllers\frontEnd\InicioController::class, 'somos']);

Route::get('/cache-clear', function() {
    Artisan::call('cache:clear');
    dd("cache clear All");
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {
    
    Route::get('/admin', function(){
        return redirect('/admin/inicio');
    });

    // ******** Esto son las rutas para el Administrador (CMS) *************
    Route::get('/admin/inicio', [App\Http\Controllers\InicioController::class, 'index']);

    // Modulo Datos
    Route::get('/admin/datos', [App\Http\Controllers\UsuariosController::class, 'datos']);
    Route::post('/admin/datos', [App\Http\Controllers\UsuariosController::class, 'update']);
    // Modulo Usuario
    Route::get('/admin/usuarios', [App\Http\Controllers\UsuariosController::class, 'index']);
    Route::get('/admin/usuarios/crear', [App\Http\Controllers\UsuariosController::class, 'create']);
    Route::post('/admin/usuarios/crear', [App\Http\Controllers\UsuariosController::class, 'store']);
    Route::post('/admin/usuarios/papelera', [App\Http\Controllers\UsuariosController::class, 'papelera']);

    // Modulo Categoria
    Route::get('/admin/categorias', [App\Http\Controllers\CategoriaController::class, 'index']);
    Route::get('/admin/categorias/crear', [App\Http\Controllers\CategoriaController::class, 'create']);
    Route::post('/admin/categorias/crear', [App\Http\Controllers\CategoriaController::class, 'store']);
    Route::get('/admin/categorias/editar/{id}', [App\Http\Controllers\CategoriaController::class, 'edit']);
    Route::post('/admin/categorias/editar', [App\Http\Controllers\CategoriaController::class, 'update']);
    Route::post('/admin/categorias/papelera', [App\Http\Controllers\CategoriaController::class, 'papelera']);


    // Modulo Producto
    Route::get('/admin/productos', [App\Http\Controllers\ProductoController::class, 'index']);
    Route::get('/admin/productos/crear', [App\Http\Controllers\ProductoController::class, 'create']);
    Route::post('/admin/productos/crear', [App\Http\Controllers\ProductoController::class, 'store']);
    Route::get('/admin/productos/editar/{id}', [App\Http\Controllers\ProductoController::class, 'edit']);
    Route::post('/admin/productos/editar', [App\Http\Controllers\ProductoController::class, 'update']);
    Route::post('/admin/productos/papelera', [App\Http\Controllers\ProductoController::class, 'papelera']);
    Route::post('/admin/productos/publicar', [App\Http\Controllers\ProductoController::class, 'publicar']);
    
    // Modulo Productos Complementarios
    Route::get('/admin/productos/complementarios/{id}', [App\Http\Controllers\ProductoRelacionadoController::class, 'index']);
    Route::get('/admin/productos/complementarios/relacionar/{id}', [App\Http\Controllers\ProductoRelacionadoController::class, 'create']);
    Route::post('/admin/productos/complementarios/relacionar', [App\Http\Controllers\ProductoRelacionadoController::class, 'update']);


    // Mod. Galeria de Productos
    Route::get('/admin/productos/galerias/{id}', [App\Http\Controllers\GaleriaProductoController::class, 'create']);
    Route::post('/admin/productos/galerias/crear', [App\Http\Controllers\GaleriaProductoController::class, 'store']);
    Route::post('/admin/productos/galerias/papelera', [App\Http\Controllers\GaleriaProductoController::class, 'papelera']);
    Route::post('/admin/productos/galerias/default', [App\Http\Controllers\GaleriaProductoController::class, 'default']);

    // Modulo Tipos
    Route::get('/admin/tipos', [App\Http\Controllers\TipoController::class, 'index']);
    Route::get('/admin/tipos/crear', [App\Http\Controllers\TipoController::class, 'create']);
    Route::post('/admin/tipos/crear', [App\Http\Controllers\TipoController::class, 'store']);
    Route::get('/admin/tipos/editar/{id}', [App\Http\Controllers\TipoController::class, 'edit']);
    Route::post('/admin/tipos/editar', [App\Http\Controllers\TipoController::class, 'update']);
    Route::post('/admin/tipos/papelera', [App\Http\Controllers\TipoController::class, 'papelera']);

});


Route::get('/cache-clear', function() {
    Artisan::call('cache:clear');
    dd("cache clear All");
});

