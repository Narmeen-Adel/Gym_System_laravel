@extends('layouts.admin')

@section('content')

 @if ($errors->any())
   <div class="alert alert-danger">
       <ul>
           @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
           @endforeach
       </ul>
   </div>
@endif 
<div class="container con">
    <br>
    <br>
    <h2>Edit Gym</h2>
    <form action="{{route('gyms.update',$gym->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
           <label>Gym Name</label>
           <input name="name" value="{{$gym->name}}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name">
       </div>

       <div class="form-group">
            <label>Cover Image</label>
            <input name="cover_image" type="file" class="form-control" value="{{$gym->cover_image}}"/>
        </div>
        
        <button type="submit" class="btn btn-primary" style="display:inline; float:left;">Submit</button>
    </form>
    <a href="{{route('gyms.index')}}" class="btn btn-danger" style="display:inline; float:left; margin-left:10px;">Back</a>

</div>
@endsection
