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

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Cookie;

// Route::get('/test_protection', function() {
//     return view('testprotection');
// })->name('testprotection');

// Route::post('/test_protection', function() {
//     $_email = 'test@centrocaffe.ch';
//         $_password = '123123';

//     $email = Request::input('email');
//     $password = Request::input('password');

//     if (($email == $_email) && ($password == $_password)) {
//         Cookie::queue(Cookie::make('temp_login', true, 3600));
//         return redirect('/');
//     } else {
//         echo "Wrong username or password";
//     }
// });

// Route::middleware(['testprotection']) // REMOVE IN PRODUCTION!!!
// ->group(function () {

    Route::middleware(['web'])
        ->namespace('\Front')
        ->group(function () {

            Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

            // START KAFFEMASCHINEN CATEGORY FRONT ROUTES /
            Route::get('get_price_ranges', 'CategoryViewController@getPriceRanges');

            Route::get('/shop', ['as' => 'all.category.view',
                'uses' => 'CategoryViewController@allCategoryView']);
            Route::get('/shop/{slug}', ['as' => 'category.view',
                'uses' => 'CategoryViewController@view']);
            Route::get('/product/{slug}', ['as' => 'product.view',
                'uses' => 'ProductViewController@view']);
            Route::get('/product-search', ['as' => 'search.result',
                'uses' => 'SearchController@result']);

            Route::post('/product/send/email', ['as' => 'product.mail', 'uses' => 'ProductViewController@sendMail']);

            // END KAFFEMASCHINEN CATEGORY FRONT ROUTES //

            //* ***** START KAFFEMASCHINEN CART FRONT ROUTES  *****  */

            Route::post('/add-to-cart', ['as' => 'cart.add-to-cart', 'uses' => 'CartController@addToCart']);

            Route::get('/cart/view', ['as' => 'cart.view', 'uses' => 'CartController@view']);

            Route::post('/cart/update', ['as' => 'cart.update', 'uses' => 'CartController@update']);

            Route::get('/cart/destroy/{id}/{type}', ['as' => 'cart.destroy', 'uses' => 'CartController@destroy']);

            Route::post('/cart/update/delivery', ['as' => 'cart.update.delivery', 'uses' => 'CartController@updateDelivery']);

            Route::post('/order', ['as' => 'order.place', 'uses' => 'OrderController@place']);
            Route::get('/payment_status', ['as' => 'payment.status', 'uses' => 'OrderController@getPaymentStatus']);

            Route::get('/order/login', ['as' => 'order.login', 'uses' => 'OrderController@login']);
            Route::post('/order/login', ['as' => 'order.login.post', 'uses' => 'OrderController@postLogin']);

            Route::get('/order/register', ['as' => 'order.register', 'uses' => 'OrderController@register']);
            Route::post('/order/register', ['as' => 'order.register.post', 'uses' => 'OrderController@postRegister']);

            Route::get('/order/address', ['as' => 'order.address', 'uses' => 'OrderController@showOrderAddress']);

            Route::get('/order/address/guest', ['as' => 'order.address.guest', 'uses' => 'OrderController@showGuestAddressForm']);
            Route::post('/order/address/guest', ['as' => 'order.address.guest.post', 'uses' => 'OrderController@postGuestAddressForm']);

            Route::get('/order/address/{type}/edit', ['as' => 'order.address.edit', 'uses' => 'OrderController@editAddress']);
            Route::put('/order/address/{type}/update', ['as' => 'order.address.update', 'uses' => 'OrderController@updateAddress']);

            //* ***** END KAFFEMASCHINEN CART FRONT ROUTES  *****  */

            Route::get('/checkout', ['as' => 'checkout.index', 'uses' => 'CheckoutController@index']);

            Route::get('/uber-uns', ['as' => 'about-us', 'uses' => 'PageController@about']);

            Route::get('/wir-kaufen', ['as' => 'wir-kaufen', 'uses' => 'PageController@wirKaufen']);

            Route::post('/wir-kaufen/send/email', ['as' => 'wir-kaufen.mail', 'uses' => 'PageController@sendWirEmail']);

            Route::get('/kontakt', ['as' => 'contact', 'uses' => 'PageController@contact']);

            Route::post('/kontakt/send/email', ['as' => 'contact.email', 'uses' => 'PageController@sendContactEmail']);

            Route::get('/page/{slug}', ['as' => 'page.show', 'uses' => 'PageController@show']);

            Route::post('/subscribe', ['as' => 'subscribe', 'uses' => 'PageController@subscribe']);

            Route::get('/partner', ['as' => 'page.partner', 'uses' => 'PartnerController@index']);
        });

    Route::middleware(['web'])
        ->namespace('\Front\Auth')
        ->group(function () {


            Route::get('/login', ['as' => 'login', 'uses' => 'LoginController@showLoginForm']);
            Route::post('/login', ['as' => 'login.post', 'uses' => 'LoginController@authenticate']);
            Route::get('/logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);

            Route::get('/register', ['as' => 'register', 'uses' => 'RegisterController@showRegistrationForm']);
            Route::post('/register', ['as' => 'register.post', 'uses' => 'RegisterController@register']);

            Route::get('/verifyemail/{token}', 'RegisterController@verify');

            Route::get('/forgot-password', 'ForgotPasswordController@forgotPassword');
            Route::post('/forgot-password', 'ForgotPasswordController@postForgotPassword');

            Route::get('/reset/{email}/{resetCode}', 'ForgotPasswordController@resetPassword');
            Route::post('/reset/{email}/{resetCode}', 'ForgotPasswordController@postResetPassword');

        });

    Route::middleware(['web']) // for test protection add front.auth next web middleware
        ->namespace('\Front')
        ->group(function () {

            Route::get('my-account', ['as' => 'my-account.home', 'uses' => 'MyAccountController@home']);

            Route::get('/my-account/edit', ['as' => 'my-account.edit', 'uses' => 'MyAccountController@edit']);
            Route::post('/my-account/edit', ['as' => 'my-account.store', 'uses' => 'MyAccountController@store']);

            Route::get('/my-account/upload-image', ['as' => 'my-account.upload-image', 'uses' => 'MyAccountController@uploadImage']);
            Route::post('/my-account/upload-image', ['as' => 'my-account.upload-image.post', 'uses' => 'MyAccountController@uploadImagePost']);

            Route::get('/my-account/address/new', 'AddressController@create')->name('my-account.address.new');
            Route::post('/my-account/address/new', 'AddressController@store');
            Route::resource('/my-account/address', 'AddressController', ['as' => 'my-account']);

            Route::get('/my-account/orders', ['as' => 'my-account.orders', 'uses' => 'MyAccountController@orders']);
            Route::get('/my-account/order/{id}', ['as' => 'my-account.order.view', 'uses' => 'MyAccountController@orderView']);

            Route::get('/my-account/change-password', ['as' => 'my-account.change-password', 'uses' => 'MyAccountController@changePassword']);
            Route::post('/my-account/change-password', ['as' => 'my-account.change-password.post', 'uses' => 'MyAccountController@changePasswordPost']);
        });


    Route::middleware(['web'])
        ->prefix('admin')
        ->namespace('\Admin')
        ->group(function () {

            Route::get('login', ['as' => 'admin.login', 'uses' => 'LoginController@loginForm']);
            Route::post('login', ['as' => 'admin.login.post', 'uses' => 'LoginController@login']);
            Route::get('logout', ['as' => 'admin.logout', 'uses' => 'LoginController@logout']);

            Route::get('password/reset', ['as' => 'admin.password.reset', 'uses' => 'ForgotPasswordController@showLinkRequestForm']);
        });

    Route::middleware(['web']) // for test protection add admin.auth next web middleware
        ->prefix('admin')
        ->namespace('\Admin')
        ->group(function () {
            Route::get('/', function (){ return redirect()->route('admin.product.index'); });

            Route::resource('category', 'CategoryController', ['as' => 'admin']);

            Route::resource('product', 'ProductController', ['as' => 'admin']);
            Route::post('product-image/upload', ['as' => 'admin.product.upload-image',
                'uses' => 'ProductController@uploadImage']);
            Route::post('product-image/delete', ['as' => 'admin.product.delete-image',
                'uses' => 'ProductController@deleteImage']);

            Route::resource('package', 'PackageController', ['as' => 'admin']);
            Route::post('package/searchProducts', ['as' => 'admin.package.search-products',
                'uses' => 'PackageController@searchProducts']);
            Route::post('package/getSingleProduct', ['as' => 'admin.package.get-single-product',
                'uses' => 'PackageController@getSingleProduct']);

            Route::resource('popup', 'PopupController', ['as' => 'admin']);

            Route::resource('partner', 'PartnerController', ['as' => 'admin']);

            Route::resource('/admin-user', 'AdminUserController', ['as' => 'admin']);
            Route::resource('/change-password', 'ChangePasswordController', ['as' => 'admin']);

            Route::post('/change-password', ['as' => 'admin.change.password', 'uses' => 'ChangePasswordController@update']);

            Route::get('order', ['as' => 'admin.order.index', 'uses' => 'OrderController@index']);
            Route::get('order/{id}', ['as' => 'admin.order.view', 'uses' => 'OrderController@view']);
            Route::get('order/{id}/send-email-invoice', ['as' => 'admin.order.send-email-invoice', 'uses' => 'OrderController@sendEmailInvoice']);
            Route::get('order/{id}/change-status', ['as' => 'admin.order.change-status', 'uses' => 'OrderController@changeStatus']);
            Route::put('order/{id}/update-status', ['as' => 'admin.order.update-status', 'uses' => 'OrderController@updateStatus']);

            Route::get('buyer', ['as' => 'admin.buyer.index', 'uses' => 'BuyerController@index']);
            Route::resource('newsletter', 'NewsletterController', ['as' => 'admin']);
            Route::get('csvview',['as'=>'csvview','uses'=>'NewsletterController@csvView']);

            Route::get('page/home', ['as' => 'admin.page.home', 'uses' => 'PageController@home']);
            Route::get('page/home/create', ['as' => 'admin.home.create', 'uses' => 'PageController@homeCreate']);
            Route::post('page/home/create', ['as' => 'admin.home.store', 'uses' => 'PageController@homeStore']);
            Route::get('page/home/edit/{id}', ['as' => 'admin.home.edit', 'uses' => 'PageController@homeEdit']);
            Route::post('page/home/edit/{id}', ['as' => 'admin.home.update', 'uses' => 'PageController@homeUpdate']);
            Route::post('page/home/destroy/{id}', ['as' => 'admin.home.destroy', 'uses' => 'PageController@homeDestroy']);

            Route::get('page/uber-uns', ['as' => 'admin.page.uber-uns', 'uses' => 'PageController@uberUns']);
            Route::get('page/uber-uns/create', ['as' => 'admin.uber-uns.create', 'uses' => 'PageController@bannerUberUnsCreate']);
            Route::post('page/uber-uns/create', ['as' => 'admin.uber-uns.store', 'uses' => 'PageController@bannerUberUnsStore']);
            Route::post('page/uber-uns/update/{id}', ['as' => 'admin.uber-uns.update.text', 'uses' => 'PageController@textUpdateUberUns']);
            Route::post('page/uber-uns/destroy/{id}', ['as' => 'admin.uber-uns.destroy', 'uses' => 'PageController@bannerUberUnsDestroy']);

            Route::get('page/wir-kaufen', ['as' => 'admin.page.wir-kaufen', 'uses' => 'PageController@wirKaufen']);
            Route::post('page/wirkaufen/update/{id}', ['as' => 'admin.wir-kaufen.update', 'uses' => 'PageController@updateWirKaufen']);

            Route::get('statistics', ['as' => 'admin.statistics', 'uses' => 'StatisticsController@index']);
        });
// });

Route::middleware(['web'])
    ->namespace('\Front\Auth')
    ->group(function () {

    Route::get('/login', ['as' => 'login', 'uses' => 'LoginController@showLoginForm']);
    Route::post('/login', ['as' => 'login.post', 'uses' => 'LoginController@authenticate']);
    Route::get('/logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);

    Route::get('/register', ['as' => 'register', 'uses' => 'RegisterController@showRegistrationForm']);
    Route::post('/register', ['as' => 'register.post', 'uses' => 'RegisterController@register']);

    Route::get('/verifyemail/{token}', 'RegisterController@verify');
});

// Route::get('pdf', 'Front\OrderController@getPdf');
Route::get('agb', 'Front\HomeController@getAGB');
Route::get('impressum', 'Front\HomeController@getImpressum');

// Route::get('/optimize', function() {
// $exitCode = Artisan::call('optimize');
// return '<h1>Reoptimized class loader</h1>';
// });

// Route::get('/config-cache', function() {
// $exitCode = Artisan::call('config:cache');
// return '<h1>Clear Config cleared</h1>';
// });


