
@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<a href="{{route('gyms.index')}}" class="btn btn-primary">Back</a>

   <form action="{{route('gyms.update',$gym->id)}}" method="POST">
       @csrf
       @method('PUT')
       <div class="form-group">
           <label for="exampleInputEmail1">Gym Name</label>
           <input name="name" value="{{$gym->name}}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name">
       </div>

   <button type="submit" class="btn btn-primary">Submit</button>
   </form>

