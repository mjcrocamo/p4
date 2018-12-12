<?php

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

# INDEX
Route::get('/', 'IceCreamController@index');

# SHOW ALL Flavors / Toppings (form to choose/ add to basket)
Route::get('/show', 'IceCreamController@show');

# VIEW Cart and add new item to cart
Route::get('/cart', 'IceCreamController@showCart');
Route::post('/cart', 'IceCreamController@addCart');

# DELETE item from cart
Route::delete('/cart/{item_id}/delete', 'IceCreamController@delete');

# Edit item in cart
Route::put('/cart/{item_id}/update', 'IceCreamController@update');
Route::get('/edit/{item_id}','IceCreamController@edit');

# Place Order page and route to place the order
Route::get('/viewOrder/{basket_id}', 'IceCreamController@viewOrder');
Route::post('/placeOrder/{basket_id}', 'IceCreamController@placeOrder');