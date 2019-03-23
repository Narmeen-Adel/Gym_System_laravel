

<a href="{{route('sales.create')}}" class="btn btn-success">Create sales</a>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">available_session</th>
      <th scope="col">package</th>
      <th scope="col">user_id</th>
    </tr>
  </thead>
  <tbody>
    @foreach($sales as $sale)
    <tr>
      <th scope="row">{{$sale->id}}</th>
      <td>{{$sale->available_sessions}}</td>
      <td>{{$sale->package->sessionsNumber}}</td>
      <td>{{ isset($sale->user->name) ? $sale->user->name: 'Not Found'}}</td>
    </tr>
    @endforeach

  </tbody>
</table