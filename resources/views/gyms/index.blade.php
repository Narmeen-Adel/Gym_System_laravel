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
                { data: 'user.name' },
                { data: 'cover_image' },
               {
                    mRender: function (data, type, row) {
                        return '<a href="/gyms/'+row.id+'/edit" class=" btn btn-success" data-id="' + row.id + '" style="margin-left:10px;"><i class="fa fa-edit"></i><span>Edit</span></a> <form style="display:inline" method="POST" action="gyms/'+row.id+'">@csrf   {{ method_field('DELETE')}}<button type="submit" onclick="return myFunction();" class="btn btn-xs btn-danger"><i class="fa fa-times"></i>Delete</button></form>'
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
    


    
//  $(document).on('click','#delete_toggle',function () {
//    var delete_id = $(this).attr('row_id');
//  });
//  $(document).on('click','#delete_toggle',function () {
//    var package_id = $(this).attr('row_delete');
//    $.ajax({
//      headers: {
//        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//      },
//      url: '/gyms/'+package_id,
//      type: 'DELETE',
//      success: function (data) {
//       // console.log(data);
//        var table = $('#example').DataTable();
//        table.ajax.reload();
//     //    if ( msg.status === 'success' ) {
//     //      toastr.success( msg.msg );
//     //      setInterval(function() {
//     //      window.location.reload();
//     //    }, 5900);
//     },

//      error: function (response) {
//        alert(' Error');
//       //  if ( data.status === 422 ) {
//       //    toastr.error('Cannot delete the category');
//       //  }
//      }
//    });
 //});

 //confirm deleting 
 function myFunction(){
                     var agree = confirm("Are you sure you want to delete this City manager?");
                        if(agree == true){
                           return true
                           }
                           else{
                           return false;
                           }
                     }



    </script>
    <a href='/gyms/create' style="margin-top: 10px;" class="btn btn-info"><i class="fa fa-plus"></i><span>Add New Gym</span></a>


</div>

@endsection


