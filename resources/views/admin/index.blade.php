<x-adminLayout>
        <section @style('text-align:center')>
        
            <h1 @style('padding-top:10rem')>Welcome back {{Auth::guard('admin')->user()->fullname}}</h1>
    
            <p @style('margin-top:1rem')>{{Auth::guard('admin')->user()->email}}</p>
            <div>
                <a href="/admin/users">Users</a>
                <a href="/admin/dispatchers">Dispatchers</a>
                <a href="/admin/admins">Admins</a>
                <a href="/admin/orders">Orders</a>
              
            </div>
        </section>
       
</x-adminLayout>