<?php

use App\Http\Controllers\Admin\AdminAuthController as adminAuth;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Dispatcher\DispatcherAuthController as dispatcherAuth;
use App\Http\Controllers\Dispatcher\DispatcherController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\User\UserAuthController as userAuth;
use App\Http\Controllers\User\UserController;
use App\Models\Admin;
use Illuminate\Http\Request;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'user','controller'=>userAuth::class
],(function(){

    Route::post('register', 'register');
    Route::post('/login', 'login')->middleware('status');
    Route::post('/logout', 'logout');
}));


Route::group(['prefix'=>'user','controller'=>UserController::class
],(function(){

    Route::get('register', 'create');
    Route::get('login', 'login')->name('/login');
    Route::get('index', 'index')->middleware('auth');

}));

// dispachers routes
Route::group(['prefix'=>'dispatcher','controller'=> dispatcherAuth::class,
],(function(){
      
    Route::post('register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
}));

Route::group(['prefix'=>'dispatcher', 'controller'=> DispatcherController::class
],(function(){
    Route::get('register','create');
    Route::get('login','login')->name('dispatcher.login');
    Route::get('index','index')->middleware('dispatcher');
    // notification activities
    Route::get('/accepted/{notification}','accepted');
    Route::get('/declined/{orderId}/{userId}/{dispatcherId}','declined');
    Route::get('/delivered/{notification}','delivered');

}));


// admin routes
Route::group(['prefix'=>'admin', 'controller'=> adminAuth::class
],(function(){
    Route::post('register', 'register');
    Route::post('/login', 'login')->middleware('adminStatus');
    Route::post('/logout', 'logout');
}));

Route::group(['prefix'=>'admin','controller'=>AdminController::class,
'middleware'=>'admin'],(function(){
    Route::get('register', 'create')->withoutMiddleware('admin');
    Route::get('login', 'login')->name('/admin')
                                ->withoutMiddleware('admin');
    Route::get('index', 'index');

    // user activities
    Route::get('users', 'userIndex');
    Route::get('users/show/{user}','showUser');
    Route::get('users/restore/{id}','restoreUser');
    Route::get('users/destroy_permanently/{id}','destroyPermanently');
    Route::put('users/ban/{id}','ban');
    Route::put('users/release/{id}','release');
    Route::delete('users/destroy/{user}','deleteUser');
    // dispatchers activities
    Route::get('dispatchers', 'dispatcherIndex');
    Route::get('dispatchers/show/{dispatcher}','showDispatcher');
    Route::get('dispatchers/restore/{id}','restoreDispatcher');
    Route::get('dispatchers/destroy_permanently/{id}','destroyDispatcher');
    Route::put('dispatchers/ban/{id}','banDispatcher');
    Route::put('dispatchers/release/{id}','releaseDispatcher');
    Route::delete('dispatchers/destroy/{dispatcher}','deleteDispatcher');
    // Admins
    Route::get('admins', 'adminIndex');
    Route::get('admins/show/{admin}','showAdmin');
    Route::put('admins/ban/{id}','banAdmin');
    Route::put('admins/release/{id}','releaseAdmin');
    Route::delete('admins/destroy/{admin}','deleteAdmin');
    // orders
    Route::get('orders','orderIndex');
    Route::get('orders/{order}','orderShow');

}));

Route::resource('/orders', OrderController::class)->only([
    'index', 'create', 'store'
]);