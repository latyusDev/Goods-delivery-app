<x-admin_layout>

    <div class="flex justify-center flex-col ">
        @forelse ($users as $user)
            @if(!$user->status)
                @include('admin.includes.user')
            @endif
        @empty
            <p class="text-center">No User is Available</p>
        @endforelse
        {{-- banned users --}}

        <h1 class="font-bold text-center my-10 text-xl">Banned Users</h1>
        <div class="flex justify-center flex-col ">
            @forelse ($users as $user)
                @if($user->status)
                    @include('admin.includes.user')
                @endif
            @empty
                <p class="text-center">No User is banned</p>
            @endforelse
       </div>
</x-admin_layout>