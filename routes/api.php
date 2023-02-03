<?php

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


Route::group(['prefix' => '/development'], function () {

    Route::get('/', function () {
        return 'api test';
    });

    Route::middleware('api') ->group(base_path('routes/api/auth.php'));

    Route::namespace('Web')->group(base_path('routes/api/guest.php'));

    Route::prefix('panel')->middleware('api.auth')->namespace('Panel')->group(base_path('routes/api/user.php'));

    Route::group(['namespace' => 'Config', 'middleware' => []], function () {
        Route::get('/config', ['uses' => 'ConfigController@list']);
    });



    Route::group(['namespace' => 'Instructor', 'prefix' => 'instructor', 'middleware' => ['api.auth', 'api.level-access:teacher']], function () {

      //  Route::get('/', function (){dd('ff');});


        Route::group(['prefix' => 'webinar'], function () {
            Route::post('/', ['uses' => 'WebinarsController@storeAll']);

        });
        Route::group(['prefix' => 'quizzes'], function () {
            Route::get('/list', ['uses' => 'QuizzesController@results']);
            Route::post('/', ['uses' => 'QuizzesController@store']);
            Route::put('/{id}', ['uses' => 'QuizzesController@update']);
            Route::delete('/{id}', ['uses' => 'QuizzesController@destroy']);

        });
        //  Route::get('sales', ['uses' => 'SalesController@list']);
        Route::group(['prefix' => 'meetings'], function () {
            Route::get('/', function (){dd('ff');});

            Route::get('/requests', ['uses' => 'ReserveMeetingController@requests']);
            Route::post('/create-link', ['uses' => 'ReserveMeetingController@createLink']);
            Route::post('/{id}/finish', ['uses' => 'ReserveMeetingController@finish']);

        });
        Route::group(['prefix' => 'comments'], function () {
            Route::get('/', ['uses' => 'CommentsController@myClassComments']);
            Route::post('/{id}/reply', ['uses' => 'CommentsController@reply']);
        });

    });


});
