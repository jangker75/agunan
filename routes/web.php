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

Route::get('/', function () {
	if (!Session::get('id_sales')) {
    	return view('index');
    }else{
		return redirect('home');
	}
});

// Route::get('/home', function () {
// 	if (!Session::get('id_sales')) {
// 		return redirect('/');
// 	}else{
// 		return view('home');
// 	}
    
// });

Route::get('/forget-password', function () {
    return view('forget');
});

Route::get('/home', 'AdminMasterSalesController@home');

Route::post('/home', 'AdminMasterSalesController@home');

Route::get('/bidding', 'AdminMasterSalesController@listbidding');
Route::post('/bidding', 'AdminMasterSalesController@bidding');
Route::get('/cari', 'AdminMasterSalesController@cari');
Route::get('/filter', 'AdminMasterSalesController@filter');


Route::post('/loginsales', 'AdminMasterSalesController@login');
Route::get('/logout', 'AdminMasterSalesController@logout');

Route::get('/pdf/{id}','AdminAgunanController@getPdf');