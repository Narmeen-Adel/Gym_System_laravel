@extends('layouts.admin')

@section('content')
<div class="container con">
<h2>Buy Package</h2>

<br><br>

<form method="POST" action="{{route('sales.store')}}"> 
@csrf

<div class="form-group">
  <label>User Name</label>
     <select class="form-control" name="customer_id">
        @foreach($customers as $customer)
          <option value="{{$customer->id}}">{{$customer->name}}</option>
          @endforeach
    </select>
</div>

<div class="form-group">
  <label>Choose Package</label>
     <select class="form-control" name="package_id">
        @foreach($packages as $package)
          <option value="{{$package->id}}">{{$package->sessionsNumber}}</option>
          @endforeach
    </select>
</div>
        
<div class="form-group">
  <label>Choose Gym</label>
     <select class="form-control" name="gym_id">
        @foreach($gyms as $gym)
          <option value="{{$gym->id}}">{{$gym->name}}</option>
          @endforeach
    </select>
</div>

@foreach($packages as $package)
<div class="form-group">
  <input name="paid_price" type="hidden" value="{{$package->price}}" class="form-control" />
</div>

<div class="form-group">
  <input name="available_sessions" type="hidden" value="{{$package->sessionsNumber}}" class="form-control" />
</div>


<!-- 4242 4242 4242 4242 -->
<script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_DHtOy8k5Qt9fT0xZTRe6iPPS00RW6IqPvR"
    data-amount="{{$package->price}}"
    data-name="Stripe.com"
    data-description="Package charge"
    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
    data-locale="auto"
    data-zip-code="true">
</script> 
@endforeach

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
