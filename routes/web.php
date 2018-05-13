<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register/failed', function () {
    return view('failed');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/get/profile', 'ProfileController@getProfile');

Route::get('/edit/user/profile', 'ProfileController@editUserProfile');


Route::group(['middleware' => ['auth', 'png']], function()
{
	// Route::get('/PNG/home', function () {
 //    	return view('PNG.home');
	// });

	Route::get('/PNG/home', 'HisotemController@pnghome');

	Route::get('/add/item', 'ItemController@index');

	Route::post('/store/item', 'ItemController@store');

	Route::get('/show/item', 'ItemController@show');

	Route::post('/delete/item/{id_item}', 'ItemController@destroy');

	Route::get('/edit/item/{id_item}', 'ItemController@update');

	Route::get('/history/item/{id_item}', 'HisotemController@create');

	Route::post('/upload/doc', 'HisotemController@store');

	// Download Route
	Route::get('/download/{fk_id_item}/{fk_arsip_req}', 'HisotemController@download');

	// 
	Route::get('/submit/png/{fk_id_item}', 'HisotemController@submit');


	Route::get('/png/user/edit', 'ProfileController@editUser') ;

});

Route::group(['middleware' => ['auth', 'opr']], function()
{
	Route::get('/OPR/home', 'HisotemController@home');

	// Route::get('/add/item', 'ItemController@index');

	// Route::post('/store/item', 'ItemController@store');

	// Route::get('/show/item', 'ItemController@show');

	// Route::post('/delete/item/{id_item}', 'ItemController@destroy');

	// Route::get('/edit/item/{id_item}', 'ItemController@update');

	Route::get('/OPR/history/item/{id_item}', 'HisotemController@load');

	Route::post('/OPR/upload/doc', 'HisotemController@save');

	// Download Route
	Route::get('/unduh_opr/{fk_id_item}/{fk_arsip_req}', 
						'HisotemController@unduh_opr');

	Route::get('/submit/opr/{fk_id_item}', 'HisotemController@move');

	Route::get('/opr/user/edit', 'ProfileController@editUser') ;

});

Route::group(['middleware' => ['auth', 'admin']], function()
{

	/*
		Routing untuk manipulasi data profile user
	*/
	Route::get('/add/profile', 'ProfileController@create');

	Route::post('/store/profile', 'ProfileController@store');

	Route::get('/show/profile', 'ProfileController@index');	
	
	Route::get('/edit/profile/{id_profile}', 'ProfileController@update');

	Route::post('/delete/profile/{id_profile}', 'ProfileController@destroy');


	/*
		Routing untuk manipulasi data request/proyek
	*/
	Route::get('/add/request', 'RequestController@create');

	Route::post('/store/request', 'RequestController@store');

	Route::get('/show/request', 'RequestController@index');

	Route::get('/edit/request/{id_profile}', 'RequestController@update');

	Route::post('/delete/request/{id_profile}', 'RequestController@destroy');

	Route::get('/get/request', 'RequestController@getProfile');


	/*
		Routing untuk manipulasi data document
	*/
	Route::get('/add/document', 'DocumentController@index');

	Route::post('/store/document', 'DocumentController@store');

	Route::get('/show/document', 'DocumentController@show');

	Route::post('/delete/document/{id_document}', 'DocumentController@destroy');

	Route::get('/edit/document/{id_doc}', 'DocumentController@update');

	/*
	Upload Document QA, Download Document PNG dkk.
	*/
	// Route::get('/QA/home', function () {
 //    	return view('QA.home');
	// });

	Route::get('/QA/home', 'HisotemController@show');

	Route::get('/QA/history/item/{id_item}', 'HisotemController@history');

	Route::get('/QA/upload/doc/{id_item}', 'HisotemController@upload');

	Route::get('/QA/download/{fk_id_item}/{fk_arsip_req}', 'HisotemController@unduh');

	Route::post('QA/store/doc', 'HisotemController@simpan');
	 
	Route::get('/submit/QA/{fk_id_item}', 'HisotemController@transfer');


	Route::get('/reject/png/{fk_id_item}', 'HisotemController@reject');

	Route::get('/reject/opr/{fk_id_item}', 'HisotemController@tolak');

	Route::get('/document/opr/{fk_id_item}', 'HisotemController@OPR_DOC');

	// setting flow
	Route::get('/QA/modify/flow', 'ProfileController@flow');

	// setting flow
	Route::get('/modify/flow', 'ProfileController@saveflow');

	Route::get('/completed/item/', 'HisotemController@completed');

	Route::get('/QA/project/item/', 'HisotemController@list');


	Route::get('/QA/user/edit', 'ProfileController@editUser') ;
	// Download Route
	// Routing di bawah harus d buat spesifik untuk QA, karena yang dibawah masih menggunakan routing seperti PNG
	// Route::get('/download/{fk_id_item}/{fk_arsip_req}', 'HisotemController@download');

	// Route::get('/QA/upload/doc/{id_item}', 'HisotemController@upload_QA');

	// Route::post('/QA/upload/doc', 'HisotemController@store');

	// Route::get('/history/item/{id_item}', 'HisotemController@create');

});


// Route::get('/TS/home', function () {
//     return view('TS.home');
// });

// Route::get('/PNG/home', function () {
//     return view('PNG.home');
// });

// Route::get('/OPR/home', function () {
//     return view('OPR.home');
// });

