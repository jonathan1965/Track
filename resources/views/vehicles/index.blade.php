
@extends('layouts.app')
@include('inc.navbar')
@include('inc.messages')
@section('content')
		<section style="padding-left: 60px; padding-top: 80px; height: 100vh; background: #EEEEEE;">
      <div class="container-fluid" style="background: #EEEEEE;">
        <div class="row mb-12">
          <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
            <div class="row align-items-center">
              <div class="col-xl-11 col-12 mb-4 mb-xl-0">
                <h3 class="text-muted text-center mb-3">Vehicles</h3>
                <button type="button" class="btn btn-primary btn-gb" data-toggle="modal" data-target="#myModal">Create New Vehicle</button>

<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding-bottom: 50px;">
        <h5 class="modal-client" id="exampleModalLabel">New vehicle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('vehicles.store') }}" method="post">
          
          {{csrf_field()}}
          
          <div class="form-group">
            <label for="recipient-name" class="col-form-label text-left"><i class="fa fa-server"></i> vehicle</label>
            <input type="text" name="name" placeholder="vehicle" class="form-control">
          </div>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save vehicle</button>
      </div>
    </div>
  </div>
</div> -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      
        <h4 class="modal-title" id="myModalLabel">New Vehicle</h4>
      </div>
      <form action="{{route('vehicles.store')}}" method="post">
      		{{csrf_field()}}
	      <div class="modal-body">
            <div class="form-group">
              <label for="client"><i class="fab fa-cuttlefish text-primary"></i> Client</label>
              <select class="form-control" name="client">
                <option disabled="" selected="">Choose Option</option>
                @foreach($clients as $client)
                <option value="{{$client->name}}">{{$client->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="Type"><i class="fa fa-truck text-primary"></i> Type</label>
              <select class="form-control" name="type">
                <option disabled="" selected="">Choose Option</option>
                <option value="Car">Car</option>
                <option value="Truck">Truck</option>
                <option value="Bus">Bus</option>
                <option value="Machine">Machine</option>
                <option value="Tractor">Tractor</option>
              </select>
            </div>

				    <div class="form-group">
              <label for="title"><i class="fa fa-star text-primary"></i> Make</label>
              <input type="text" class="form-control" name="make" id="make">
            </div>
            <div class="form-group">
              <label for="title"><i class="fab fa-opencart text-primary"></i> Model</label>
              <input type="text" class="form-control" name="model" id="model">
            </div>
            <div class="form-group">
              <label for="title"><i class="fa fa-car text-primary"></i> Plate</label>
              <input type="text" class="form-control" name="plate" id="plate">
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

                <table id="" class="display" style="width:100%; padding-top: 20px;" data-page-length='25'>
        <thead>
            <tr>
               <th class="text-center">Client</th>
               <th class="text-center">Type</th>
               <th class="text-center">Make</th>
               <th class="text-center">Model</th>
               <th class="text-center">Plate Number</th>
               <th class="text-center">Action</th>
               <th class="text-center">Flag</th>
            </tr>
        </thead>
        <tbody>
        	@foreach($vehicles as $vehicle)
            <tr>
                <td class="text-center">{{$vehicle->client->name}}</td>
                <td class="text-center">{{$vehicle->type}}</td>
                <td class="text-center">{{$vehicle->make}}</td>
                <td class="text-center">{{$vehicle->model}}</td>
                <td class="text-center">{{$vehicle->plate}}</td>
                <td style="text-align: center; width:10%;"><!-- <a href="#"><i class="fas fa-trash text-danger text-center"></i></a> -->
                  <button style=" width:40%;" class=" btn-primary-outline"  data-myclient="{{$vehicle->client->name}}" data-mytype="{{$vehicle->type}}" data-mymake="{{$vehicle->make}}" data-mymodel="{{$vehicle->model}}" data-myplate="{{$vehicle->plate}}" data-catid="{{$vehicle->id}}" data-toggle="modal" data-target="#edit"><i class="fa fa-edit text-success"></i></button>
                  
                  <button style=" width:40%;" class=" btn-primary-outline"  data-catid="{{$vehicle->id}}" data-toggle="modal" data-target="#delete"><i class="fa fa-trash text-danger"></i></button>
                </td>
                @if($vehicle->status == 'open')
            <td class="text-center">
              <a href="/vehicles/{{$vehicle->id}}"><i class="fas fa-asterisk text-danger h6"></i></a>
            </td>
          @elseif($vehicle->status == 'closed')
          <td class="text-center">
          <a href="/vehicles/{{$vehicle->id}}"><i class="fas fa-asterisk text-success h6"></i></a>
          </td>
          @else
          <td class="text-center">
            <a href="/vehicles/{{$vehicle->id}}"><i class="fas fa-asterisk text-muted h6"></i></a>
          </td>
         @endif 
            </tr>
            
           @endforeach
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
      <form action="{{route('vehicles.destroy','test')}}" method="post">
          {{method_field('delete')}}
          {{csrf_field()}}
        <div class="modal-body">
        <p class="text-center">
          Are you sure you want to delete this?
        </p>
            <input type="hidden" name="vehicle_id" id="cat_id" value="">

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
        <h4 class="modal-title" id="myModalLabel">Edit Vehicle</h4>
      </div>
      <form action="{{route('vehicles.update','test')}}" method="post">
          {{method_field('patch')}}
          {{csrf_field()}}
        <div class="modal-body">
            <input type="hidden" name="vehicle_id" id="cat_id" value="">
             <div class="form-group">
              <label for="client"><i class="fa fa-building"></i> Client</label>
              <select class="form-control" name="client" id="client">
                <option disabled="" selected="">Choose Option</option>
                @foreach($clients as $client)
                <option value="{{$client->name}}">{{$client->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="Type"><i class="fa fa-truck"></i> Type</label>
              <select class="form-control" name="type" id="type">
                <option disabled="" selected="">Choose Option</option>
                <option value="Car">Car</option>
                <option value="Truck">Truck</option>
                <option value="Bus">Bus</option>
                <option value="Machine">Machine</option>
                <option value="Tractor">Tractor</option>
                <option value="Motorcycle">Motorcycle</option>
              </select>
            </div>

            <div class="form-group">
              <label for="title"><i class="fa fa-star"></i> Make</label>
              <input type="text" class="form-control" name="make" id="make">
            </div>
            <div class="form-group">
              <label for="title">Model</label>
              <input type="text" class="form-control" name="model" id="model">
            </div>
            <div class="form-group">
              <label for="title">Plate</label>
              <input type="text" class="form-control" name="plate" id="plate">
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
<!-- Edit -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js" integrity="sha256-qSIshlknROr4J8GMHRlW3fGKrPki733tLq+qeMCR05Q=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js" integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js" integrity="sha256-arMsf+3JJK2LoTGqxfnuJPFTU4hAK57MtIPdFpiHXOU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" integrity="sha256-Uv9BNBucvCPipKQ2NS9wYpJmi8DTOEfTA/nH2aoJALw=" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('script.js')}}"></script>


<script>
  
  $('#edit').on('show.bs.modal', function (event) {
      
      var button = $(event.relatedTarget) 
      var client = button.data('myclient') 
      var type = button.data('mytype') 
      var make = button.data('mymake')
      var model = button.data('mymodel') 
      var plate = button.data('myplate')
      var cat_id = button.data('catid') 
      var modal = $(this)
      console.log(client);
      modal.find('.modal-body #client').val(client);
      modal.find('.modal-body #type').val(type);
      modal.find('.modal-body #make').val(make);
      modal.find('.modal-body #model').val(model);
      modal.find('.modal-body #plate').val(plate);
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
