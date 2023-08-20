<x-admin_layout>

    <div class="flex justify-center flex-col ">
        @forelse ($dispatchers as $dispatcher)
            @if (!$dispatcher->status)
                    @include('admin.includes.dispatcher')
            @endif
        @empty
            <p class="text-center">No dispatcher is Available</p>
        @endforelse
        {{-- banned dispatchers --}}

        <h1 class="font-bold text-center my-10 text-xl">Banned dispatchers</h1>
        <div class="flex justify-center flex-col ">
            @forelse ($dispatchers as $dispatcher)
                @if($dispatcher->status)
                    @include('admin.includes.dispatcher')
                @endif
            @empty
                <p class="text-center">No dispatcher is banned</p>
            @endforelse
       </div>

</x-admin_layout>