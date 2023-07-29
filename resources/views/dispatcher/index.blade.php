<x-dispatcherLayout>
    <section @style('text-align:center')>
        
        <h1 @style('padding-top:10rem')>Welcome back {{Auth::guard('dispatcher')
                                                           ->user()->fullname}}</h1>

        <p @style('margin-top:1rem')>{{Auth::guard('dispatcher')
                                           ->user()->email}}</p>
                                           
    @forelse ($notifications as $notification)
          
      @if ($notification->status=='pending'||$notification->status=='accepted')
          
            <ul @style('display:flex; list-style:none; justify-content:center; gap:1rem; border:1px solid red')>
              <li>{{$notification->order->name}}</li>
              <li>{{$notification->order->state}}</li>
              <li>{{$notification->order->local_government}}</li>
              <li>{{$notification->order->destination}}</li>
          @if ($notification->status === 'pending')
              <li><a href="accepted/{{$notification->id}}">Accept</a></li>
              <li><a href="declined/{{$notification->order_id}}/{{$notification->user_id}}/{{$notification->dispatcher_id}}">Decline</a></li> 
          @else
              <li><a href="delivered/{{$notification->id}}">Delivered</a></li> 
            </ul>
          @endif
      @else
                <p>you don't have an order</p>
      @endif
    @empty
          
               <p>you don't have an order</p>
    @endforelse
     
            
     {{-- {!!
     $notification->status == 'pending' ? ' <li><a href="/dispatcher/accept/{{$notification->id}}">Accept</a></li>
     <li><a href="/decline">Decline</a></li> ' : ' <li><a href="/decline">Delivered</a></li> '
      !!} --}}
    </section>
</x-dispatcherLayout>