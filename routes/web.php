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


// Route::get('/', function () {
//     return view('welcome');
// });



Route::group(['as' => 'frontend.'], function () {
    // Route::get('/', [HomeController::class, 'index']);
    Route::get('/',[App\Http\Controllers\frontend\InicioController::class, 'index']);
    Route::get('/categoria/{name}',[App\Http\Controllers\frontend\CategoriaController::class, 'index']);
    Route::get('/rubro/{name}',[App\Http\Controllers\frontend\CategoriaController::class, 'rubro']);
    Route::get('/producto/{name}',[App\Http\Controllers\frontend\ProductoController::class, 'index']);
    Route::get('/contactenos',[App\Http\Controllers\frontend\ContactoController::class, 'contacto']);
    Route::get('/acerca-de-nosotros',[App\Http\Controllers\frontend\InicioController::class, 'somos']);

});
Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => ['guest']], function () {
        Route::get('/', 'Auth\LoginController@showLoginForm');
        Route::get('/login', 'Auth\LoginController@showLoginForm');
        Route::post('/login', 'Auth\LoginController@login')->name('login');
    });

    Route::middleware(['auth'])->group(function () {

        Route::post('/logout', 'Auth\LoginController@logout')->name('logout');


        Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

        Route::get('administrador', "UserController@index")->name('administrator.index');
        Route::get('/administrador/load', 'UserController@load')->name('administrator.load');
        Route::post('administrador/register', "UserController@store")->name('administrator.register');
        Route::get('administrador/create', "UserController@create")->name('administrator.create');
        Route::get('administrador/edit/{user}', "UserController@edit")->name('administrator.edit');
        Route::post('administrador/update/{user}', 'UserController@update')->name('administrator.update');
        Route::post('administrador/delete', "UserController@delete")->name('administrator.delete');
        Route::post('administrador/desactive', "UserController@desactive")->name('administrator.desactive');
        Route::post('administrador/active', "UserController@active")->name('administrator.active');

        Route::get('/roles', 'RoleController@index')->name('role.index');
        Route::get('/roles/load', 'RoleController@load')->name('role.load');
        Route::get('roles/create', 'RoleController@create')->name('role.create');
        Route::post('roles/store', "RoleController@store")->name('role.store');
        Route::get('roles/edit/{role}', "RoleController@edit")->name('role.edit');
        Route::post('roles/update/{role}', 'RoleController@update')->name('role.update');
        Route::post('roles/destroy/{role}', "RoleController@destroy")->name('role.destroy');
        Route::post('roles/desactive', "RoleController@desactive")->name('role.desactive');
        Route::post('roles/active', "RoleController@active")->name('role.active');
        Route::get('roles/{id}/access/', "AccessController@index")->name('access.index');
        Route::get('{role}/access', 'AccessController@getAccess');
        Route::get('/access/{role}', 'AccessController@getAccess')->name('access.load');
        Route::post('access/register', 'AccessController@store');
        /***************************Banner*********************************/
        Route::get('/banners', 'BannersController@index')->name('banner.index');
        Route::get('/banners/load', 'BannersController@load')->name('banner.load');
        Route::get('banners/create', 'BannersController@create')->name('banner.create');
        Route::post('banners/store', "BannersController@store")->name('banner.store');
        Route::get('banners/show/{banner}', "BannersController@show")->name('banner.show');
        Route::get('banners/edit/{banner}', "BannersController@edit")->name('banner.edit');
        Route::post('banners/update/{banner}', 'BannersController@update')->name('banner.update');
        Route::post('banners/destroy/{banner}', "BannersController@destroy")->name('banner.destroy');
        Route::post('banners/desactive', "BannersController@desactive")->name('banner.desactive');
        Route::post('banners/active', "BannersController@active")->name('banner.active');
        Route::post('banners/update-order', "BannersController@updateOrder")->name('banner.update-order');
        /***************************Categorias*********************************/
        Route::get('/categories', 'CategoriesController@index')->name('categories.index');

        Route::get('/categories/load/{parent_id?}', 'CategoriesController@load')->name('categories.load');
        Route::get('categories/create/{parent_id?}', 'CategoriesController@create')->name('categories.create');
        Route::post('categories/store', "CategoriesController@store")->name('categories.store');
        Route::get('categories/show/{category}', "CategoriesController@show")->name('categories.show');
        Route::get('categories/edit/{category}', "CategoriesController@edit")->name('categories.edit');
        Route::post('categories/update/{category}', 'CategoriesController@update')->name('categories.update');
        Route::post('categories/destroy/{category}', "CategoriesController@destroy")->name('categories.destroy');
        Route::post('categories/desactive', "CategoriesController@desactive")->name('categories.desactive');
        Route::post('categories/active', "CategoriesController@active")->name('categories.active');
        Route::post('categories/update-order', "CategoriesController@updateOrder")->name('categories.update-order');
        Route::get('/categories/{category}', 'CategoriesController@index')->name('subcategories.index');
        Route::get('/sub-categories/list', 'CategoriesController@getListSubCategorias')->name('subcategories.list');
        Route::get('/categories-list', 'CategoriesController@getListCategory')->name('categories.list-category');

        /******************************productos******************* */
          Route::get('productos', "ProductoController@index")->name('producto.index');
          Route::get('productos/load', 'ProductoController@load')->name('producto.load');
          Route::get('productos/create', "ProductoController@create")->name('producto.create');
          Route::post('productos/store', "ProductoController@store")->name('producto.store');
          Route::get('productos/edit/{product}', "ProductoController@edit")->name('producto.edit');
          Route::post('productos/update/{product}', 'ProductoController@update')->name('producto.update');
          Route::post('productos/delete/{producto}', "ProductoController@destroy")->name('producto.delete');
          Route::post('productos/desactive', "ProductoController@desactive")->name('producto.desactive');
          Route::post('productos/active', "ProductoController@active")->name('producto.active');
          Route::post('productos/desactive-popular', "ProductoController@desactivePopular")->name('producto.desactive-popular');
          Route::post('productos/active-popular', "ProductoController@activePopular")->name('producto.active-popular');
          Route::post('productos/desactive-visto', "ProductoController@desactiveVisto")->name('producto.desactive-visto');
          Route::post('productos/active-visto', "ProductoController@activeVisto")->name('producto.active-visto');
          Route::get('productos/gallery/load/{product}', 'ProductoController@loadGallery')->name('products.gallery.load');
          Route::post('productos/gallery/update-order', "ProductoController@updateOrderImageGallery")->name('products.gallery.update-order');
          Route::post('productos/gallery/destroy/{product}/{product_image}', "ProductoController@destroyImageGallery")->name('products.gallery.destroy');
          Route::get('productos/show-ficha_tecnia/{producto}', "ProductoController@showFile")->name('products.showFile');


         /******************************productos color******************* */
         Route::get('producto/{product}/color', "ProductoColorImagenController@index")->name('producto.color.index');
         Route::get('producto/{product}/color/load', "ProductoColorImagenController@load")->name('producto.color.load');
         Route::get('producto/{product}/color/create', "ProductoColorImagenController@create")->name('producto.color.create');
         Route::post('producto/color/store', "ProductoColorImagenController@store")->name('producto.color.store');
         Route::post('producto/color/active', "ProductoColorImagenController@active")->name('producto.color-image.active');
         Route::post('producto/color/desactive', "ProductoColorImagenController@desactive")->name('producto.color-image.desactive');
         Route::post('producto/color/destroy/{producto_color_image}', "ProductoColorImagenController@destroy")->name('producto.color-image.destroy');


        /******************************productos complementarios******************* */
        Route::get('products/{product}/complementary', "ProductoComplementarioController@index")->name('products.complemetario.index');
        Route::get('products/{product}/complementary/load', "ProductoComplementarioController@load")->name('products.complemetario.load');
        Route::get('products/{product}/complementary/create', "ProductoComplementarioController@create")->name('products.complemetario.create');
        Route::get('products/{product}/complementary/list-load', "ProductoComplementarioController@listProductLoad")->name('products.complemetario.list-load');
        Route::post('products/complementary/store', "ProductoComplementarioController@store")->name('products.complemetario.store');
        Route::post('products/complementary/active', "ProductoComplementarioController@active")->name('products.complemetario.active');
        Route::post('products/complementary/desactive', "ProductoComplementarioController@desactive")->name('products.complemetario.desactive');
        Route::delete('products/complementary/destroy/{producto_relacionada}', "ProductoComplementarioController@destroy")->name('products.complemetario.destroy');

        /******************************productos relacionadas******************* */
        Route::get('products/{product}/relacionada', "ProductoRelacionadaController@index")->name('products.relacionada.index');
        Route::get('products/{product}/relacionada/load', "ProductoRelacionadaController@load")->name('products.relacionada.load');
        Route::get('products/{product}/relacionada/create', "ProductoRelacionadaController@create")->name('products.relacionada.create');
        Route::get('products/{product}/relacionada/list-load', "ProductoRelacionadaController@listProductLoad")->name('products.relacionada.list-load');
        Route::post('products/relacionada/store', "ProductoRelacionadaController@store")->name('products.relacionada.store');
        Route::post('products/relacionada/active', "ProductoRelacionadaController@active")->name('products.relacionada.active');
        Route::post('products/relacionada/desactive', "ProductoRelacionadaController@desactive")->name('products.relacionada.desactive');
        Route::delete('products/relacionada/destroy/{producto_relacionada}', "ProductoRelacionadaController@destroy")->name('products.relacionada.destroy');


        Route::get('categories/{category}/banners', "BannerCategoryController@index")->name('category.banner.index');
        Route::get('categories/{category}/banners/load', 'BannerCategoryController@load')->name('category.banner.load');
        Route::get('categories/{category}/banners/create', 'BannerCategoryController@create')->name('category.banner.create');
        Route::post('categories/{category}/banners', 'BannerCategoryController@store')->name('category.banner.store');

        Route::get('categories/{category}/banners/show/{banner}', "BannerCategoryController@show")->name('category.banner.show');
        Route::get('categories/{category}/banners/edit/{banner}', "BannerCategoryController@edit")->name('category.banner.edit');
        Route::post('categories/{category}/banners/update/{banner}', 'BannerCategoryController@update')->name('category.banner.update');
        Route::post('categories/{category}/banners/destroy/{banner}', "BannerCategoryController@destroy")->name('category.banner.destroy');
        Route::post('categories/banners/desactive', "BannerCategoryController@desactive")->name('category.banner.desactive');
        Route::post('categories/banners/active', "BannerCategoryController@active")->name('category.banner.active');
        Route::post('categories/banners/update-order', "BannerCategoryController@updateOrder")->name('category.banner.update-order');

    });
});


Route::get('/clear-cache', function () {
    echo Artisan::call('config:clear');
    echo Artisan::call('config:cache');
    echo Artisan::call('cache:clear');
    echo Artisan::call('route:clear');
 });
