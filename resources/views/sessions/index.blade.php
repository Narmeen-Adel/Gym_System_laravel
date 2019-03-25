@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Training Sessions</h2>
    <br>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">name</th>
                <th scope="col">Day</th>
                <th scope="col">Starts_at</th>
                <th scope="col">Finishes_at</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sessions as $session)
            <tr>
                <td>{{$session->id}}</td>
                <td>{{$session->name}}</td>
                <td>{{$session->day}}</td>
                <td>{{$session->starts_at}}</td>
                <td>{{$session->finishes_at}}</td>

                <td>
                    <a href="{{route('sessions.edit',[$session->id])}}" class="btn btn-success"><i class="fa fa-edit"></i><span>Edit</span></a>

                    <form action="{{route('sessions.destroy',[$session->id])}}" method="Post" style="display:inline; float:left; margin-right:10px;">
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
    <a class="btn btn-info" href="{{route('sessions.create')}}"><i class="fa fa-plus"></i><span>Add New Session</span></a>
    <br>
    <br>

</div>

@endsection
