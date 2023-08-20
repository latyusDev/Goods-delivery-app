<div class="flex justify-evenly ">
    <p>{{$user->fullname}}</p>
        <p>{{$user->email}}</p>
        <p> <span>+{{$user->country_code}}</span> <span>{{$user->phone_number}}</span></p>
        <div class="self-center">
            <form action="/admin/users/destroy/{{$user->id}}" method="post" >
            @method('DELETE')
             @csrf
             <button type="submit">Delete</button>
            </form>
        </div>

        @if($user->status)
            <div>
                <form action="/admin/users/release/{{$user->id}}" method="post">
                    @method('PATCH')
                    @csrf
                    <button type="submit">Release</button>
                </form>
            </div>
        @else
            <div>
                <form action="/admin/users/ban/{{$user->id}}" method="post">
                    @method('PATCH')
                    @csrf
                    <button type="submit">Ban</button>
                </form>
            </div>
        @endif



        <div>
           <a href="/admin/users/show/{{$user->id}}">check</a>
        </div>
    </div>