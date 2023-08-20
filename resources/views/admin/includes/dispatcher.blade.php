<div class="flex justify-evenly ">
    <p>{{$dispatcher->fullname}}</p>
        <p>{{$dispatcher->email}}</p>
        <p> <span>+{{$dispatcher->country_code}}</span> <span>{{$dispatcher->phone_number}}</span></p>
        <div class="self-center">
            <form action="/admin/dispatchers/destroy/{{$dispatcher->id}}" method="post" >
                @method('DELETE')
                @csrf
                <button type="submit">Delete</button>
            </form>
        </div>
        @if ($dispatcher->status)
            <div>
                <form action="/admin/dispatchers/release/{{$dispatcher->id}}" method="post">
                    @method('PATCH')
                    @csrf
                    <button type="submit">Release</button>
                </form>
            </div>
        @else
            <div>
                <form action="/admin/dispatchers/ban/{{$dispatcher->id}}" method="post">
                    @method('PATCH')
                    @csrf
                    <button type="submit">Ban</button>
                </form>
            </div>
        @endif

        <div>
           <a href="/admin/dispatchers/show/{{$dispatcher->id}}">check</a>
        </div>
</div>