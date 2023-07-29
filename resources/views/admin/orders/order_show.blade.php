<x-adminLayout>
    <div class="mt-7">
        <h1 class="text-center text-2xl my-9" >Order Details</h1>
        <ul class="flex justify-evenly">
            <li>{{$order->name}}</li>
            <li>{{$order->state}}</li>
            <li>{{$order->local_government}}</li>
            <li>{{$order->destination}}</li>
            <li>{{$order->price}}</li>
            <li>{{$order->weight}}</li>
        </ul>
        
        <div>
            <h2 class="text-center text-2xl mt-9">Order owner details</h2>

                <ul class="flex justify-evenly mt-9">
                <li>{{$order->user->fullname}}</li>
                <li>{{$order->user->email}}</li>
                <li>{{$order->user->phone_number}}</li>
                    
                </ul>

                <h3 class="text-center text-2xl my-9">Address</h3>
                <ul class="flex justify-evenly ">
                    <li>{{$order->user->address->state}}</li>
                    <li>{{$order->user->address->local_government}}</li>
                    <li>{{$order->user->address->street}}</li>
                    <li>{{$order->user->address->number}}</li>
                    </ul>

                <h3 class="text-center text-2xl my-9">Dispatcher details</h3>
               <div class="flex flex-col  gap-9">
                   @forelse ($order->notifications as $notification)
                <ul class="flex justify-evenly items-center border-b-[3px] border-red-600 ">
                   @if ($notification->status == 'pending')
                        <li class="text-yellow-500">{{$notification->status}}</li>
                   @elseif($notification->status == 'accepted') 
                        <li class="text-green-700">{{$notification->status}}</li>
                   @elseif($notification->status == 'declined') 
                        <li class="text-red-500">{{$notification->status}}</li>
                   @elseif($notification->status == 'delivered') 
                        <li class="text-blue-500">{{$notification->status}}</li>
                   @endif
                   <li>
                    <div class="text-center">
                        <p>{{$notification->dispatcher->fullname??' No dipatcher is available for this Order'}}</p>
                       
                    </div>
                </li>
                   <li>{{$notification->dispatcher->email??''}}</li>
                   <li>{{$notification->dispatcher->phone_number??''}}</li>
                    {{-- <li>{{$notification->local_government}}</li>
                    <li>{{$notification->street}}</li>
                    <li>{{$notification->number}}</li> --}}
                </ul>
                    @empty
                        
                    @endforelse
               </div>

                {{-- <h3 class="text-center text-2xl my-9">Dispatcher details</h3>
                <ul class="flex justify-evenly">
                    <li>{{$order->user->address->state}}</li>
                    <li>{{$order->user->address->local_government}}</li>
                    <li>{{$order->user->address->street}}</li>
                    <li>{{$order->user->address->number}}</li>
                </ul> --}}
        </div>

        
    </div>
</x-adminLayout>