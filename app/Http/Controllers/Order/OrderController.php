<?php

namespace App\Http\Controllers\Order;

use App\Events\OrderShipped;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Dispatcher;
use App\Models\Order;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('order.index');
    }

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
        return redirect('/orders');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
