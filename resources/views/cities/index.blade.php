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
          <th>Country</th>
          <th>Actions</th>
        </tr>
      </thead>
    </table>                 
      
  <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
        $('#example').DataTable( {
            processing: true,
            serverSide: true, 
            ajax: '{!! route('cities.get_table') !!}',
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'user.name' },
                { data: 'created_at' },
                { data: 'country.name' },
                {
                  mRender: function (data, type, row) {
                    return '<form style="display:inline" method="POST" action="cities/'+row.id+'">@csrf   {{ method_field('DELETE')}}<button type="submit" onclick="return myFunction();" class="btn btn-xs btn-danger"><i class="fa fa-times"></i>Delete</button></form>'

                  }
                }             
            ],    
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
    <a href='/cities/create' style="margin-top: 10px;" class="btn btn-info"><i class="fa fa-plus"></i><span>Add New City</span></a>                   


</div>  

@endsection


