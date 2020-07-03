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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

$prefixAdmin = config('myapp.url.prefix_admin');
// echo $prefixAdmin;
Route::group(['prefix' => $prefixAdmin],function(){
	// ============================== DASHBOARD =========================
	$prefix = 'dashboard';
    $controllerName = 'dashboard';
	Route::group(['prefix' => $prefix ,'namespace' => 'Backend', 'middleware' => 'auth'],function() use ($controllerName){
		$controller = ucfirst($controllerName) . 'Controller@';
		// echo $controller;
		Route::get('/', 		    				['as' => $controllerName             , 'uses' => $controller.'index']);
	});

	$prefix = 'role';
    $controllerName = 'role';
	Route::group(['prefix' => $prefix ,'namespace' => 'Backend', 'middleware' => 'auth'],function() use ($controllerName){
		$controller = ucfirst($controllerName) . 'Controller@';
		// echo $controller;
        Route::get('/', 		    				['as' => $controllerName                     , 'uses' => $controller.'index']);
        Route::get('/form/{id?}', 		    	    ['as' => $controllerName . 'form'            , 'uses' => $controller.'form']);
        Route::post('/save', 		    	        ['as' => $controllerName . 'save'            , 'uses' => $controller.'save']);
        Route::get('/change-status-{status}/{id}', 	['as' => $controllerName . 'changestatus'    , 'uses' => $controller.'changestatus']);
        Route::get('/delete/{id}', 		    		['as' => $controllerName . 'delete'          , 'uses' => $controller.'delete']);
	});

	$prefix = 'permission';
    $controllerName = 'permission';
	Route::group(['prefix' => $prefix ,'namespace' => 'Backend', 'middleware' => 'auth'],function() use ($controllerName){
		$controller = ucfirst($controllerName) . 'Controller@';
		// echo $controller;
        Route::get('/', 		    				['as' => $controllerName                     , 'uses' => $controller.'index']);
        Route::get('/form/{id?}', 		    	    ['as' => $controllerName . 'form'            , 'uses' => $controller.'form']);
        Route::post('/save', 		    	        ['as' => $controllerName . 'save'            , 'uses' => $controller.'save']);
        Route::get('/change-status-{status}/{id}', 	['as' => $controllerName . 'changestatus'    , 'uses' => $controller.'changestatus']);
        Route::get('/delete/{id}', 		    		['as' => $controllerName . 'delete'          , 'uses' => $controller.'delete']);
		Route::post('/saveedit', 		    	        ['as' => $controllerName . 'saveedit'            , 'uses' => $controller.'saveedit']);
    });

    $prefix = 'permission_detail';
    $controllerName = 'permission_detail';
	Route::group(['prefix' => $prefix ,'namespace' => 'Backend', 'middleware' => 'auth'],function() use ($controllerName){
		$controller = ucfirst($controllerName) . 'Controller@';
		// echo $controller;
        Route::get('/', 		    				['as' => $controllerName                     , 'uses' => $controller.'index']);
        Route::get('/form/{id?}', 		    	    ['as' => $controllerName . 'form'            , 'uses' => $controller.'form']);
        Route::post('/save', 		    	        ['as' => $controllerName . 'save'            , 'uses' => $controller.'save']);
        Route::get('/change-status-{status}/{id}', 	['as' => $controllerName . 'changestatus'    , 'uses' => $controller.'changestatus']);
        Route::get('/delete/{id}', 		    		['as' => $controllerName . 'delete'          , 'uses' => $controller.'delete']);
		Route::post('/saveedit', 		    	        ['as' => $controllerName . 'saveedit'            , 'uses' => $controller.'saveedit']);
	});

	$prefix = 'user';
    $controllerName = 'user';
	Route::group(['prefix' => $prefix ,'namespace' => 'Backend', 'middleware' => 'auth'],function() use ($controllerName){
		$controller = ucfirst($controllerName) . 'Controller@';
		// echo $controller;
        Route::get('/', 		    				['as' => $controllerName                     , 'uses' => $controller.'index']);
        Route::get('/form/{id?}', 		    	    ['as' => $controllerName . 'form'            , 'uses' => $controller.'form']);
        Route::post('/save', 		    	        ['as' => $controllerName . 'save'            , 'uses' => $controller.'save']);
        Route::get('/change-status-{status}/{id}', 	['as' => $controllerName . 'changestatus'    , 'uses' => $controller.'changestatus']);
        Route::get('/delete/{id}', 		    		['as' => $controllerName . 'delete'          , 'uses' => $controller.'delete']);
        Route::get('/view', 		    	        ['as' => $controllerName . 'view'            , 'uses' => $controller.'view']);
	});
})

?>
