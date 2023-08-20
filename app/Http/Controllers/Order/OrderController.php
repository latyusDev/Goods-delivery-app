<?php

namespace App\Http\Controllers\Order;

use App\Events\OrderShipped;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;


class OrderController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('order.create');   
    }

    /**
     * Store a newly created resource in storage.
     */
  
    public function store(OrderRequest $request)
    {   
        
        $item = $request->all();
        $item['price'] = $item['weight'];
        $item['user_id'] = auth()->user()->id;
        $order = Order::create($item);
        event(new OrderShipped($order));
        return redirect()->route('user.index');
    }
    
   
}
