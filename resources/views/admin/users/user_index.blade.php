<x-adminLayout>

    <div class="flex justify-center flex-col ">
        @forelse ($users as $user)
        <div class="flex justify-evenly ">
            <p>{{$user->fullname}}</p>
                <p>{{$user->email}}</p>
                <p>{{$user->phone_number}}</p>

                
                <div class="self-center">
                    <form action="/admin/users/destroy/{{$user->id}}" method="post" >
                    @method('DELETE')
                     @csrf
                     <button type="submit">Delete</button>
                    </form>
                </div>

                <div>
                    <form action="/admin/users/ban/{{$user->id}}" method="post">
                        @method('PUT')
                     @csrf
                     <button type="submit">Ban</button>
                    </form>
                </div>

                

                <div>
                   <a href="/admin/users/show/{{$user->id}}">check</a>
                </div>
            </div>
        @empty
            <p class="text-center">No User is Available</p>
        @endforelse
        {{-- banned users --}}

        <h1 class="font-bold text-center my-10 text-xl">Banned Users</h1>
        <div class="flex justify-center flex-col ">
            @forelse ($bannedUsers as $user)
            <div class="flex justify-evenly ">
                <p>{{$user->fullname}}</p>
                    <p>{{$user->email}}</p>
                    <p>{{$user->phone_number}}</p>

                    <div>
                        <form action="/admin/users/release/{{$user->id}}" method="post">
                            @method('PUT')
                         @csrf
                         <button type="submit">Release</button>
                        </form>
                    </div>
                    <div>
                        <a href="/admin/users/destroy_permanently/{{$user->id}}">Delete permanently</a>
                     </div>
    
                   
                </div>
            @empty
                <p class="text-center">No User is banned</p>
            @endforelse
       </div>

       <h1 class="font-bold text-center my-10 text-xl">Deleted Users</h1>
        <div class="flex justify-center flex-col ">
            @forelse ($deletedUsers as $user)
            <div class="flex justify-evenly ">
                <p>{{$user->fullname}}</p>
                    <p>{{$user->email}}</p>
                    <p>{{$user->phone_number}}</p>

                    
                    <div>
                        <a href="/admin/users/destroy_permanently/{{$user->id}}">Delete permanently</a>
                     </div>
    
                    <div>
                       <a href="/admin/users/restore/{{$user->id}}">Restore User</a>
                    </div>
                </div>
            @empty
                <p class="text-center">No User is deleted</p>
            @endforelse
       </div>
</x-adminLayout>