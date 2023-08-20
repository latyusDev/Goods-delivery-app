<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Take it</title>
    @stack('style')
</head>
<body class="ex">
    
    <x-header name='user' url="/user/logout"/>
    @if (session('msg'))
        {{session('msg')}}
    @endif
 
    {{$slot}}
    <x-footer/>

</body>

<script>

    const state = document.getElementById('state');
    const price = document.getElementById('price');
    const weight = document.getElementById('weight');

    state.addEventListener('change', function(e){
        e.preventDefault();
        if(this.value !== 'Lagos' && weight.value !==''){
            price.textContent =  `Price: ${weight.value*1000+5000}`
        }else if(weight.value ===''){
            price.innerHTML = 'select the weight of your load'
        }
        else{
            price.textContent =  `Price: ${weight.value*1000}`
        }


    })
</script>
</html>