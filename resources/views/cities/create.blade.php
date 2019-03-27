@extends('layouts.admin')

@section('content')
    

    <div class="container con">
        <h2>Add City</h2>

    <form action="{{route('cities.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label>City Name</label>
            <input name="name" type="text" class="form-control">
        </div>

        <div class="form-group">
            <label>City Manager</label>
            <select class="form-control" name="city_manager_id">
                @foreach($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{route('cities.index')}}" class="btn btn-danger">Back</a>
    </form>
 </div>
 <br> <br>
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
