@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Attendance</h2>
    <br>
    {{$attendances}}
    <table id="example" class="table table-bordered table-striped">
        <thead>
            <tr>

                <th>Session Id</th>
                <th>Customer Id</th>
                <th>Created At</th>
                <th>Time</th>

            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
            <tr>
                <td>{{$attendance->session_id}}</td>
                <td>{{$attendance->customer_id}}</td>

                <td>{{ Carbon\Carbon::parse($attendance->attendance_date)->format('Y-m-d') }}</td>
                <td>{{ Carbon\Carbon::parse($attendance->attendance_date)->format('H:i:s') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>


</div>

@endsection


