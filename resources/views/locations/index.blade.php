
@extends('layouts.app')
@section('content')
<section style="padding-left:30px; padding-top: 80px;  background: #EEEEEE;"> 
      
  <div class="container-fluid">
    <div class="col-12 col-lg-12 col-md-12">
    <div class="row mb-12">
      <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
        <div class="row align-items-center">
          <div class="col-xl-11 col-12 mb-4 mb-xl-0">
            <h3 class="text-muted text-left mb-3 ">Location Picker</h3>

            <div class="container">
              <form action="{{route('locations.store')}}" method="post">
                {{csrf_field()}}  
                      <div class="form-group">
                        <select class="form-control" name="clients" id="clients">
                          <option disabled="" selected="">Choose Client</option>
                          @foreach($clients as $client)
                          <option value="{{$client->name}}">{{$client->name}}</option>
                          @endforeach
                        </select>
                      </div>
                            <div class="d-flex">
                              <input class="form-control mr-1" id="txtPlaces" name="name" placeholder="Enter a location">
                           </div>
                          <br>
                    <button  type="submit" class="btn btn-primary">Save</button>
                   
                  </form>
                  </div>
                      <div  class="table_box_container">
                        <table id="" class="display" style="width:100%; padding-top: 20px;" data-page-length='25'>
                        <thead>
                          
                          <tr>
                            <th scope="col">Serial N#</th>
                            <th scope="col">Client</th>
                            <th scope="col">Location</th>
                            <th scope="col">Action</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($locations as $location)
                          <tr>
                          <th scope="row">{{$location->id}}</th>
                          <td>{{$location->clients}}</td>
                            <td>{{$location->name}}</td>
                            <td style="text-align: center; width:10%;"> 
                             
                              
                              <button style="width:40%;" class=" btn-primary-outline" data-catid={{$location->id}} data-toggle="modal"  data-target="#delete"><i class="fa fa-trash text-danger" style="font-size:12px"></i></button> 
                            
                            </td>
                            
                          </tr>
                         @endforeach
                            
                        </tbody>
                      </table>
                    </div>
        </div>    
      </div>      
    </div> 
  </div>       
  </div>
</div>
</section>
      <!-- Delete Modal -->
      <div class="modal  fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <form action="{{route('locations.destroy','test')}}" method="post">
                 {{method_field('delete')}}
                {{csrf_field()}}
              <div class="modal-body">
              <p class="text-center">
                Are you sure you want to delete this?
              </p>
                  <input type="hidden" name="location_id" id="cat_id" value="">
      
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
                <button type="submit" class="btn btn-warning">Yes, Delete</button>
              </div>
            </form>
          </div>
        </div>
      </div>   
           
    
                
                     
           
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPOdaFlfXOWngpe2LkFsjuKTkbn9bW90A&libraries=places"></script>
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
    <script>
      $(document).ready(function() {
    $('table.display').DataTable();
} );
    </script>

    <script>

google.maps.event.addDomListener(window, 'load', function () {
        var places = new google.maps.places.Autocomplete(document.getElementById('txtPlaces'));
        google.maps.event.addListener(places, 'place_changed', function () {

        });
    });

    </script>
@endsection
