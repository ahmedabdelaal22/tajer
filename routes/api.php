<?php

use Illuminate\Http\Request;

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


define('API', 'Api');
Route::middleware('auth:api')->get('/user', function (Request $request) {
   return $request->user();
});



//updateItem

Route::post('getAllCategories','Api\CategoriesController@get_cat');

Route::post('getBasicDataForCategory','Api\CategoriesController@get_sub_cat');
Route::post('{locale?}/getCountries','Api\CountriesController@get_countries');
Route::post('{locale?}/getCities','Api\CountriesController@get_cities');//getRegions
Route::post('{locale?}/getRegions','Api\CountriesController@getRegions');//addShippingAddress
Route::post('{locale?}/getShippingAddresses','Api\CountriesController@getShippingAddresses');
Route::post('{locale?}/deleteShippingAddress','Api\CountriesController@deleteShippingAddress');//updateProfile
Route::post('{locale?}/updateShippingAddress','Api\CountriesController@updateShippingAddress');
Route::post('{locale?}/getOrders','Api\CountriesController@getOrders');//getOrderDetails
Route::post('{locale?}/getOrderDetails','Api\CountriesController@getOrderDetails');//getOrderDetails
Route::post('{locale?}/updateProfile','Api\CountriesController@updateProfile');
Route::post('{locale?}/addShippingAddress','Api\CountriesController@addShippingAddress');
Route::post('get_brands','Api\BrandsController@get_brands');
Route::post('{locale?}/signup','Api\UsersController@register');
Route::post('{locale?}/forgotPassword','Api\UsersController@forgotPassword');//
Route::post('{locale?}/login','Api\UsersController@login');
Route::post('{locale?}/loginFacebook','Api\UsersController@loginFacebook');
Route::post('{locale?}/loginGoogle','Api\UsersController@loginGoogle');//getUserProfile

Route::post('{locale?}/getUserProfile','Api\UsersController@getUserProfile');
Route::post('{locale?}/registerSocial','Api\UsersController@registerSocial');
Route::post('{locale?}/homeCategory','Api\CategoriesController@homeCategory');//homeBaner
Route::post('{locale?}/getBrands','Api\BrandsController@getBrands');//itemsCategory
Route::post('{locale?}/homeList','Api\ItemsController@homeList');
Route::post('{locale?}/itemsCategory','Api\ItemsController@itemsCategory');
Route::post('{locale?}/homeBaner','Api\CategoriesController@homeBaner');//
Route::post('{locale?}/home_by_cat','Api\ItemsController@home_by_cat');//home_by_cat
Route::post('{locale?}/homeSearch','Api\ItemsController@homeSearch');
Route::post('{locale?}/getItemDetails','Api\ItemsController@getItemDetails');
Route::post('{locale?}/getShoppingCart','Api\ItemsController@getShoppingCart');
Route::post('{locale?}/removeFromCart','Api\ItemsController@removeFromCart');
Route::post('{locale?}/addFavorite','Api\WishlistController@add_wishlist');
Route::post('{locale?}/removeFavorite','Api\WishlistController@remove_wishlist');
Route::post('{locale?}/addToCart','Api\ItemsController@addToCart');
Route::post('{locale?}/getUserFavorite','Api\ItemsController@getUserFavorite');
Route::post('{locale?}/getBrandItems', 'Api\ItemsController@getBrandItems');
Route::post('get_status','Api\BrandsController@get_status');
//get Brands Item
Route::post('get_items','Api\ItemsController@get_items');
Route::post('search','Api\ItemsController@search');

Route::post('removeFavorite','Api\WishlistController@remove_wishlist');
Route::post('addAuction','Api\WishlistController@add_bids');

Route::post('sendMessage','Api\WishlistController@send_message');
Route::post('homeData','Api\CategoriesController@homeData');
//removeItem

Route::post('removeItem','Api\WishlistController@removeItem');
Route::post('updateItem','Api\WishlistController@updateItem');
Route::post('uploadImage','Api\WishlistController@uploadImage');

//Developed by houida

Route::post('itemDetails','Api\ItemsController@itemDetails');
Route::post('AddComment','Api\ItemsController@AddComment');
Route::post('ownerDetails','Api\ItemsController@ownerDetails');
Route::post('createNewItem','Api\ItemsController@createNewItem');
Route::post('AddItemsImages','Api\ItemsController@AddItemsImages');
Route::post('getUserFavorite','Api\ItemsController@getUserFavorite');
Route::post('AllCities','Api\ItemsController@AllCities');
Route::post('getMyPurchase','Api\ItemsController@getMyPurchase');
Route::post('getMessages','Api\ItemsController@getMessages');
Route::post('getMyAuction','Api\ItemsController@getMyAuction');

Route::post('updateUserProfile','Api\UsersController@updateUserProfile');
Route::post('updateUserImage','Api\UsersController@updateUserImage');
Route::post('UpdateUserPassword','Api\UsersController@UpdateUserPassword');








