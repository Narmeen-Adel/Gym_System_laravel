<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
    <body>
    <form action="{{route('sessions.store')}}" method="POST">
        @csrf
        <input name="name" type='text' class="form-control" />
        <input name="day" type='text' class="form-control" />
        <input name="starts_at" type='text' class="form-control" />
        <input name="finishes_at" type='text' class="form-control" />
        <input name="gym_id" type='text' class="form-control" />

   
        
        <div class="form-group">
            <label for="exampleInputPassword1">Post Creator</label>
            <select class="form-control" name="coach_id">
                @foreach($coaches as $coach)
                    <option value="{{$coach->id}}">{{$coach->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Post Creator</label>
            <select class="form-control" name="package_id">
                @foreach($packages as $package)
                    <option value="{{$package->id}}">{{$package->id}}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <br>
        <a href="{{route('sessions.index')}}" class="btn btn-success">Back</a>
 








     @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
    </</html>