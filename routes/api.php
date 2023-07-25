<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => ['guest']], function(){
    Route::prefix('v1')->group( function() {
        Route::get('home', 'Api\V1\HomeController@index')->name('api.home');

        Route::post('subscription', 'Api\V1\HomeController@subscriptionStore')->name('api.subscription');

        Route::get('list-products/{categoria_slug}', 'Api\V1\GaleryProductController@productByCategories')->name('api.product_categories');
        Route::get('list-products-rubros/{rubro_slug}', 'Api\V1\GaleryProductController@productByRubro')->name('api.product_rubro');
        Route::get('producto/{slug}', 'Api\V1\ProductoController@index')->name('api.product');


        Route::get('search-product', 'Api\V1\ProductoController@searchProduct')->name('api.searchProductos');

        Route::post('catalogo', 'Api\V1\ProductoController@catalogo')->name('api.catalogo');

        Route::get('get-filters', 'Api\V1\HomeController@getFiltros')->name('api.get-filters');

        Route::get('financiamiento-data', 'Api\V1\HomeController@finaciamientoData')->name('api.financiamiento-data');

        Route::get('quiero-la-moto-data', 'Api\V1\HomeController@quieroLaMotoData')->name('api.quiero-la-moto-data');

        Route::post('store-finaciamiento', 'Api\V1\HomeController@storeFinanciamiento')->name('api.store-finaciamiento');
        Route::post('store-quiero-la-moto', 'Api\V1\HomeController@quieroLaMoto')->name('api.store-quiero-la-moto');

        Route::get('get-provincias', 'Api\V1\HomeController@getProvincia')->name('api.get-provincias');
        Route::get('get-distritos', 'Api\V1\HomeController@getDistrito')->name('api.get-distritos');
        Route::get('get-motos', 'Api\V1\HomeController@productosByMarca')->name('api.get-motos');
        Route::get('get-colores-by-moto', 'Api\V1\HomeController@productoColores')->name('api.get-colores-by-moto');

        Route::get('search-marca', 'Api\V1\HomeController@getMarcasFiltroSearch')->name('api.searchMarca');
        Route::get('search-tipo-moto', 'Api\V1\HomeController@getTipoMotosSearch')->name('api.searchTipoMoto');


        Route::post('producto-like', 'Api\V1\ProductoController@productoLike')->name('api.producto-like');

        Route::get('pre-suscripcion-data', 'Api\V1\HomeController@preSuscripcionData')->name('api.pre-suscripcion-data');
        Route::post('store-pre-suscripcion', 'Api\V1\HomeController@preSuscricion')->name('api.store-pre-suscripcion');

    });
});
