@props(['name','url'])
<header class="bg-red-600">
    <h1>{{$name ?? null}}</h1>
    <nav>

        <div @style('padding-top:0.5rem')>
        
            <x-logoutForm url={{$url??null}} style="background:blue; padding-inline:40px; border-radius:7px; font-size:1rem; border:4px solid white; color:white; padding-block:10px" />

        </div>
       
        
    </nav>
</header>
