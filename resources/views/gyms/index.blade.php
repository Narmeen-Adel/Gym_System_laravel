@extends('layouts.admin')

@section('content')

<!-- @if ($errors->any())
   <div class="alert alert-danger">
       <ul>
           @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
           @endforeach
       </ul>
   </div>
@endif -->
<div class="container con">
    <br>
    <br>
<a href="{{route('gyms.create')}}" class="btn btn-success">Create Gym</a>
<table class="table">
  <thead>
    <tr>

      <th scope="col">Name</th>

      <th scope="col">Created At</th>
      <th scope="col">ِActions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($gyms as $gym)
    <tr>

      <td>{{$gym->name}}</td>


      <td><a href="{{route('gyms.show',$gym->id)}}" class="btn btn-success">View</a></td>
      <td><a href="{{route('gyms.edit',$gym->id)}}" class="btn btn-success">Edit</a></td>
      <td>
        <form action="{{route('gyms.destroy',$gym->id)}}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-primary" onclick="return myFunction();">Delete</button>
          <script>
            function myFunction(){
              if (!confirm('are you sure you want to delete ?'))
                event.preventDefault();

            }
          </script>
        </form>
      </td>
    </tr>
    @endforeach

  </tbody>
</table>

@endsection
