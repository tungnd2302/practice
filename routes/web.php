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
})

?>
