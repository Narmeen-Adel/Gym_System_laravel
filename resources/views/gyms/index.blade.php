@extends('layouts.admin')
@section('content')

<div class="container">
    <h2 class="box-title">Gyms</h3><br>

    <table id="example" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>City</th>
          <th>Created At</th>
          <th>Updated At</th>
          <th>Actions</th>
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
                url: '/data_gyms',
                dataType : 'json',
                type: 'get',
            },
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'city_id' },
                { data: 'created_at' },
                { data: 'updated_at' },
               {
                    mRender: function (data, type, row) {
                        return '<a href="/gyms/'+row.id+'" class=" btn btn-info" data-id="' + row.id + '" style="margin-left:10px;">Show</a>' 
                        + '<a href="/gyms/'+row.id+'/edit" class=" btn btn-success" data-id="' + row.id + '" style="margin-left:10px;"><i class="fa fa-edit"></i><span>Edit</span></a>' 
                        + '<a href="#" class=" btn btn-danger" row_id="' + row.id + '" data-toggle="modal" data-target="#DeleteModal" id="delete_toggle" style="margin-left:10px;"><i class="fa fa-times"></i><span>Delete</span></a>'

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
    </script>
    <a href='/gyms/create' style="margin-top: 10px;" class="btn btn-info"><i class="fa fa-plus"></i><span>Add New Gym</span></a>                   


</div>  

@endsection


