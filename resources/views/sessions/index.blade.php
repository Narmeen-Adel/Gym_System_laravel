@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Training Sessions</h2>
    <br>
    <table id="example" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>name</th>
                <th>Day</th>
                <th>Starts_at</th>
                <th>Finishes_at</th>
                <th>Actios</th>
            </tr>
        </thead>
    </table>

    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
        $('#example').DataTable( {
            processing: true,
            serverSide: true, 
            ajax: '{!! route('sessions.get_table') !!}',
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'day' },
                { data: 'starts_at' },
                { data: 'finishes_at' },
                {
                  mRender: function (data, type, row) {
                    return '<a href="/sessions/'+row.id+'/edit" class=" btn btn-success" data-id="' + row.id + '" style="margin-left:10px;"><i class="fa fa-edit"></i><span>Edit</span></a> <form style="display:inline" method="POST" action="sessions/'+row.id+'">@csrf   {{ method_field('DELETE')}}<button type="submit" onclick="return myFunction();" class="btn btn-xs btn-danger"><i class="fa fa-times"></i>Delete</button></form>'

                  }
                },              
            ],    
        });
        /*------------------------------------------------------*/
<<<<<<< HEAD

//confirm deleting 
function myFunction(){
    var agree = confirm("Are you sure you want to delete this City manager?");
    if(agree == true){
      return true
    } else {
      return false;
     }
  }

=======
        
>>>>>>> 8610c066ea5e51f74bdd16fa76ff813f06ef7695
    </script>
    <a href='/sessions/create' style="margin-top: 10px;" class="btn btn-info"><i class="fa fa-plus"></i><span>Add New Seesion</span></a>                   
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
