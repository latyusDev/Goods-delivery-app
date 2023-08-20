<x-admin_layout>
    <p>{{$user->fullname}}</p>
    <p>{{$user->email}}</p>
    <p> <span>+{{$user->country_code}}</span> <span>{{$user->phone_number}}</span></p>
</x-admin_layout>