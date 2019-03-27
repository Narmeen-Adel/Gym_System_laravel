@extends('layouts.admin')
@section('content')

<div class="container">
    <h2 class="box-title">Cities</h2><br>

    <table id="example" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>City Manager</th>
          <th>Created At</th>
          <th>Updated At</th>
          <th>Actions</th>
        </tr>
      </thead>
    </table>                 
      
  <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
        $('#example').DataTable( {
            processing: true,
            serverSide: true,
            
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/data_cities',
                dataType : 'json',
                type: 'get',
            },
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'city_manager_id' },
                { data: 'created_at' },
                { data: 'updated_at' },
               {
                    mRender: function (data, type, row) {
                        return '<a href="#" class=" btn btn-danger" row_id="' + row.id + '" data-toggle="modal" data-target="#DeleteModal" id="delete_toggle" style="margin-left:10px;"><i class="fa fa-times"></i><span>Delete</span></a>'

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
    <a href='/cities/create' style="margin-top: 10px;" class="btn btn-info"><i class="fa fa-plus"></i><span>Add New City</span></a>                   


</div>  

@endsection


