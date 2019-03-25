@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Coaches</h2>
    <br>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($coaches as $coach)
            <tr>
                <td>{{$coach->id}}</td>
                <td>{{$coach->name}}</td>

                <td>
                    <a href="{{route('coaches.edit',[$coach->id])}}" class="btn btn-success"><i class="fa fa-edit"></i><span>Edit</span></a>

                    <form action="{{route('coaches.destroy',[$coach->id])}}" method="Post" style="display:inline; float:left; margin-right:10px;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you Sure !')" class="btn btn-danger"><i class="fa fa-times"></i><span>Delete</span></button>
                    </form>

                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <br>
    <a class="btn btn-info" href="{{route('coaches.create')}}"><i class="fa fa-plus"></i><span>Add New Coach</span></a>
    <br>
    <br>

</div>

@endsection
