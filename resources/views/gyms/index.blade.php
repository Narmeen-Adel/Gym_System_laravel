@extends('layouts.admin')
@section('content')

<div class="container">
    <h2 class="box-title">Gyms</h2><br>

    <table id="example" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Id</th>
          <th>Name</th>
          @role('admin')
          <th>City Manager</th>
          @endrole
          <th>Cover Image</th>
          <th>Actions</th>
        </tr>
      </thead>
    </table>
    <a href='/gyms/create' style="margin-top: 10px;" class="btn btn-info"><i class="fa fa-plus"></i><span>Add New Gym</span></a>

    @endsection
@section('content_scripts')
@role('admin')
<script>
var c_array = [
                { data: 'id' },
                { data: 'name' },
                {data: 'city_manager'},
                { data: 'cover_image' },


            ];
            // console.log(c_array);
</script>
@endrole
@role('city_manager')
<script>
var c_array = [
                { data: 'id' },
                { data: 'name' },
                { data: 'cover_image' },

            ];
            // console.log(c_array);
</script>
@endrole

  <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
         c_array.push(
            {
                    mRender: function (data, type, row) {
                        return '<a href="/gyms/'+row.id+'/edit" class=" btn btn-success" data-id="' + row.id + '" style="margin-left:10px;"><i class="fa fa-edit"></i><span>Edit</span></a> <form style="display:inline" method="POST" action="gyms/'+row.id+'">@csrf   {{ method_field('DELETE')}}<button type="submit" onclick="return myFunction();" class="btn btn-xs btn-danger"><i class="fa fa-times"></i>Delete</button></form>'
                    }
                },

         );


        $('#example').DataTable( {
            serverSide: true,
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/data_gyms',
                dataType : 'json',
                type: 'get',
         
            },
            columns: c_array,
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


</div>

@endsection


