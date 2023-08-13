<?php

namespace App\Http\Controllers\Dispatcher;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\services\DispatcherDeclinedService;
use Illuminate\Support\Facades\Auth;


class DispatcherController extends Controller
{
    public function create()
    {
        return view('dispatcher.create');
    }

    public function index()
    {
      $notification =  Auth::guard('dispatcher')
                           ->user()->notifications()
                           ->latest()->take(1)->get();
        return view('dispatcher.index',['notifications'=>$notification]);
    }

    public function login()
    {
        return view('dispatcher.login');
    }
   
    public function accepted(Notification $notification)
    {
        $notification->updateNotificationStatus($notification->id,'accepted');
        return back()->with('msg','Order accepted');
    }

    public function delivered(Notification $notification)
    {
        $notification->updateNotificationStatus($notification->id,'delivered');
        return back();
    }

    public function declined($orderId,$userId,$dispatcherId)
    {
        $declinedService = app(DispatcherDeclinedService::class);
        $declinedService->declined($orderId,$userId,$dispatcherId);
        return back();
    }
}
