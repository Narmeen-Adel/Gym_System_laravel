@extends('layouts.admin')
@section('content')

<div class="container con">
     <br>
     <br>
     <h2>Edit CityManager</h2>
     <form action="{{route('citymanagers.update', [$citymanager->id])}}" method="post">
         @csrf
         @method('PUT')
         <div class="form-group">
             <label>Name</label>
             <input name="name" value="{{$citymanager->name}}" type="text" class="form-control">
         </div>
         <div class="form-group">
             <label>Email</label>
             <input name="email" type="email" class="form-control" value="{{$citymanager->email}}" />
         </div>

         <div class="form-group">
             <label>Password</label>
             <input name="password" type="password" class="form-control" value="{{$citymanager->password}}" />
         </div>


         <div class="form-group">
             <label>National_Id</label>
             <input name="national_id" class="form-control" value="{{$citymanager->national_id}}" />
         </div>
         <button type="submit" class="btn btn-primary" style="display:inline; float:left;">Submit</button>
     </form>
     <a href="{{route('citymanagers.index')}}" class="btn btn-danger" style="display:inline; float:left; margin-left:10px;">Back</a>

 </div>

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