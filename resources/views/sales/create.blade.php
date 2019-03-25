@extends('layouts.admin')

@section('content')
<form method="POST"action="{{route('sales.store')}}"> @csrf

<h1>Create Sale</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <div class="form-group">

  <div class="form-group form-check">
    <select name="user_id" >
    @foreach($customers as $customer)
    <option value="{{$customer->id}}">{{$customer->name}}</option>
    @endforeach
    </select>
  </div>
  <div class="form-group form-check">
    <select name="package_id" >
    @foreach($packages as $package)
    <option value="{{$package->id}}">{{$package->sessionsNumber}}</option>
    @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
