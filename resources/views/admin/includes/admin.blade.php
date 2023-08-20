<div class="flex justify-evenly">
    <p>{{$admin->fullname}}</p>
    @includeWhen($admin->is_manager,'admin.includes.manager')
    <p>{{$admin->phone_number}}</p>
    <p>{{$admin->email}}</p>
    @php
        Auth::shouldUse('admin')
    @endphp
    @can('delete',$admin)
        <div class="self-center">
            <form action="/admin/admins/destroy/{{$admin->id}}" method="post" >
             @method('DELETE')
             @csrf
             <button type="submit">Delete</button>
            </form>
        </div>
        @if ($admin->status)
                <div>
                    <form action="/admin/admins/release/{{$admin->id}}" method="post">
                        @method('PATCH')
                     @csrf
                     <button type="submit">Release</button>
                    </form>
                </div>
        @else
                <div>
                    <form action="/admin/admins/ban/{{$admin->id}}" method="post">
                        @method('PATCH')
                        @csrf
                     <button type="submit">Ban</button>
                    </form>
                </div>
        @endif
    @endcan
        <div>
            <a href="/admin/admins/show/{{$admin->id}}">check</a>
        </div>
    </div>