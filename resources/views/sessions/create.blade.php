@extends('layouts.admin')
@section('content')
    <br>
    <br>
    <div class="container con">
        <h2>Training Sessions</h2>

        <form action="{{route('sessions.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label>Session Name</label>
            <input name="name" type="text" class="form-control">
        </div>

        <div class="form-group">
            <label>Session Day</label>
            <label>in Format: Y-m-d</label>
            <input name="day" class="form-control"/>
        </div>


        <div class="form-group">
            <label>Start Time</label>
            <label>in Format: Y-m-d H:m:s</label>
            <input name="starts_at" class="form-control" />
        </div>

        <div class="form-group">
            <label>End Time</label>
            <label>in Format: Y-m-d H:m:s</label>
            <input name="finishes_at" class="form-control" />
        </div>


        <div class="form-group">
            <label>Gym</label>
            <select class="form-control" name="gym_id">
                @foreach($gyms as $gym)
                <option value="{{$gym->id}}">{{$gym->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Package</label>
            <select class="form-control" name="package_id">
                @foreach($packages as $package)
                <option value="{{$package->id}}">{{$package->name}}</option>
                @endforeach
            </select>
        </div>
            

              <div class="form-group">
                <label>Select Coaches</label>
                <label>Must Select at least One</label>
                <select class="form-control select2 select2-hidden-accessible" multiple="" name="coaches[]" data-placeholder="Select coaches" style="width: 100%;" tabindex="-1" aria-hidden="true">
                    @foreach($coaches as $coach)
                    <option value="{{$coach->id}}">{{$coach->name}}</option>
                @endforeach
                </select>
            </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{route('sessions.index')}}" class="btn btn-danger">Back</a>
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
    <script>   
    $('.select2').select2();
      </script>
@endsection

