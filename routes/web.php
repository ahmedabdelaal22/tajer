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
define('AD', 'Administrator');
define('ADI', 'Administrator/include');
define('FE', 'Frontend');
define('FEI', 'Frontend/include');
define('DSH', 'Dashboard');
define('DSHI', 'Dashboard/include');




Route::group(['middleware' => ['web']], function () {
    Auth::routes();
    Route::put('imageupload', FE . '\ItemsController@uploadimage');

    Route::get('{locale?}/login', FE . '\UsersController@login');
    Route::post('{locale?}/login', FE . '\UsersController@user_login');
//    Route::get('login', FE . '\UsersController@login');
    Route::post('{locale?}/register', FE . '\UsersController@store');
    Route::get('{locale?}/register_view', FE . '\UsersController@register_view');

    Route::get('{locale?}/logout', FE . '\UsersController@logout');
    Route::get('{locale?}/forgotPassword', FE . '\UsersController@forgotPassword');
    Route::post('{locale?}/sendPassword', FE . '\UsersController@sendPassword');

// OAuth Routes
// OAuth Routes
    Route::get('{locale?}/auth/{provider}', 'SocialAuthController@redirectToProvider');
    Route::get('auth/{provider}/callback', 'SocialAuthController@handleProviderCallback');
    Route::get('auth/Policy', 'SocialAuthController@Policy');
    Route::get('auth/terms', 'SocialAuthController@terms');

//sendPassword

    Route::get('/', FE . '\HomeController@index')->name('home');
    Route::get('/ar', FE . '\HomeController@index')->name('home');
    Route::get('/en', FE . '\HomeController@index')->name('home'); //
    Route::get('{locale?}/product-categor/{id}', FE . '\SubCategoriesController@categories');



    Route::get('{locale?}/contact-us', FE . '\ContactusController@create'); //houida
     Route::post('{locale?}/store-contact', FE . '\ContactusController@store'); //houida
      Route::get('{locale?}/About-us', FE . '\ContactusController@About_us'); //houida

    Route::get('{locale?}/sub-cat/{id}', FE . '\SubCategoriesController@sub_category');
    Route::get('{locale?}/categories/{id}', FE . '\SubCategoriesController@categories');
    Route::get('{locale?}/categories', FE . '\SubCategoriesController@Allcategories'); //houida
//    Route::get('/ar/c/{id}', FE . '\SubCategoriesController@get_items_by_sub_category');getUserProfile
//    Route::get('/en/c/{id}', FE . '\SubCategoriesController@get_items_by_sub_category');

    Route::post('update-profile/{id?}', FE . '\UsersController@update');
    Route::any('{locale?}/search', FE . '\SubCategoriesController@search'); 
        Route::any('{locale?}/search2/{id}', FE . '\SubCategoriesController@search'); 
    Route::any('{locale?}/filter', FE . '\SubCategoriesController@filter');
    
   Route::get('{locale?}/cart','ShoppingController@index');
   
   
      Route::get('{locale?}/myorders', 'ShoppingController@myorders');
      Route::get('{locale?}/myproducts', FE . '\ItemsController@myproducts');
      Route::get('{locale?}/myordervendor', FE . '\ItemsController@myordervendor');
      Route::get('{locale?}/myorderDetails/{id}', FE . '\ItemsController@myorderDetails');
    Route::get('{locale?}/payment', 'ShoppingController@payment');


    Route::get('{locale?}/payment2/{id}/{id1}', 'ShoppingController@payment2');
    Route::get('{locale?}/payment3/{id}/{id1}/{id2}', 'ShoppingController@payment3');
    Route::get('delte_item_cart','ShoppingController@destroy');//add_couben
    Route::any('add_couben','ShoppingController@add_couben');
     Route::post('update_item_cart','ShoppingController@update');
     Route::post('add_to_cart','ShoppingController@add_to_cart');//add_to_cart_array
      Route::post('add_to_cart_array','ShoppingController@add_to_cart_array');

        Route::any('{locale?}/filter-cat', FE . '\SubCategoriesController@filter_category');
    Route::any('{locale?}/ajax_cities_country/{id?}', FE . '\CitiesController@cities_country');
    Route::any('{locale?}/ajax_regions_country/{id?}', FE . '\CitiesController@regions_city');
    Route::any('{locale?}/ajax_get_sub_category/{id?}', FE . '\SubCategoriesController@get_sub_category');
// Admin Area

    Route::get('admin/admin-login', AD . '\UsersController@login');
    Route::post('admin/admin_login', AD . '\UsersController@login_admin');
    Route::get('admin/admin_logout', AD . '\UsersController@logout');



//    Route::group(['middleware' => 'Permission:agent'], function() {subscribe
//
    Route::get('{locale?}/dashboard/settings', FE . '\UsersController@edit');


     Route::get('{locale?}/tajers', FE . '\UsersController@get_all_tajer');//houida

       Route::get('{locale?}/products/{id}', FE . '\UsersController@get_all_tajer_product');//houida


    Route::post('{locale?}/subscribe', FE . '\UsersController@subscribe_email');
    Route::resource('dashboard/items', FE . '\ItemsController');
    Route::resource('{locale?}/dashboard/items', FE . '\ItemsController');

    Route::get('{locale?}/delete', FE . '\ItemsController@delete'); 


    Route::get('{locale?}/your-inbox', FE . '\MessagesController@index'); //houida
    Route::get('{locale?}/dashboard/notifications', FE . '\NotificationsController@index'); //add_bids

    Route::post('{locale?}/add_bids', FE . '\NotificationsController@add_bids'); //
    Route::post('{locale?}/delte_notfication', FE . '\NotificationsController@delte_notfication');

//    delte_item_cartn

    Route::get('{locale?}/sent_messages', FE . '\MessagesController@sent_messages'); //houida


    Route::any('{locale?}/message', FE . '\ItemsController@message'); //houida
    Route::any('{locale?}/bid', FE . '\ItemsController@bid'); //houida
    Route::any('{locale?}/accept_bid', FE . '\ItemsController@accept_bid'); //houida





      //   Route::resource('{locale?}/addresses', FE . '\AddressesController'); //houida

    Route::get('{locale?}/addresses/create', FE . '\AddressesController@create'); //houida
    Route::post('{locale?}/addresses/store', FE . '\AddressesController@store'); //houida
    Route::get('{locale?}/Addresses/del/{id}', FE . '\AddressesController@destroy'); //yahia
    Route::resource('{locale?}/addresses', FE . '\AddressesController'); //yahia


    Route::get('{locale?}/show_spcification/{id}/{old_sub_id?}/{new_sub_id?}', FE . '\ItemsController@show_spcification'); //houida
    Route::post('{locale?}/spcification', FE . '\ItemsController@spcification'); //houida

Route::get('/404', function () {
    return view(FE.'.404', ['body_class' => 'left-sidebar']);
});

Route::get('/payment_failed', function () {
    return view(FE.'.payment_failed', ['body_class' => 'left-sidebar']);
});
Route::get('/payment_success', function () {
    return view(FE.'.payment_success', ['body_class' => 'left-sidebar']);
});
    /* wishlist */
    Route::any('{locale?}/wishlist', FE . '\WishlistController@wishlist'); //houida
    Route::get('{locale?}/Wishlist', FE . '\WishlistController@get_wishlist');
     Route::get('{locale?}/Brands', FE . '\BrandsController@get_brands');
    Route::get('{locale?}/delete_wishlist/{id}', FE . '\WishlistController@delete_wishlist');

    Route::get('{locale?}/delete_mesage/{id}', FE . '\MessagesController@delete_mesage'); //delete_end
    Route::get('{locale?}/delete_end/{id}', FE . '\MessagesController@delete_end');
    Route::get('{locale?}/messages_delted/', FE . '\MessagesController@messages_delted');
    Route::resource('{locale?}/reviews', FE . '\ReviewsController');
    Route::any('{locale?}/store_review', FE . '\ReviewsController@store_review');
//    });
    Route::get('/clear-cache', function() {
        $exitCode = Artisan::call('cache:clear');
        // return what you want
    });

    Route::any('admin/delete_gallery_ajax', FE . '\ItemImagesController@delete_gallery_ajax');

    Route::get('admin', AD . '\UsersController@login');
    Route::group(['middleware' => 'Permission:admin'], function() {
        // admins
//        Route::get('admin', AD . '\UsersController@home');
        Route::get('admin/admin', AD . '\UsersController@home');
        Route::resource('admin/users', AD . '\UsersController');
        Route::post('admin/update_active/{id}', AD . '\UsersController@update_active');

        Route::post('admin/update_active_item/{id}', AD . '\ItemsController@update_active_item'); //houida
        Route::resource('admin/brands', AD . '\BrandsController');
        Route::resource('admin/status', AD . '\StatusController');
        Route::resource('admin/admin-categories', AD . '\CategoriesController');
        Route::resource('admin/admin-colors', AD . '\ColorsController');
        Route::resource('admin/sub_categories', AD . '\SubCategoriesController');
        Route::resource('admin/specifications', AD . '\SpecificationsController');




//        Route::resource('admin/items/auction', AD . '\ItemsController');//houida
        Route::any('admin/items/fixed', AD . '\ItemsController@fixed'); //houidaaaaaaaaaaaaaa


        Route::any('admin/delete_size_ajax', AD . '\ItemsSizesController@delete_size_ajax');
        Route::any('admin/delete_gallery_ajax', AD . '\ItemsImagesController@delete_gallery_ajax');
        Route::any('admin/delete_color_ajax', AD . '\ItemsColorsController@delete_color_ajax');
        Route::resource('admin/orders', AD . '\OrdersController');
        Route::get('admin/customers-report', AD . '\ReportsController@customers');
        Route::get('admin/brands-report', AD . '\ReportsController@brands');
        Route::get('admin/orders-report', AD . '\ReportsController@orders');



//        Route::any('ajax_cities_country/{id?}', AD . '\CitiesController@cities_country');
    });
});





//
//Route::get('/', function () {
//    return view('welcome');
//});
//
//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
