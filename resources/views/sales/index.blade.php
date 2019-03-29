
@extends('layouts.admin')

@section('content')
 <br>
 <br>
 <div class="card">
  <div class="card-header">
  Total Revenues
  </div>
  <div class="card-body">
    <h5 class="card-title">{{$sum}} $</h5>
  </div>
</div>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">customer Email</th>
      <th scope="col">customer Name</th>
      <th scope="col">Package Name</th>
      <th scope="col">Paid Price</th>
      <th scope="col">available_session</th>

    </tr>
  </thead>
  <tbody>
    @foreach($sales as $sale)
    <tr>
      <th scope="row">{{$sale->id}}</th>
      <td>{{$sale->customer->email}}</td>
      <td>{{$sale->customer->name}}</td>
      <td>{{$sale->package->name}}</td>
      <td>{{$sale->paid_price}}</td>
      <td>{{$sale->available_sessions}}</td>
      <!-- <td>{{$sale->package->sessionsNumber}}</td> -->

    </tr>
    @endforeach

  </tbody>
</table

@endsection
