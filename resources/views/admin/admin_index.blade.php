<x-admin_layout>
    <h1 class="text-center py-4"><strong>Admin</strong></h1>
    <div class="flex justify-center flex-col ">
        @forelse ($admins as $admin)
            @if (!$admin->status)
                @include('admin.includes.admin')
            @endif
        @empty
            <p class="text-center">No admin is Available</p>
        @endforelse

        <h1 class="font-bold text-center my-10 text-xl">Banned admins</h1>
    <div class="flex justify-center flex-col ">
        @forelse ($admins as $admin)
            @if ($admin->status)
                @include('admin.includes.admin')
            @endif
        @empty
            <p class="text-center">No admin is banned</p>
        @endforelse
       </div>
</x-admin_layout>