<x-dispatcher_layout>
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
              <form action="accepted/{{$notification->id}}" method="post">
                @method('PATCH')
                  @csrf
                  <button type="submit">Accept</button>
              </form>

              <form action="declined/{{$notification->order_id}}/{{$notification->user_id}}/{{$notification->dispatcher_id}}" method="post">
                  @csrf
                  @method('PATCH')
                  <button type="submit">Decline</button>
              </form>
          @else
          <form action="delivered/{{$notification->id}}" method="post">
                @csrf
                @method('PATCH')
                <button type="submit">Deliver</button>
          </form>
            </ul>
          @endif
      @else
                <p>you don't have an order</p>
      @endif
    @empty
          
               <p>you don't have an order</p>
    @endforelse
     
  
    </section>
</x-dispatcher_layout>