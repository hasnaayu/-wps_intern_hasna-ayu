<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'App\Http\Controllers\AuthController@login_view')->middleware('guest');

Route::prefix('dashboard')->namespace('App\Http\Controllers')->name('dashboard.')->group(
    static function () {
        Route::get('/login', 'AuthController@login_view')->name('login')->middleware('guest');
        Route::post('/login', 'AuthController@login')->name('login.post')->middleware('guest');
        Route::group(
            ['middleware' => ['auth']],
            function () {
                Route::get('/', 'DashboardController@index');
                Route::post('/store', 'DashboardController@monitor');
                Route::get('/create', 'DashboardController@create');
                Route::get('/logout', 'AuthController@logout')->name('logout');

                Route::prefix('employee')->name('employee.')->group(static function () {
                    Route::get('/', 'EmployeeController@index');
                    Route::get('/create', 'EmployeeController@create');
                    Route::post('/store', 'EmployeeController@store');
                    Route::get('/edit/{id}', 'EmployeeController@edit');
                    Route::put('/update/{id}', 'EmployeeController@update');
                    Route::put('/change-status/{id}', 'EmployeeController@change_status');
                    Route::delete('/delete/{id}', 'EmployeeController@delete');
                });

                Route::prefix('log')->name('log.')->group(static function () {
                    Route::get('/', 'DailyLogController@index');
                    Route::get('/create', 'DailyLogController@create');
                    Route::post('/store', 'DailyLogController@store');
                    Route::get('/is-done/{id}', 'DailyLogController@isDoneTask');
                    Route::delete('/delete/{id}', 'DailyLogController@delete');
                    Route::get('/detail/{id}', 'DailyLogController@logDetail');
                    Route::delete('/delete/{id}', 'DailyLogController@delete');

                    Route::get('/check-log', 'DailyLogController@checkLog');
                    Route::get('/accept-log/{id}', 'DailyLogController@acceptLog');
                    Route::get('/reject-log/{id}', 'DailyLogController@rejectLog');
                });
            }
        );
    }
);