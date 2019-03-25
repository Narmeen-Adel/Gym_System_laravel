@extends('layouts.admin')
@section('content')

    <br>
    <br>
    <div class="container con">
        <h2>Coaches</h2>

        <form action="{{route('coaches.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label>Coach Name</label>
            <input name="name" type="text" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{route('coaches.index')}}" class="btn btn-danger">Back</a>
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