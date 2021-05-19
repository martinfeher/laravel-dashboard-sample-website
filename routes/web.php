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

Route::get('/', function(){
    if (Auth::guest()) {
        return redirect('/login');
    } else {
        return redirect('/products');
    }
});

Auth::routes();

Route::group(['middleware' => ['auth']], function() {

    //  Products
    Route::get('/products', '\App\Http\Controllers\ProductsController@index'); // products page
    Route::get('/products/table-data', '\App\Http\Controllers\ProductsController@tableData'); // products page, table data, Ajax call
    Route::get('/products/add-entry', '\App\Http\Controllers\ProductsController@createData'); // products page, create entry, Ajax call
    Route::get('/products/data-to-update-entry', '\App\Http\Controllers\ProductsController@dataToUpdateEntry'); // products page, add data to update entry, Ajax call
    Route::get('/products/edit-entry', '\App\Http\Controllers\ProductsController@editEntry'); // products page, edit entry, Ajax call
    Route::get('/products/create-order', '\App\Http\Controllers\ProductsController@createOrder'); // products page, create order, Ajax call
    Route::get('/products/delete-data', '\App\Http\Controllers\ProductsController@deleteData'); // products page, delete data, Ajax call
    //  End Products

    //  Orders
    Route::get('/orders', '\App\Http\Controllers\OrdersController@index'); // orders page
    Route::get('/orders/table-data', '\App\Http\Controllers\OrdersController@tableData'); // orders page, table data, Ajax call
    Route::post('/orders/add-entry', '\App\Http\Controllers\OrdersController@createEntry'); // orders page, craete entry, Ajax call
    Route::get('/orders/data-to-update-entry', '\App\Http\Controllers\OrdersController@dataToUpdateEntry'); // orders page, data to update entry, Ajax call
    Route::post('/orders/edit-entry', '\App\Http\Controllers\OrdersController@editEntry'); // orders page, edit Entry, Ajax call
    Route::get('/orders/delete-data', '\App\Http\Controllers\OrdersController@deleteData'); // orders page, delete Data, Ajax call
    //  End Orders

    //  Users
    Route::group(['middleware' => ['can:adminZona']], function() {
        // Administrator only can access the data
        Route::get('/users', '\App\Http\Controllers\UsersController@index'); // user page
        Route::get('/users/table-data', '\App\Http\Controllers\UsersController@tableData'); // users page, table data, Ajax call
        Route::get('/users/delete-data', '\App\Http\Controllers\UsersController@deleteData'); // users page, delete entry, Ajax call
    });
    //  End Users

    Route::get('/odhlasit', '\App\Http\Controllers\Auth\LoginController@logout'); // Logout link

});
