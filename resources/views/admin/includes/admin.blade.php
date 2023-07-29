@if(!$admin->status)
<div class="flex justify-evenly">
    <p>{{$admin->fullname}}</p>
    @includeWhen($admin->is_manager==true, 'admin.includes.manager')
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
        <div>
            <form action="/admin/admins/ban/{{$admin->id}}" method="post">
                @method('PUT')
             @csrf
             <button type="submit">Ban</button>
            </form>
        </div>
    @endcan
        <div>
            <a href="/admin/admins/show/{{$admin->id}}">check</a>
        </div>
    </div>
    @endif