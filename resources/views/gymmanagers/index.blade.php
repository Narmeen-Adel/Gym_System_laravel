@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Gym Managers</h2>
    <table id="example" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>name</th>
                <th>Email</th>
                <th>National_Id</th>
                <th>Options</th>
            </tr>
        </thead>
    </table>

    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
        $('#example').DataTable({
            serverSide: true,
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/data_gymmanagers',
                dataType: 'json',
                type: 'get',
            },
<<<<<<< HEAD
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'email' },
                { data: 'national_id' },
               {
                    mRender: function (data, type, row) {
                        return '<a href="/gymmanagers/'+row.id+'/edit" class=" btn btn-success" data-id="' + row.id + '" style="margin-left:10px;"><i class="fa fa-edit"></i><span>Edit</span></a> <form style="display:inline" method="POST" action="gymmanagers/'+row.id+'">@csrf   {{ method_field('DELETE')}}<button type="submit" onclick="return myFunction();" class="btn btn-xs btn-danger"><i class="fa fa-times"></i>Delete</button></form>'
=======
            columns: [{
                    data: 'id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'national_id'
                },
                {
                    mRender: function(data, type, row) {
                        if (!row.banned_at)
                            return '<a href="/gymmanagers/' + row.id + '/edit" class=" btn btn-success" data-id="' + row.id + '" style="margin-left:10px;"><i class="fa fa-edit"></i><span>Edit</span></a>' +
                                '<a href="#" class=" btn btn-danger" row_id="' + row.id + '" data-toggle="modal" data-target="#DeleteModal" id="delete_toggle" style="margin-left:10px;"><i class="fa fa-times"></i><span>Delete</span></a>' +
                                '<a href="/gymmanagers/' + row.id + '/ban" class=" btn btn-warning" data-id="' + row.id + '" style="margin-left:10px;"><i class="fa fa-close"></i><span>Ban</span></a>'
                        else
                            return '<a href="/gymmanagers/' + row.id + '/edit" class=" btn btn-success" data-id="' + row.id + '" style="margin-left:10px;"><i class="fa fa-edit"></i><span>Edit</span></a>' +
                                '<a href="#" class=" btn btn-danger" row_id="' + row.id + '" data-toggle="modal" data-target="#DeleteModal" id="delete_toggle" style="margin-left:10px;"><i class="fa fa-times"></i><span>Delete</span></a>' +
                                '<a href="/gymmanagers/' + row.id + '/unban" class=" btn btn-warning" data-id="' + row.id + '" style="margin-left:10px;"><i class="fa fa-close"></i><span>Un Ban</span></a>'

>>>>>>> 8610c066ea5e51f74bdd16fa76ff813f06ef7695
                    }
                },

            ],
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true,
        });
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

    <a class="btn btn-info" href="{{route('gymmanagers.create')}}"><i class="fa fa-plus"></i><span>Add New Gym Manager</span></a>

</div>

@endsection

<!-- /gymmanagers/'+row.id+'/ban -->
