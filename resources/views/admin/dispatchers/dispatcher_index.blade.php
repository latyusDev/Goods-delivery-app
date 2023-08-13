<x-adminLayout>

    <div class="flex justify-center flex-col ">
        @forelse ($dispatchers as $dispatcher)
        <div class="flex justify-evenly ">
            <p>{{$dispatcher->fullname}}</p>
                <p>{{$dispatcher->email}}</p>
                <p>{{$dispatcher->phone_number}}</p>

                <div class="self-center">
                    <form action="/admin/dispatchers/destroy/{{$dispatcher->id}}" method="post" >
                    @method('DELETE')
                     @csrf
                     <button type="submit">Delete</button>
                    </form>
                </div>

                <div>
                    <form action="/admin/dispatchers/ban/{{$dispatcher->id}}" method="post">
                        @method('PUT')
                     @csrf
                     <button type="submit">Ban</button>
                    </form>
                </div>

                <div>
                   <a href="/admin/dispatchers/show/{{$dispatcher->id}}">check</a>
                </div>
            </div>
        @empty
            <p class="text-center">No dispatcher is Available</p>
        @endforelse
        {{-- banned dispatchers --}}

        <h1 class="font-bold text-center my-10 text-xl">Banned dispatchers</h1>
        <div class="flex justify-center flex-col ">
            @forelse ($banneddispatchers as $dispatcher)
            <div class="flex justify-evenly ">
                <p>{{$dispatcher->fullname}}</p>
                    <p>{{$dispatcher->email}}</p>
                    <p>{{$dispatcher->phone_number}}</p>

                    <div>
                        <form action="/admin/dispatchers/release/{{$dispatcher->id}}" method="post">
                            @method('PUT')
                         @csrf
                         <button type="submit">Release</button>
                        </form>
                    </div>  
                </div>
            @empty
                <p class="text-center">No dispatcher is banned</p>
            @endforelse
       </div>

</x-adminLayout>