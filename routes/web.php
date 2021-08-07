<?php

use Illuminate\Support\Facades\Route;

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



Auth::routes();

Route::get('/', 'HomeController@index');

Route::prefix('employees')->group(
    function () {
        Route::get('/', 'EmployeeController@index')->name('employees.index');        
        Route::get('/create', 'EmployeeController@create')->name('employee.create');
        Route::post('/create', 'EmployeeController@store')->name('employee.store');
        Route::get('/{employee}', 'EmployeeController@edit')->name('employee.edit');
        Route::put('/{employee}', 'EmployeeController@update')->name('employee.update');   
        Route::delete('/{employee}', 'EmployeeController@destroy')->name('employee.destroy');    
    }
);