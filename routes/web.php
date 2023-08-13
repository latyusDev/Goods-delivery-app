<?php

use App\Http\Controllers\Admin\AdminAuthController as AdminAuth;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Dispatcher\DispatcherAuthController as DispatcherAuth;
use App\Http\Controllers\Dispatcher\DispatcherController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\User\UserAuthController as UserAuth;
use App\Http\Controllers\User\UserController;
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
    return redirect()->route('user.login');
});

Route::group(['prefix'=>'user','controller'=>UserAuth::class
],(function(){

    Route::post('register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
}));


Route::group(['prefix'=>'user','controller'=>UserController::class
],(function(){

    Route::get('register', 'create');
    Route::get('login', 'login')->name('user.login');
    Route::get('index', 'index')->name('user.index')
                                ->middleware(['auth','userStatus']);
}));

// Dispachers routes
Route::group(['prefix'=>'dispatcher','controller'=> DispatcherAuth::class,
],(function(){

    Route::post('register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
}));

Route::group(['prefix'=>'dispatcher', 'controller'=> DispatcherController::class
],(function(){

    Route::get('register','create');
    Route::get('login','login')->name('dispatcher.login');
    Route::get('index','index')->name('dispatcher.index')
                               ->middleware(['dispatcher','dispatcherStatus']);
    // Notification activities
    Route::get('/accepted/{notification}','accepted');
    Route::get('/declined/{orderId}/{userId}/{dispatcherId}','declined');
    Route::get('/delivered/{notification}','delivered');
}));


// Admin routes
Route::group(['prefix'=>'admin', 'controller'=> AdminAuth::class
],(function(){

    Route::post('register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
}));

Route::group(['prefix'=>'admin','controller'=>AdminController::class,
'middleware'=>['admin','adminStatus']],(function(){

    Route::get('register', 'create')->withoutMiddleware(['admin','adminStatus']);
    Route::get('login', 'login')->name('admin.login')
                                ->withoutMiddleware(['admin','adminStatus']);
    Route::get('index', 'index')->name('admin.index');

    // User activities
    Route::get('users', 'userIndex');
    Route::get('users/show/{user}','showUser');
    Route::put('users/ban/{id}','ban');
    Route::put('users/release/{id}','release');
    Route::delete('users/destroy/{user}','deleteUser');
    // Dispatchers activities
    Route::get('dispatchers', 'dispatcherIndex');
    Route::get('dispatchers/show/{dispatcher}','showDispatcher');
    Route::put('dispatchers/ban/{id}','banDispatcher');
    Route::put('dispatchers/release/{id}','releaseDispatcher');
    Route::delete('dispatchers/destroy/{dispatcher}','deleteDispatcher');
    // Admins
    Route::get('admins', 'adminIndex');
    Route::get('admins/show/{admin}','showAdmin');
    Route::put('admins/ban/{id}','banAdmin');
    Route::put('admins/release/{id}','releaseAdmin');
    Route::delete('admins/destroy/{admin}','deleteAdmin');
    // Orders
    Route::get('orders','orderIndex');
    Route::get('orders/{order}','orderShow');
}));

Route::resource('/orders', OrderController::class)->only([
    'index', 'create', 'store'
]);