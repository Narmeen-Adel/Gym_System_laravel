@extends('layouts.admin')

@section('content')

<div class="container con">
    <h2>Add Gym</h2>

<form action="{{route('gyms.store')}}" method="POST" enctype="multipart/form-data" >
    @csrf
    <div class="form-group">
           <label>Name</label>
           <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name">
       </div>

       <div class="form-group">
            <input name="user_id" type="hidden" value="{{$user->id}}" class="form-control" />
        </div>
        
        <div class="form-group">
        <label>Choose City</label>
            <select class="form-control" name="city_id">
                @foreach($cities as $city)
                <option value="{{$city->id}}">{{$city->name}}</option>
                @endforeach
            </select>
        </div>

       <div class="form-group">
            <label>Upload Cover Image</label>
            <input name="cover_image" type="file" class="form-control" id="cover_image"/>
        </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{route('gyms.index')}}" class="btn btn-danger">Back</a>
</form>
</div>
<br><br>
@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
