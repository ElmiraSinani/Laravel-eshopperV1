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

//show all products
//Route::get('products', ["uses"=>"ProductsController@index", "as"=> "allProducts"]);
Route::get('/', ["uses"=>"ProductsController@index", "as"=> "allProducts"]);

Route::get('product/addToCart/{id}', ["uses"=>"ProductsController@addProductToCart", "as"=> "AddToCartProduct"]);

//show cart items
Route::get('cart', ["uses"=>"ProductsController@showCart", "as"=> "cartProducts"]);

//Delete Item From The cart
Route::get('product/deleteItemFromCart/{id}', ["uses"=>"ProductsController@deleteItemFromCart", "as"=> "DeleteItemFromCart"]);

//increase single product on cart
Route::get('product/increaseSingleProduct/{id}', ["uses"=>"ProductsController@increaseSingleProduct", "as"=> "IncreaseSingleProduct"]);

//decrease single product on cart
Route::get('product/decreaseSingleProduct/{id}', ["uses"=>"ProductsController@decreaseSingleProduct", "as"=> "DecreaseSingleProduct"]);

//sessions flush for cart, development mode only
Route::get('flushCartSession', ["uses"=>"ProductsController@flushCartSession"]);


/** Order Routes */
//checkout page
Route::get('product/checkoutProducts/', ["uses"=>"ProductsController@checkoutProducts", "as"=> "CheckoutProducts"]);

//Create an order
Route::get('product/createOrder/', ["uses"=>"ProductsController@createOrder", "as"=> "CreateOrder"]);

//process checkout page
Route::get('product/createNewOrder/', ["uses"=>"ProductsController@createNewOrder", "as"=> "CreateNewOrder"]);

//payment page
Route::get('payment/paymentpage', ["uses"=>"Payment\PaymentsController@showPaymentPage", "as"=> "ShowPaymentPage"]);
Route::get('paymentreceipt/{paymentID}/{payerID}', ["uses"=>"Payment\PaymentsController@showPaymentReceipt", "as"=> "ShowPaymentReceipt"]);



/**  User Authentication Route */
Auth::routes();

//dashboard after login
Route::get('/home', 'HomeController@index')->name('home');

//Admin Panel
Route::get('admin/products', ["uses"=>"Admin\AdminProductsController@index", "as"=> "adminDisplayProducts"])->middleware('restrictToAdmin');

/** Product */
//display edit product form
Route::get('admin/editProductForm/{id}', ["uses"=>"Admin\AdminProductsController@editProductForm", "as"=> "adminEditProductForm"]);
//update product data
Route::post('admin/updateProduct/{id}', ["uses"=>"Admin\AdminProductsController@updateProduct", "as"=> "adminUpdateProduct"]);
//delete product
Route::get('admin/deleteProduct/{id}', ["uses"=>"Admin\AdminProductsController@deleteProduct", "as"=> "adminDeleteProduct"]);
//display create product form
Route::get('admin/createProductForm', ["uses"=>"Admin\AdminProductsController@createProductForm", "as"=> "adminCreateProductForm"]);
//send new product data to database
Route::post('admin/sendCreateProductForm', ["uses"=>"Admin\AdminProductsController@sendCreateProductForm", "as"=> "adminSendCreateProductForm"]);
//Delete product
Route::get('admin/deleteProduct/{id}', ["uses"=>"Admin\AdminProductsController@deleteProduct", "as"=> "adminDeleteProduct"]);


/** Product image */
//display edit product image form
Route::get('admin/editProductImageForm/{id}', ["uses"=>"Admin\AdminProductsController@editProductImageForm", "as"=> "adminEditProductImageForm"]);
//update product image
Route::post('admin/updateProductImage/{id}', ["uses"=>"Admin\AdminProductsController@updateProductImage", "as"=> "adminUpdateProductImage"]);



    
    
