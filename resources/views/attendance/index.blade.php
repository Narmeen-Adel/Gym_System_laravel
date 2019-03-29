@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Attendance History</h2>
    <br>
    <table id="example" class="table table-bordered table-striped">        
    <thead>
            <tr>

                <th>User Name</th>
                <th>Email</th>
                <th>Training Session</th>
                <th>Attendance Date</th>
                <th>Attendance Time</th>
                @role('admin|city_manager')
                <th>Gym</th>
                @endrole
                @role('admin')
                <th>City</th>
                @endrole

            </tr>
        </thead>
        <tbody>
            @foreach($histories as $history)
            <tr>
                <td>{{$history->custm_name}}</td>
                <td>{{$history->email}}</td>
                <td>{{$history->session_name}}</td>
                <td>{{ Carbon\Carbon::parse($history->attendanceDate)->format('Y-m-d') }}</td>
                <td>{{ Carbon\Carbon::parse($history->attendanceDate)->format('H:i:s') }}</td>
                @role('admin|city_manager')
                <td>{{$history->gym}}</td>
                @endrole
                @role('admin')
                <td>{{$history->city}}</td>
                @endrole
            </tr>
            @endforeach
        </tbody>
    </table>


</div>

@endsection


