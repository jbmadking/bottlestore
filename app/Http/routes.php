<?php
/**
 * Static Pages Routes
 */
Route::get('/about', 'PagesController@about');
Route::get('/contact', 'PagesController@contact');
Route::get('/', 'PagesController@home');
Route::get('/home', 'PagesController@home');

Route::get(
    '/product/details/{product}', ['as' => 'product_details', 'uses' => 'PagesController@product']
);

Route::get(
    'category/{category}', ['as' => 'category', 'uses' => 'PagesController@category']
);

// Shoppping Cart
Route::get(
    'cart/index', ['as' => 'cart.index', 'uses' => 'CartController@index']
);
Route::get(
    'cart/add', ['as' => 'cart.add', 'uses' => 'CartController@store']
);
Route::get(
    'cart/destroy', ['as' => 'cart.destroy', 'uses' => 'CartController@destroy']
);

//Check Out
Route::get(
    'checkout/index', ['as' => 'checkout.index', 'uses' => 'CheckoutController@index']
);
Route::get(
    'checkout/register', ['as' => 'checkout.register', 'uses' => 'CheckoutController@register']
);
Route::post(
    'checkout/register', ['as' => 'checkout.register', 'uses' => 'CheckoutController@createUser']
);
Route::get(
    'checkout/login', ['as' => 'checkout.login', 'uses' => 'CheckoutController@login']
);
Route::post(
    'checkout/login', ['as' => 'checkout.authenticate', 'uses' => 'CheckoutController@authenticate']
);

Route::post(
    'checkout/addresses/save', ['as' => 'checkout.addresses.save', 'uses' => 'CheckoutController@saveAddress']
);

Route::get(
    'checkout/addresses', ['as' => 'checkout.addresses', 'uses' => 'CheckoutController@addresses']
);

Route::post(
    'checkout/payment', ['as' => 'checkout.payment', 'uses' => 'CheckoutController@createOrder']
);

Route::get(
    'payment/success', ['as' => 'payment.index', 'uses' => 'PaymentController@success']
);
Route::get(
    'payment/cancelled', ['as' => 'payment.index', 'uses' => 'PaymentController@cancelled']
);
Route::post(
    'payment/notify', ['as' => 'payment.index', 'uses' => 'PaymentController@notify']
);

// Playing with the concept of invoices???
Route::get(
    'checkout/stamp/invoice/{invoice}', ['as' => 'checkout.stamp.invoice', 'uses' => 'CheckoutController@stampInvoice']
);

/**
 * Authentication
 */

//Overrides
Route::get(
    '/register/user', ['as' => 'user.register', 'uses' => 'Auth\AuthController@getRegister']
);
Route::post(
    '/register/user', ['as' => 'user.register', 'uses' => 'Auth\AuthController@postRegister']
);
/**
 * User Routes
 */

//Profile routes
Route::get('/user/dashboard', 'User\DashboardController@index');
Route::get('/user/profile', 'User\ProfileController@index');

//Addresses routes
Route::get('/user/addresses', 'User\AddressesController@index');
Route::get('/user/addresses/add', 'User\AddressesController@create');
Route::post('/user/addresses/save', 'User\AddressesController@store');

//Orders routes
Route::get('/user/orders', 'User\OrdersController@index');
/**
 * Administrator Routes
 */
Route::get('/admin/import/index', ['as' => 'admin.import.index', 'uses' => 'Admin\ImportController@index']);
Route::post('/admin/import/run', ['as' => 'admin.import.run', 'uses' => 'Admin\ImportController@run']);

Route::resource('admin/categories', 'Admin\CategoriesController');
Route::resource('admin/products', 'Admin\ProductsController');
Route::resource('admin/administrators', 'Admin\AdminUsersController');
Route::resource('admin/clients', 'Admin\ClientsController');
Route::controller('admin', 'Admin\UsersController');

/**
 * Auth Routes
 */
Route::controllers(
    ['auth' => 'Auth\AuthController', 'password' => 'Auth\PasswordController']
);