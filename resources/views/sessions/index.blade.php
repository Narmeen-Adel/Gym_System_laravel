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
                    return '<a href="/sessions/'+row.id+'/edit" class=" btn btn-success" data-id="' + row.id + '" style="margin-left:10px;"><i class="fa fa-edit"></i><span>Edit</span></a>'
                    + '<a href="#" class=" btn btn-danger" row_id="' + row.id + '" data-toggle="modal" data-target="#DeleteModal" id="delete_toggle" style="margin-left:10px;"><i class="fa fa-times"></i><span>Delete</span></a>'

                  }
                },              
            ],    
        });
        /*------------------------------------------------------*/
    </script>
    <a href='/sessions/create' style="margin-top: 10px;" class="btn btn-info"><i class="fa fa-plus"></i><span>Add New Seesion</span></a>                   
</div>  

@endsection
