<x-adminLayout>
    <h1 class="text-center py-4"><strong>Admin</strong></h1>
    <div class="flex justify-center flex-col ">
        @forelse ($admins as $admin)
            @include('admin.includes.admin')
         @empty
         <p class="text-center">No admin is Available</p>
         @endforelse

        <h1 class="font-bold text-center my-10 text-xl">Banned admins</h1>
    <div class="flex justify-center flex-col ">
        @forelse ($admins as $admin)
            @if ($admin->status)
            <div class="flex justify-evenly ">
                <p>{{$admin->fullname}}</p>
                    <p>{{$admin->email}}</p>
                    <p>{{$admin->phone_number}}</p>

                    <div>
                        <form action="/admin/admins/release/{{$admin->id}}" method="post">
                            @method('PUT')
                         @csrf
                         <button type="submit">Release</button>
                        </form>
                    </div>
    
                   
                </div>
                @endif
            @empty
                <p class="text-center">No admin is banned</p>
            @endforelse
       </div>

    
</x-adminLayout>