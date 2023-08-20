<?php

use App\Http\Controllers\Admin\AdminAuthController as AdminAuth;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDestroyController;
use App\Http\Controllers\Admin\AdminUpdateController;
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


Route::group(['prefix'=>'user','as'=>'user.','controller'=>UserController::class
],(function(){

    Route::get('register', 'create');
    Route::get('login', 'login')->name('login');
    Route::get('index', 'index')->name('index')
                                ->middleware(['auth','userStatus']);
}));

//user order routes
Route::resource('/order', OrderController::class)->only([
    'create', 'store'
])->middleware(['auth','userStatus']);

// Dispachers routes
Route::group(['prefix'=>'dispatcher','controller'=> DispatcherAuth::class,
],(function(){

    Route::post('register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
}));

Route::group(['prefix'=>'dispatcher', 'as'=>'dispatcher.', 'middleware'=>['dispatcher',
'dispatcherStatus'],'controller'=> DispatcherController::class],(function(){

    Route::withoutMiddleware(['dispatcher','dispatcherStatus'])->group(function(){
         Route::get('register','create');
         Route::get('login','login')->name('login');
    });
    Route::get('index','index')->name('index');
    // Notification activities
    Route::patch('/accepted/{notification}','accepted');
    Route::patch('/declined/{orderId}/{userId}/{dispatcherId}','declined');
    Route::patch('/delivered/{notification}','delivered');
}));


// Admin routes
Route::group(['prefix'=>'admin', 'controller'=> AdminAuth::class
],(function(){

    Route::post('register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
}));

Route::group(['prefix'=>'admin','as'=>'admin.','middleware'=>['admin','adminStatus']],
function(){
    Route::controller(AdminController::class)->group(function(){

        Route::withoutMiddleware(['admin','adminStatus'])->group(function(){
            Route::get('register', 'create');
            Route::get('login', 'login')->name('login');
        });
        Route::get('index', 'index')->name('index');
        // User activities
        Route::get('users', 'userIndex');
        Route::get('users/show/{user}','showUser');
        // Dispatchers activities
        Route::get('dispatchers', 'dispatcherIndex');
        Route::get('dispatchers/show/{dispatcher}','showDispatcher');
        // Admins
        Route::get('admins', 'adminIndex');
        Route::get('admins/show/{admin}','showAdmin');
        Route::get('orders','orderIndex');
        Route::get('orders/{order}','orderShow');
    });
    // user,dispatchers and admin
    Route::controller(AdminDestroyController::class)->group(function(){
        Route::delete('users/destroy/{user}','deleteUser');
        Route::delete('dispatchers/destroy/{dispatcher}','deleteDispatcher');
        Route::delete('admins/destroy/{admin}','deleteAdmin');
    });

    Route::controller(AdminUpdateController::class)->group(function(){
        Route::patch('users/ban/{user}','banUser');
        Route::patch('users/release/{user}','releaseUser');
        Route::patch('dispatchers/ban/{dispatcher}','banDispatcher');
        Route::patch('dispatchers/release/{dispatcher}','releaseDispatcher');
        Route::patch('admins/ban/{admin}','banAdmin');
        Route::patch('admins/release/{admin}','releaseAdmin');
    });
});
