@extends('layouts.admin')
@section('content')

    <br>
    <br>
    <div class="container con">
        <h2>City Managers</h2>

        <form action="{{route('citymanagers.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input name="name" type="text" class="form-control">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input name="email" type="email" class="form-control"/>
        </div>


        <div class="form-group">
            <label>Password</label>
            <input name="password" type="password" class="form-control" />
        </div>

        <div class="form-group">
            <label>National_Id</label>
            <input name="national_id" class="form-control" />
        </div>
        <div class="form-group">
            <input name="position" type="hidden" value=2 class="form-control" />
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{route('citymanagers.index')}}" class="btn btn-danger">Back</a>
    </form>
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