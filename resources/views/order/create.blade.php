<x-userLayout>
    <h1>
        Make an order
    </h1>

    <form action="/orders" method="post">
        @csrf
        <div>
            <label >Name</label>
        <input value="{{old('name')}}" type="text" name="name">
        @error('name')
           <p style="color:red"> {{$message}}</p>
        @enderror
        </div>
        <div>
            
            <label >weight</label>
        <input value="{{old('weight')}}" type="text" name="weight" id="weight">
        @error('weight')
           <p style="color:red"> {{$message}}</p>
        @enderror
        </div>
        <div>
            <select name="state" id="state">
                <option value="">state</option>
                <option value="Lagos">Lagos</option>
                <option value="Osun">Osun</option>
                <option value="Oyo">Oyo</option>
                <option value="Kano">Kano</option>
                <option value="Imo">Imo</option>
            </select>
            <div id="price"></div>
        @error('state')
           <p style="color:red"> {{$message}}</p>
        @enderror
        </div>


        <div>
            <label >destination</label>
            <input value="{{old('destination')}}" type="text" name="destination">
            @error('destination')
               <p style="color:red"> {{$message}}</p>
            @enderror
        </div>

        <div>
            <label >local_government</label>
            <input value="{{old('local_government')}}" type="text" name="local_government">
            @error('local_government')
               <p style="color:red"> {{$message}}</p>
            @enderror
        </div>
        <button type="submit">Order</button>
    </form>
    
</x-userLayout>