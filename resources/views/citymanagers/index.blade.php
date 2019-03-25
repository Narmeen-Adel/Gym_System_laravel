@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>City Managers</h2>
    <br>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">name</th>
                <th scope="col">Email</th>
                <th scope="col">National_Id</th>
            </tr>
        </thead>
        <tbody>
            @foreach($citymanagers as $citymanager)
            <tr>
                <td>{{$citymanager->id}}</td>
                <td>{{$citymanager->name}}</td>
                <td>{{$citymanager->email}}</td>
                <td>{{$citymanager->national_id}}</td>

                <td>
                    <a href="{{route('citymanagers.edit',[$citymanager->id])}}" class="btn btn-success"><i class="fa fa-edit"></i><span>Edit</span></a>

                    <form action="{{route('citymanagers.destroy',[$citymanager->id])}}" method="Post" style="display:inline; float:left; margin-right:10px;">
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
    <a class="btn btn-info" href="{{route('citymanagers.create')}}"><i class="fa fa-plus"></i><span>Add New CityManager</span></a>
    <br>
    <br>

</div>

@endsection
