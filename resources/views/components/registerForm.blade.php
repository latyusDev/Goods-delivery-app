@props(['url'])
<form action={{$url}} method="post">
    @csrf
    
    <div>
        <label for="">First Name</label>
    <input value="{{old('first_name')}}" type="text" name="first_name">
    @error('first_name')
       <p style="color:red"> {{$message}}</p>
    @enderror
    </div>

    <div>
        <label for="">Last Name</label>
    <input value="{{old('last_name')}}" type="text" name="last_name">
    @error('last_name')
       <p style="color:red"> {{$message}}</p>
    @enderror
    </div>

    <div>
        <label for="">Email</label>
    <input value="{{old('email')}}" type="email" name="email">
    @error('email')
       <p style="color:red"> {{$message}}</p>
    @enderror
    </div>
    
    <div>
        <label for=""> Password</label>
        <input value="{{old('password')}}" type="password" name="password">
        @error('password')
        <p style="color:red"> {{$message}}</p>
        @enderror
    </div>

    <div>
        <label for="">Confirm Password</label>
        <input value="{{old('password_confirmaion')}}" type="password" name="password_confirmation">
        @error('password')
        <p style="color:red"> {{$message}}</p>
        @enderror
    </div>
    <div>
        <label for="">Phone Number</label>
        {{-- <input value="{{old('phone_number')}}" type="text" name="phone_number"> --}}
        <input value="08027259386" type="text" name="phone_number">
        @error('number')
        <p style="color:red"> {{$message}}</p>
        @enderror
    </div>
    <div>
        <label for=""> State</label>
        {{-- <input value="{{old('state')}}" type="text" name="state"> --}}
        <input value="Lagos" type="text" name="state">
        @error('state')
        <p style="color:red"> {{$message}}</p>
        @enderror
    </div>

    
    <div>
        <label for=""> Local Government</label>
        {{-- <input value="{{old('state')}}" type="text" name="state"> --}}
        <input value="Surulere" type="text" name="local_government">
        @error('state')
        <p style="color:red"> {{$message}}</p>
        @enderror
    </div>
    
    <div>
        <label for=""> Street</label>
        {{-- <input value="{{old('street')}}" type="text" name="street"> --}}
        <input value="Memudu" type="text" name="street">
        @error('street')
        <p style="color:red"> {{$message}}</p>
        @enderror
    </div>

    <div>
        <label for=""> Number</label>
        <input value="{{old('number')}}" type="number" name="number">
        @error('number')
        <p style="color:red"> {{$message}}</p>
        @enderror
    </div>
   
    <button type="submit">Sign Up</button>

</form>