@extends('layouts.admin')
@section('content')

<div class="container con">
     <br>
     <br>
     <h2>Edit Coach</h2>
     <form action="{{route('coaches.update', [$coach->id])}}" method="post">
         @csrf
         @method('PUT')
         <div class="form-group">
             <label>Name</label>
             <input name="name" value="{{$coach->name}}" type="text" class="form-control">
         </div>

         <button type="submit" class="btn btn-primary" style="display:inline; float:left;">Submit</button>
     </form>
     <a href="{{route('coaches.index')}}" class="btn btn-danger" style="display:inline; float:left; margin-left:10px;">Back</a>

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