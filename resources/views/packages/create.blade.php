@extends('layouts.admin')



    @section('content')
    <!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif -->

    <br>
    <br>

    <div class="container con">
        <h2>Add Package</h2>

    <form action="{{route('packages.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label>Package Name</label>
            <input name="name" type="text" class="form-control">
        </div>

        <div class="form-group">
            <label>Sessions Number</label>
            <input name="sessionsNumber" class="form-control"/>
        </div>


        <div class="form-group">
            <label>Package Price</label>
            <input name="price" class="form-control" />
        </div>


        <div class="form-group">
            <label>Gym Name</label>
            <select class="form-control" name="gym_id">
                @foreach($gyms as $gym)
                <option value="{{$gym->id}}">{{$gym->name}}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{route('packages.index')}}" class="btn btn-danger">Back</a>
    </form>
 </div>
@endsection
