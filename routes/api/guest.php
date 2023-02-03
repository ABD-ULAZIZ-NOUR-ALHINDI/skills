<?php

use Illuminate\Support\Facades\Route;

Route::group([],function () {

    Route::group(['prefix' => 'courses'], function () {

        Route::get('/', ['uses' => 'WebinarController@index']);
        Route::get('/{id}', ['uses' => 'WebinarController@show']);

        Route::get('reports/reasons', ['uses' => 'ReportsController@index']);


        Route::post('/{id}/report', ['uses' => 'WebinarController@report', 'middleware' => 'api.auth']);

         Route::post('/{webinar_id}/toggle', ['uses' => 'WebinarController@learningStatus', 'middleware' => 'api.auth']);



    });

    Route::get('certificate_validation', ['uses' => 'CertificatesController@checkValidate','middleware' => 'api.request.type']);

    Route::get('featured-courses', ['uses' => 'FeatureWebinarController@index']);
    Route::get('categories', ['uses' => 'CategoriesController@index']);
    Route::get('categories/{id}/webinars', ['uses' => 'CategoriesController@categoryWebinar']);
    Route::get('trend-categories', ['uses' => 'CategoriesController@trendCategory']);
    Route::get('search', ['uses' => 'SearchController@list']);

    /******  Users ******/
    Route::group(['prefix'=>'providers'],function(){
        Route::get('instructors', ['uses' => 'UserController@instructors']);
        Route::get('organizations', ['uses' => 'UserController@organizations']);
        Route::get('consultations', ['uses' => 'UserController@consultations']);

    }) ;

    /******  Meetings ******/
    Route::post('meetings/reserve', ['uses' => 'MeetingsController@reserve', 'middleware' => ['api.auth', 'api.request.type']]);
    Route::get('users/{id}/meetings', ['uses' => 'UserController@availableTimes']);


    Route::get('users/{id}/profile', ['uses' => 'UserController@profile']);

    Route::post('users/{id}/send-message', 'UserController@sendMessage');








    Route::get('/files/{file_id}/download', ['uses' => 'FilesController@download']);

 //   Route::get('blogs/{id?}', ['uses' => 'BlogController@list']);
    Route::group(['prefix'=>'blogs'],function(){
        Route::get('/', ['uses' => 'BlogController@index']);
        Route::get('/categories', ['uses' => 'BlogCategoryController@index']);
        Route::get('/{id}', ['uses' => 'BlogController@show']);

    });

    Route::get('advertising-banner', ['uses' => 'AdvertisingBannerController@list']);

    Route::get('/subscribe', ['uses' => 'SubscribesController@list']);

    Route::get('instructors', ['uses' => 'UserController@instructors']);
    Route::get('organizations', ['uses' => 'UserController@organizations']);

    Route::post('newsletter', ['uses' => 'UserController@makeNewsletter', 'middleware' => 'format']);
    Route::post('contact', ['uses' => 'ContactController@store', 'middleware' => 'format']);

    Route::group(['prefix'=>'regions'],function(){
        Route::get('/countries/', ['uses' => 'RegionsController@countries']);
        Route::get('/provinces/{id?}', ['uses' => 'RegionsController@provinces']);
        Route::get('/cities/{id?}', ['uses' => 'RegionsController@cities']);
        Route::get('/districts/{id?}', ['uses' => 'RegionsController@districts']);


    });
    Route::get('timezones', ['uses' => 'TimeZonesController@index']);

});
