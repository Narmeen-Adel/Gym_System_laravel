@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Coaches</h2>
    <br>
    <table id="example" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
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
                url: '/data_coaches',
                dataType : 'json',
                type: 'get',
            },
            columns: [
                { data: 'id' },
                { data: 'name' },
                {
                    mRender: function (data, type, row) {
                        return '<a href="/coaches/'+row.id+'/edit" class=" btn btn-success" data-id="' + row.id + '" style="margin-left:10px;"><i class="fa fa-edit"></i><span>Edit</span></a>' 
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
  
    <a class="btn btn-info" href="{{route('coaches.create')}}"><i class="fa fa-plus"></i><span>Add New Coach</span></a>

</div>

@endsection
