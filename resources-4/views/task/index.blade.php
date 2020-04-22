@if(Auth::user()->usertype == 'admin')
@extends('layouts.app')
@section('content')
		<section style="padding-left: 60px; padding-top: 80px; height: 100vh; background: #EEEEEE;">
      <div class="container-fluid">
        <div class="row mb-12">
          <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
            <div class="row align-items-center">
              <div class="col-xl-11 col-12 mb-4 mb-xl-0">
                <h3 class="text-muted text-center mb-3">Task</h3>
                <button type="button" class="btn btn-info btn-gb" data-toggle="modal" data-target="#myModal">Create Task</button>
                

<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding-bottom: 50px;">
        <h5 class="modal-title" id="exampleModalLabel">New Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('services.store') }}" method="post">
          
          {{csrf_field()}}
          
          <div class="form-group">
            <label for="recipient-name" class="col-form-label text-left"><i class="fa fa-server"></i> Service</label>
            <input type="text" name="name" placeholder="Service" class="form-control">
          </div>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Service</button>
      </div>
    </div>
  </div>
</div> -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       
        <h4 class="modal-title" id="myModalLabel">New Task</h4>
      </div>
      <form action="" method="post">
      		{{csrf_field()}}
	      <div class="modal-body">
				<div class="form-group">
              <label for="title"><i class="fas fa-heading text-primary"></i> Name</label>
              <input type="text" class="form-control" name="name" id="title">
            </div>

            
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save</button>
	      </div>
      </form>
    </div>
  </div>
</div>
                <table id="" class="display" style="width:100%; padding-top: 20px;">
        <thead>
            <tr>
               <th>Task</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        	
            <tr>
                <td>Debug</td>
               
                <td style="text-align: center;"><!-- <a href="#"><i class="fas fa-trash text-danger text-center"></i></a> -->
                  <button class="btn btn-primary-outline" data-myname="" data-catid='' data-toggle="modal" data-target="#edit"><i class="fa fa-edit text-success"></i></button>
                  
                  <button class="btn btn-primary-outline" data-catid='' data-toggle="modal" data-target="#delete"><i class="fa fa-trash text-danger"></i></button>
                </td>
            </tr>
            
        </tbody>
        <tfoot>
           
        </tfoot>
    </table>
     
              </div>  
            </div>    
          </div>      
        </div>        
      </div>
    </section>
    <!-- Delete Modal -->
    <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
      </div>
      <form action="" method="post">
          {{-- {{method_field('delete')}} --}}
          {{csrf_field()}}
        <div class="modal-body">
        <p class="text-center">
          Are you sure you want to delete this?
        </p>
            <input type="hidden" name="service_id" id="cat_id" value="">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
          <button type="submit" class="btn btn-warning">Yes, Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End of Delete -->
<!-- Edit -->
  <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Task</h4>
      </div>
      <form action="" method="post">
          {{-- {{method_field('patch')}} --}}
          {{csrf_field()}}
        <div class="modal-body">
            <input type="hidden" name="service_id" id="cat_id" value="">
             

            <div class="form-group">
              <label for="title"><i class="fa fa-star"></i> Name</label>
              <input type="text" class="form-control" name="name" id="name">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js" integrity="sha256-qSIshlknROr4J8GMHRlW3fGKrPki733tLq+qeMCR05Q=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js" integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js" integrity="sha256-arMsf+3JJK2LoTGqxfnuJPFTU4hAK57MtIPdFpiHXOU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" integrity="sha256-Uv9BNBucvCPipKQ2NS9wYpJmi8DTOEfTA/nH2aoJALw=" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="{{asset('script.js')}}"></script>
    <script>
  
  $('#edit').on('show.bs.modal', function (event) {
      
      var button = $(event.relatedTarget) 
      var name = button.data('myname') 
     
      var cat_id = button.data('catid') 
      var modal = $(this)
      console.log(name);
      modal.find('.modal-body #name').val(name);
     
      modal.find('.modal-body #cat_id').val(cat_id);
})
  $('#delete').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var cat_id = button.data('catid') 
      var modal = $(this)
      modal.find('.modal-body #cat_id').val(cat_id);
})
</script>
    <script>
      $(document).ready(function() {
    $('table.display').DataTable();
} );
    </script>
@endsection
@endif