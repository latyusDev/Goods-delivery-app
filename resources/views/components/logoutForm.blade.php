@props(['url','style'])
<form action={{$url}} method="post">
    @csrf
<button type="submit" style="{{$style??null}}">Logout</button>

</form>
