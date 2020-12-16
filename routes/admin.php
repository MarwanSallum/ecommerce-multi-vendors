<?php

use Illuminate\Support\Facades\Route;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function () {

        /////////////////////////////////////////////////////////////////////////////////////////

        Route::group(['namespace' => 'Dashboard', 'middleware' => 'guest:admin','prefix' => 'admin'], function () {
            Route::get('login','LoginController@login')-> name('admin.login');
            Route::post('login','LoginController@postLogin')-> name('admin.post.login');
        
        });

        /////////////////////////////////////////////////////////////////////////////////////////


        Route::group(['namespace' => 'Dashboard', 'middleware' => 'auth:admin', 'prefix' => 'admin'], function () {
            Route::get('/','DashboardController@index')-> name('dashboard');
            Route::get('logout','LoginController@logout')->name('admin.logout');
        
            // Setting Route
            Route::group(['prefix' => 'settings'], function () {
                Route::get('shipping-methods/{type}' , 'SettingsController@editShippingMethods')->name('edit.shipping.methods');
                Route::put('shipping-methods/{id}' , 'SettingsController@updateShippingMethods')->name('update.shipping.methods');
            });

              // Profile Route
            Route::group(['prefix' => 'profile'], function () {
                Route::get('edit' , 'ProfileController@editProfile')->name('edit.profile');
                Route::put('update' , 'ProfileController@updateProfile')->name('update.profile');
                Route::put('update-password' , 'ProfileController@updatePassword')->name('update.password');
            });

            // Main Category Route
            Route::group(['prefix' => 'main_categories'], function () {
                Route::get('/', 'MainCategoriesController@index')->name('admin.main_categories');
                Route::get('create', 'MainCategoriesController@create')->name('admin.main_categories.create');
                Route::post('store', 'MainCategoriesController@store')->name('admin.main_categories.store');
                Route::get('edit/{id}', 'MainCategoriesController@edit')->name('admin.main_categories.edit');
                Route::post('update/{id}', 'MainCategoriesController@update')->name('admin.main_categories.update');
                Route::get('delete/{id}', 'MainCategoriesController@destroy')->name('admin.main_categories.delete');
            });

               // Sub Category Route
            Route::group(['prefix' => 'sub_categories'], function () {
                Route::get('/', 'SubCategoriesController@index')->name('admin.sub_categories');
                Route::get('create', 'SubCategoriesController@create')->name('admin.sub_categories.create');
                Route::post('store', 'SubCategoriesController@store')->name('admin.sub_categories.store');
                Route::get('edit/{id}', 'SubCategoriesController@edit')->name('admin.sub_categories.edit');
                Route::post('update/{id}', 'SubCategoriesController@update')->name('admin.sub_categories.update');
                Route::get('delete/{id}', 'SubCategoriesController@destroy')->name('admin.sub_categories.delete');
            });

                // Brand Route
                Route::group(['prefix' => 'brands'], function () {
                Route::get('/', 'BrandsController@index')->name('admin.brands');
                Route::get('create', 'BrandsController@create')->name('admin.brand.create');
                Route::post('store', 'BrandsController@store')->name('admin.brand.store');
                Route::get('edit/{id}', 'BrandsController@edit')->name('admin.brand.edit');
                Route::post('update/{id}', 'BrandsController@update')->name('admin.brand.update');
                Route::get('delete/{id}', 'BrandsController@destroy')->name('admin.brand.delete');
            });
        });
        
    
});

