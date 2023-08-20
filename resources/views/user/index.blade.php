<x-user_layout>
<section @style('text-align:center;margin-block:2rem;')>

        <h1>{{Auth::user()->fullname}}</h1>
        <p>{{Auth::user()->email}}</p>

        <button><a href="/order/create" class="text-red-500">Order</a></button>
        
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
                        @endif
                        @if($notification->status=='accepted')
                            <p>{{$notification->dispatcher->fullname}} </p>    
                            <p>{{$notification->dispatcher->email}} </p>    
                            <p>{{$notification->dispatcher->phone_number'+'$notification->dispatcher->country_code}} </p>  
                        @endif
                    @endforeach                   
                </div>
            </div>
        @empty
           <p>there is no order</p>
        @endforelse
    </div>
    {{$orders->links()}}
</section>


</x-user_layout>

