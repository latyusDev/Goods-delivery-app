<x-userLayout>
<section @style('text-align:center')>

        <h1>{{Auth::user()->fullname}}</h1>
        <p>{{Auth::user()->email}}</p>

        <button><a href="/orders/create" class="text-red-500">Order</a></button>
        
        <div class="flex justify-between flex-wrap">
@forelse ($orders as $order)
        <div class="border w-[25%] ">
                <p>{{$order->name}}</p>
                <p>{{$order->price}}</p>
                <p>{{$order->destination}}</p>
            <div>
                @foreach ($order->notifications as $notification)
                    @if($notification->status !== 'declined')
                        <p>{{$notification->status}}</p>
                    @elseif($notification->dispatcher_id==0)
                        <p>No dispatcher Available for Now, try again later</p> 
                        {{-- @dd($order->notifications[0]->dispatcher->fullname)--}}
                    @endif
                    @if($notification->status=='accepted')
                        <p>{{$notification->dispatcher->fullname}} </p>    
                        <p>{{$notification->dispatcher->email}} </p>    
                        <p>{{$notification->dispatcher->phone_number}} </p>  
                    @endif
                @endforeach                   
            </div>
        </div>
@empty
   <p>there is no order</p>
@endforelse
    </div>
    {{$orders->links()}}
    {{$orders->count()}}
</section>


</x-userLayout>

