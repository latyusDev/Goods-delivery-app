<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')

    <title>Take it</title>
</head>

<body>
    
    <x-header name='dispatcher' url="/dispatcher/logout" />
    @if (session('msg'))
        {{session('msg')}}
    @endif

    {{$slot}}
    <x-footer/>

</body>
</html>