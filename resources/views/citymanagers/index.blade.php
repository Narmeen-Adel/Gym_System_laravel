@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>City Managers</h2>
    <table id="example" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>name</th>
                <th>Email</th>
                <th>National_Id</th>
                <th>Options</th >
            </tr>
        </thead>
    </table>

    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
        $('#example').DataTable( {
            serverSide: true,
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/data_citymanagers',
                dataType : 'json',
                type: 'get',
            },
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'email' },
                { data: 'national_id' },
               {
                    mRender: function (data, type, row) {
                        return '<a href="/citymanagers/'+row.id+'/edit" class=" btn btn-success" data-id="' + row.id + '" style="margin-left:10px;"><i class="fa fa-edit"></i><span>Edit</span></a> <form style="display:inline" method="POST" action="citymanagers/'+row.id+'">@csrf   {{ method_field('DELETE')}}<button type="submit" onclick="return myFunction();" class="btn btn-xs btn-danger"><i class="fa fa-times"></i>Delete</button></form>'

                    }
                },
              
            ],
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
        } );
        /*------------------------------------------------------*/

//confirm deleting 
function myFunction(){
    var agree = confirm("Are you sure you want to delete this City manager?");
    if(agree == true){
      return true
    } else {
      return false;
     }
  }

    </script>

    <a class="btn btn-info" href="{{route('citymanagers.create')}}"><i class="fa fa-plus"></i><span>Add New City Manager</span></a>

</div>

@endsection
