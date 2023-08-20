<x-admin_layout>
    <div class="flex justify-center flex-col">
        @forelse ($orders as $order)
        
                <div class="flex justify-evenly ">
                        <p>{{$order->id}}</p>
                        <p>{{$order->name}}</p>
                        <p>{{$order->state}}</p>
                        <p>{{$order->local_government}}</p>
                        <p>{{$order->destination}}</p>
                        <p>{{$order->phone_number}}</p>
                        <p>{{$order->price}}</p>
                        <p>{{$order->weight}}</p>
                        <span><a href="orders/{{$order->id}}">details</a></span>
               </div>
        @empty
            <p class="text-center">No order is currently available</p>
        @endforelse

       
</x-admin_layout>