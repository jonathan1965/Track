@if(Auth::user()->usertype == 'admin' || 'user')
@extends('layouts.app')
@section('content')
    <section style="padding-top: 80px; background: #EEEEEE;" >
      
      <div class="container-fluid">
        <div class="col-12 col-lg-12 col-md-12">
        <div class="row mb-12">
          <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
            <div class="row align-items-center">
              <div class="col-xl-11 col-12 mb-4 mb-xl-0">
                <h3 class="text-muted text-left mb-3 ">Service Data</h3>
                <button type="button" class="btn btn-primary text-right btn-gb1 " data-toggle="modal" data-target="#myModal">Create New Entry</button>
                
 {{-- -NEW ENTRY --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
     
        <h4 class="modal-title" id="myModalLabel">New Entry</h4>
      </div>
      <form action="{{route('entries.store')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}  
        <div id="entries_list"></div>
      <div class="modal-body">
         <div class="row"><div  class="col-5">
          <div class="form-group">
            <label for="client"><i class="fas fa-user-shield text-primary"></i> Client</label>
            <select class="form-control" name="client" id="client">
              <!-- <option disabled="" selected="">Choose Option</option> -->
              <option value="{{$clients->name}}">{{$clients->name}}</option>
            </select>
          </div>
          <div class="form-group">
            <label for="Type"><i class="fa fa-car text-primary"></i> Vehicle</label>
            <select class="form-control" name="vehicle" id="vehicle">
              <option disabled="" selected="">Choose Option</option>
              @foreach($vehicles as $vehicle)
              <option value="{{$vehicle->plate}}"> {{$vehicle->plate}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="title"><i class="fa fa-tasks text-primary"></i> Service</label>
            <select class="form-control" name="service" id="service">
              <option disabled="" selected="">Choose Option</option>
              @foreach($services as $service)
              <option value="{{$service->name}}">{{$service->name}}</option>
             @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="title"><i class="fa fa-gas-pump text-primary"></i> Fuel(L)</label>
            <input type="text" class="form-control" name="fuel" id="fuel" placeholder="Fuel(L)">
          </div>
          <div class="form-group">
            <label for="title"><i class="fa fa-gas-pump text-primary"></i> Driver</label>
            <input type="text" class="form-control" name="driver" id="fuel" placeholder="Driver">
          </div>
          <div class="form-group">
            <label for="title"><i class="fa fa-file text-primary"></i> File</label>
            <input type="file" class="form-control" name="file" id="file">
          </div>
          </div>
         <div  class="col-7">
          <div class="form-group">
            <label for="title"><i class="fas fa-tachometer-alt text-primary"></i>Odometer Reading(km)</label>
            <input type="text" class="form-control" name="odometer_reading" id="odometer_reading" placeholder="Odometer Reading">
          </div>
          <div class="form-group">
            <label for="title"><i class="fa fa-calendar text-primary"></i> Service Date</label>
            <input type="date" class="form-control" name="service_date" id="service_date">
          </div>
          <div class="form-group">
            <label for="title"><i class="fa fa-money-bill text-primary"></i> Amount(Rwf)</label>
            <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount">
          </div>
          <div class="form-group">
            <label for="title"><i class="fas fa-sort-numeric-down text-primary"></i> Invoice Number</label>
            <input type="text" class="form-control" name="invoice_number" id="amount" placeholder="Invoice Number">
          </div>
          <div class="form-group">
            <label for="title"><i class="fa fa-map-marker text-primary"></i> Location</label>
            <select class="form-control" name="location" id="location">
              <option disabled="" selected="">Choose Option</option>
              @foreach($locations as $location)
              <option value="{{$location->name}}">{{$location->name}}</option>
             @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="title"><i class="fas fa-file-image text-primary"></i> Invoice Image</label>
            <input type="file" class="form-control" name="image" id="location">
          </div>
          </div>
          
          </div>
          <div class="row">
            <div class="col-12">
              <div class="">
                <label for="title"><i class="fa fa-file text-primary"></i> Comments</label>
                <div style="width: 200px;">
                <textarea name="comments" id="comments" width="200" rows="6" cols="50"></textarea>
                </div>
              </div>
            </div>
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

  <table border="0" cellspacing="5" cellpadding="5" style="padding-top: 40px">
    <tbody><tr>
                <td> Filter Data by Task Date</td>
                  <td style="font-size: 175%;"><i class="fa fa-calendar text-primary" aria-hidden="true"></i></td>
                  <td>
                    
                    <input type="text" autocomplete="off" id="min" name="min" class="form-control form-control-sm min">
                  </td>
                  </div>
                </div>
                  <td style="font-size: 175%;"><i class="fa fa-calendar text-primary" aria-hidden="true"></i></td>
                  <td><input type="text" autocomplete="off" id="max" name="max" class="form-control form-control-sm min"></td>
        </tr>
</tbody>
</table>




    <div class="table-responsive-sm">
    <table id="examples" class="table table-striped table-bordered">
      <thead>
          <tr>
            <th >S.No</th>
            <th >INV.No</th>
            <th>Vehicle</th>
            <th>Client</th>
            <th class="text-center">Total(Rwf)</th>
            <th>Service</th>
            <th class="text-center">Odometer Reading(Km)</th>
            <th class="text-center">Fuel(L)</th>
           <th >Service Date</th>
            <th>Location</th>
            <th>Action</th>
            
            
          </tr>
      </thead>
      <tbody>
        @foreach($entries as $entry)
          <tr>
            <td style="text-align:center;width: 50px;">{{$entry->id}}</td>
            <td style="width: 50px;">{{$entry->invoice_number}}</td>
            <td >{{$entry->vehicle}}</td>
            <td>{{$entry->client}}</td>
            <td class="text-center">{{number_format($entry->amount)}}</td>
            <td>{{$entry->service}}</td>
            <td class="text-center">{{number_format($entry->odometer_reading)}}</td>
            <td class="text-center">{{$entry->fuel}}</td>
            <td >{{$entry->service_date}}</td>
            <td >{{$entry->location}}</td>
            {{-- <td ><a href="public/images/{{$entry->image}}" target="_blank">{{$entry->image}}</a> </td>
            <td > <a href="public/files/{{$entry->file}}" target="_blank">{{$entry->file}}</a> </td> --}}
            <td style="text-align: center; width:10%;"> 
              <button style=" width:40%;" class=" btn-primary-outline" data-myvehicle="{{$entry->vehicle}}" data-myclient="{{$entry->client}}" data-myamount="{{$entry->amount}}" data-myservice="{{$entry->service}}" data-myservice_date="{{$entry->service_date}}" data-myodometer_reading="{{$entry->odometer_reading}}" data-myfuel="{{$entry->fuel}}" data-mylocation="{{$entry->location}}" data-mydriver="{{$entry->driver}}" data-catid={{$entry->id}} data-myimage="{{$entry->image}}" data-myfile="{{$entry->file}}" data-mycomments="{{$entry->comments}}"  data-toggle="modal" data-target="#edit" ><i class="fa fa-edit text-success" style="font-size:12px"></i></button>
              
              <button style="width:40%;" class=" btn-primary-outline" data-catid={{$entry->id}} data-toggle="modal" data-target="#delete"><i class="fa fa-trash text-danger" style="font-size:12px"></i></button> 
            
            </td>
            
              
          </tr>
          @endforeach
  </table> 
</div>

   


           
      




              </div>  
            </div>    
          </div>      
        </div> 
      </div>       
      </div>
    </section>



                  {{-- delete --}}
    <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
      </div>
      <form action="{{route('entries.destroy','test')}}" method="post">
          {{method_field('delete')}}
          {{csrf_field()}}
        <div class="modal-body">
        <p class="text-center">
          Are you sure you want to delete this?
        </p>
            <input type="hidden" name="entry_id" id="cat_id" value="">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
          <button type="submit" class="btn btn-warning">Yes, Delete</button>
        </div>
      </form>
    </div>
    </div>
    </div>

    {{-- edit --}}
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
    
            <h4 class="modal-title" id="myModalLabel">Edit Entry</h4>
          </div>
          <form action="{{route('entries.update','test')}}" method="post">
            {{method_field('patch')}}
            {{csrf_field()}}
          <div class="modal-body">
             <input type="hidden" name="entry_id" id="cat_id" value="">
             <div class="row"><div  class="col-5">
              <div class="form-group">
                <label for="client"><i class="fas fa-user-shield text-primary"></i> Client</label>
                <select class="form-control" name="client" id="client">
                  <!-- <option disabled="" selected="">Choose Option</option> -->
              
                  <option value="{{$clients->name}}">{{$clients->name}}</option>
              
                </select>
              </div>
              <div class="form-group">
                <label for="Type"><i class="fa fa-car text-primary"></i> Vehicle</label>
                <select class="form-control" name="vehicle" id="vehicle">
                  <option disabled="" selected="">Choose Option</option>
                  @foreach($vehicles as $vehicle)
                  <option value="{{$vehicle->plate}}"> {{$vehicle->plate}}</option>
                  @endforeach
                </select>
              </div>
  
              <div class="form-group">
                <label for="title"><i class="fa fa-tasks text-primary"></i> Service</label>
                <select class="form-control" name="service" id="service">
                  <option disabled="" selected="">Choose Option</option>
                  @foreach($services as $service)
                  <option value="{{$service->name}}">{{$service->name}}</option>
                 @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="title"><i class="fa fa-gas-pump text-primary"></i> Fuel(l)</label>
                <input type="text" class="form-control" name="fuel" id="fuel" placeholder="Fuel(L)">
              </div>
              <div class="form-group">
                <label for="title"><i class="fas fa-hdd text-primary"></i> Driver</label>
                <input type="text" class="form-control" name="driver" id="driver" placeholder="Driver">
              </div>
              <div class="form-group">
                <label for="title"><i class="fa fa-file text-primary"></i> File</label>
                <input type="file" class="form-control" name="file" id="">
              </div>
              </div>
             <div  class="col-7">
              <div class="form-group">
               <label for="title"><i class="fas fa-tachometer-alt text-primary"></i> Odometer Reading(km)</label>
                <input type="text" class="form-control" name="odometer_reading" id="odometer_reading" placeholder="">
              </div>
              <div class="form-group">
                <label for="title"><i class="fa fa-calendar text-primary"></i> Service Date</label>
                <input type="date" class="form-control" name="service_date" id="service_date">
              </div>
              <div class="form-group">
                <label for="title"><i class="fa fa-money-bill text-primary"></i>  Amount</label>
                <input type="text" class="form-control" name="amount" id="amount">
              </div>
              <div class="form-group">
                <label for="title"><i class="fas fa-sort-numeric-down text-primary"></i> Invoice Number</label>
                <input type="text" class="form-control" name="invoice_number" id="amount">
              </div>
              <div class="form-group">
                <label for="title"><i class="fa fa-map-marker text-primary"></i> Location</label>
                <select class="form-control" name="location" id="location">
                  <option disabled="" selected="">Choose Option</option>
                  @foreach($locations as $location)
                  <option value="{{$location->name}}">{{$location->name}}</option>
                 @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="title"><i class="fas fa-file-image text-primary"></i> Invoice Image</label>
                <input type="file" class="form-control" name="image" id="">
              </div>

              </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="">
                    <label for="title"><i class="fa fa-file text-primary"></i> Comments</label>
                    <div style="width: 200px;">
                    <textarea name="comments" id="comments" width="200" rows="6" cols="50"></textarea>
                    </div>
                  </div>
                </div>
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

    

    
    <script src="{{asset('script.js')}}"></script>
   
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script> 

    <script>
  
   
  $('#edit').on('show.bs.modal', function (event) {
      
      var button = $(event.relatedTarget) 
      var client = button.data('myclient') 
      var vehicle = button.data('myvehicle') 
      var service = button.data('myservice')
      var amount = button.data('myamount') 
      var location = button.data('mylocation')
      var service_date = button.data('myservice_date')
      var odometer_reading = button.data('myodometer_reading')
      var fuel = button.data('myfuel')
      var location = button.data('mylocation')
      var comments = button.data('mycomments')
      var driver = button.data('mydriver')
      var cat_id = button.data('catid') 
      var modal = $(this)
      console.log(client);
      modal.find('.modal-body #client').val(client);
      modal.find('.modal-body #vehicle').val(vehicle);
      modal.find('.modal-body #service').val(service);
      modal.find('.modal-body #amount').val(amount);
      modal.find('.modal-body #location').val(location);
      modal.find('.modal-body #service_date').val(service_date);
      modal.find('.modal-body #odometer_reading').val(odometer_reading);
      modal.find('.modal-body #fuel').val(fuel);
      modal.find('.modal-body #location').val(location);
      modal.find('.modal-body #comments').val(comments);
      modal.find('.modal-body #driver').val(driver);
      modal.find('.modal-body #cat_id').val(cat_id);
})
  $('#delete').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var cat_id = button.data('catid') 
      var modal = $(this)
      modal.find('.modal-body #cat_id').val(cat_id);
})
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/
jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
   
<script >
  $(document).ready(function() {
  // Setup - add a text input to each footer cell
  $('#examples thead tr').clone(true).appendTo( '#examples thead' );
  $('#examples thead tr:eq(0) th').each( function (i) {
      var title = $(this).text();
      $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
         
      $( 'input', this ).on( 'keyup change', function () {
          if ( table.column(i).search() !== this.value ) {
              table
                  .column(i)
                  .search( this.value )
                  .draw();
          }
      } );
  } );



  var table = $('#examples').DataTable( {
       
fixedHeader: true,
      dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
  "<'row'<'col-sm-12'tr>>" +
  "<'row'<'col-sm-5'i><'col-sm-7'p>>",
       buttons: [
           'copy', 'csv', 'excel', 'pdf', 'print'
       ],
       "lengthMenu": [ [ 25, 50,75, -1], [ 25, 50,75, "All"] ],
       "order":[[0,"desc"]]

  } );

 
  

      $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            var min = $('.min').datepicker("getDate");
            var max = $('#max').datepicker("getDate");
            var startDate = new Date(data[8]);
            if (min == null && max == null) {
               return true;
               }
            if (min == null && startDate <= max) { 
              return true;
            }
            if(max == null && startDate >= min) {
              return true;
            }
            if (startDate <= max && startDate >= min) {
               return true;
               }
            return false;
        }
        );

       
            $("#min").datepicker({
               onSelect: function () {
                  table.draw(); 
                },
                 changeMonth: true,
                  changeYear: true 
                });
            $("#max").datepicker({ 
              onSelect: function () {
                 table.draw(); 
                }, 
                changeMonth: true,
                 changeYear: true
                 });
            var table = $('#examples').DataTable();

            // Event listener to the two range filtering inputs to redraw on input
            $('#min, #max').change(function () {
                table.draw();
            });
        
            

} );
</script>

@endsection
@endif




















