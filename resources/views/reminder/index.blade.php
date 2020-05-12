@extends('layouts.app')
@section('content')
		 <section style="padding-left:30px; padding-top: 80px;  height:100vh; background: #EEEEEE;">     
    <div class="row justify-content-center">
      <div class="col-sm-9" style="padding-left: 80px;">
        <h3 class="text-muted text-center mb-3">Reminders</h3>
        <button type="button" class="btn btn-primary btn-gb" data-toggle="modal" data-target="#myModal">Create Reminder</button>
      
        <table class="display table table-bordered " id="example">
       
          <thead>
            
            <tr>
              <th scope="col">Serial<br>number </th>
              <th scope="col">Topic</th>
              <th scope="col">Reminder_By</th>
              <th scope="col">Reminder_to</th>
              <th scope="col">client</th>
              <th scope="col">Vehicle</th> 
              <th scope="col">status</th>
              <th scope="col">created Date</th>
              <th scope="col">Due date</th>
              <th scope="col">odometer</th>
              <th scope="col">action</th>
            </tr>
          </thead>
        
          <tbody>
            
               @foreach ($reminders as $reminder)
                   
              
                <tr @if($reminder->isDue()) style=background:#ef9a9a; @endif> 
                <td>{{$reminder->id}}</td>
                <td>{{$reminder->topic}}</td>
                <td>{{$reminder->reminder_by}}</td>
                <td>{{$reminder->reminder_to}}</td>
                <td>{{$reminder->client->name}}</td>
                <td>{{$reminder->vehicle->plate}}</td>
                <td>{{$reminder->status}}</td>
                <td>{{$reminder->created_at}}</td>
                <td>{{$reminder->due_date}}</td>
                <td>{{number_format($reminder->odometer)}}</td>
                
                <td style="text-align: center; width:10%;"> 
                 
                  <button style=" width:40%;" type="button" class=" btn-primary-outline" data-rem_id='{{$reminder->id}}' data-mytopic='{{$reminder->topic}}'  data-myreminder_by='{{$reminder->reminder_by}}' data-myreminder_to='{{$reminder->reminder_to}}' data-myclient='{{$reminder->client->name}}' data-myvehicle='{{$reminder->vehicle->plate}}' data-mystatus='{{$reminder->status}}' data-mydue_date='{{$reminder->due_date}}' data-myodometer='{{$reminder->odometer}}' data-rem_id='{{$reminder->id}}' data-toggle="modal" data-target="#edit">
                    <i class="fa fa-edit text-success"></i> 
                  </button>
                  
                <button type="button" class=" btn-primary-outline" data-rem_id='{{$reminder->id}}'   data-toggle="modal" data-target="#delete"><i class="fa fa-trash text-danger"></i></button>
                 </td>
                  </tr>  
                @endforeach
          </tbody>
            
       </table>
      
       {{-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
        Create reminder
      </button>  --}}
        </div> 
      </div> 
           

       {{-- create reminder --}}


          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
               
                  <h4 class="modal-title" id="myModalLabel">New Reminder</h4>
                </div>
                <form action="{{route('reminder.store')}}" method="post" >
                    {{csrf_field()}}  
                    <div id="entries_list"></div>
                  <div class="modal-body">
                     <div class="row"><div  class="col-5">
                      <div class="form-group">
                        <label for="title"><i class="fas fa-american-sign-language-interpreting text-primary"></i> Topic</label>
                        <input type="text" class="form-control" name="topic" id="topic" placeholder="Topic">
                      </div>
                      <div class="form-group">
                        <label for="title"><i class="fas fa-stopwatch text-primary"></i> Reminder By</label>
                        <input type="text" class="form-control" name="reminder_by" id="reminder_by" placeholder="reminder_by" value="{{ Auth::user()->name }}"  >
                      </div>
                      <div class="form-group">
                        <label for="client"><i class="fas fa-user-clock text-primary"></i> Reminder To</label>
                        <select class="form-control" name="reminder_to" id="reminder_to">
                          <option disabled="" selected="">Choose Option</option>
                          @foreach($users as $user)
                        <option value="{{$user->name}}">{{$user->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="client"><i class="fas fa-user-shield text-primary"></i> Client</label>
                        <select class="form-control" name="client" id="client">
                            @if (Auth::user()->usertype == 'admin')
                            @foreach($client as $clients)
                            <option value="{{$clients->name}}">{{$clients->name}}</option>
                            @endforeach
                            @else
                            <option value="{{$client->name}}"> {{$client->name}}</option>
                            @endif
                        </select>
                      </div>
                      </div>
   
                     <div  class="col-7">

                      <div class="form-group">
                        <label for="Type"><i class="fa fa-car text-primary"></i> Vehicle</label>
                        <select class="form-control" name="vehicle" id="vehicle">
                          <option disabled="" selected="">Choose Option</option>
                          @foreach($vehicles as $vehicle)
                        <option value="{{$vehicle->plate}}">{{$vehicle->plate}}</option>
                          @endforeach 
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="client"><i class="fas fa-toggle-on text-primary"></i> Status</label>
                        <select class="form-control" name="status" id="status">
                          <option disabled="" selected="">Choose Option</option>           
                        <option value="open">Open</option>
                        <option value="closed">Closed</option>
              
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="title"><i class="fa fa-calendar text-primary"></i> Due Date</label>
                        <input type="date" class="form-control" name="due_date" id="due_date">
                      </div>
                      
                      <div class="form-group">
                        <label for="title"><i class="fas fa-tachometer-alt text-primary"></i> Odometer</label>
                        <input type="text" class="form-control" name="odometer" id="odometer" placeholder="Odometer">
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
       
       {{-- Edit reminderj --}}


       <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
           
              <h4 class="modal-title" id="myModalLabel">Edit Reminder</h4>
            </div>
            <form action="{{route('reminder.update','test')}}" method="post" >
              {{method_field('patch')}}
                {{csrf_field()}}  
                
              <div class="modal-body">
                <input type="hidden" name="rem_id" id="rem_id" value="">
                 <div class="row"><div  class="col-5">
                  <div class="form-group">
                    <label for="title"><i class="fas fa-american-sign-language-interpreting text-primary"></i> Topic</label>
                    <input type="text" class="form-control" name="topic" id="topic" placeholder="Topic">
                  </div>
                  <div class="form-group">
                    <label for="title"><i class="fas fa-stopwatch text-primary"></i> Reminder By</label>
                    <input type="text" class="form-control" name="reminder_by" id="reminder_by" placeholder="reminder_by">
                  </div>
                  <div class="form-group">
                    <label for="client"><i class="fas fa-user-clock text-primary"></i> Reminder To</label>
                    <select class="form-control" name="reminder_to" id="reminder_to">
                      <option disabled="" selected="">Choose Option</option>
                      @foreach($users as $user)
                    <option value="{{$user->name}}">{{$user->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="client"><i class="fas fa-user-shield text-primary"></i> Client</label>
                    <select class="form-control" name="client" id="client">
                      @if (Auth::user()->usertype == 'admin')
                      @foreach($client as $clients)
                      <option value="{{$clients->name}}">{{$clients->name}}</option>
                      @endforeach
                      @else
                      <option value="{{$client->name}}"> {{$client->name}}</option>
                      @endif
                  </select>
                  </div>
                  </div>

                      {{-- next lap  --}}
                 <div  class="col-7">

                  <div class="form-group">
                    <label for="Type"><i class="fa fa-car text-primary"></i> Vehicle</label>
                    <select class="form-control" name="vehicle" id="vehicle">
                      <option disabled="" selected="">Choose Option</option>
                      @foreach($vehicles as $vehicle)
                    <option value="{{$vehicle->plate}}">{{$vehicle->plate}}</option>
                      @endforeach 
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="client"><i class="fas fa-toggle-on text-primary"></i> Status</label>
                    <select class="form-control" name="status" id="status">
                      <option disabled="" selected="">Choose Option</option>           
                    <option value="open">Open</option>
                    <option value="closed">Closed</option>
          
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="title"><i class="fa fa-calendar text-primary"></i> Due Date</label>
                    <input type="date" class="form-control" name="due_date" id="due_date">
                  </div>
                  
                  <div class="form-group">
                    <label for="title"><i class="fas fa-tachometer-alt text-primary"></i> Odometer</label>
                    <input type="text" class="form-control" name="odometer" id="odometer" placeholder="Odometer">
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
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->


      {{-- Delete Reminder --}}

      <div class="modal  fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" >
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <form action="{{route('reminder.destroy','test')}}" method="post">
                {{method_field('delete')}}
                {{csrf_field()}}
              <div class="modal-body" style="background:#f7c3c3">
              <p class="text-center">
               <b> Are you sure you want to delete this?</b> 
              </p>
                  <input type="hidden" name="rem_id" id="rem_id" value="">
      
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
                <button type="submit" class="btn btn-warning">Yes, Delete</button>
              </div>
            </form>
          </div>
        </div>
      </div>
   
    
    </section>  
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js" integrity="sha256-qSIshlknROr4J8GMHRlW3fGKrPki733tLq+qeMCR05Q=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js" integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js" integrity="sha256-arMsf+3JJK2LoTGqxfnuJPFTU4hAK57MtIPdFpiHXOU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" integrity="sha256-Uv9BNBucvCPipKQ2NS9wYpJmi8DTOEfTA/nH2aoJALw=" crossorigin="anonymous"></script>

    
   
 

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('script.js')}}"></script>
    <script>
       $('#edit').on('show.bs.modal', function (event) {
        
        var button = $(event.relatedTarget) 
        var topic = button.data('mytopic')
        var reminder_by = button.data('myreminder_by')
        var reminder_to = button.data('myreminder_to')
        var client = button.data('myclient')
        var vehicle = button.data('myvehicle')
        var status = button.data('mystatus')
        var due_date = button.data('mydue_date')
        var odometer = button.data('myodometer')
        var type = button.data('rem_ideee') 
        var id = button.data('rem_id')
        var modal = $(this)
      
         modal.find('.modal-body #topic').val(topic);
         modal.find('.modal-body #reminder_by').val(reminder_by);
         modal.find('.modal-body #reminder_to').val(reminder_to);
         modal.find('.modal-body #client').val(client);
         modal.find('.modal-body #vehicle').val(vehicle);

         modal.find('.modal-body #status').val(status);
         modal.find('.modal-body #due_date').val(due_date);
         modal.find('.modal-body #odometer').val(odometer);


         modal.find('.modal-body #rem_id').val(id);
         modal.find('.modal-body #remtype').val(type);
          console.log(odometer)
      })


      $('#delete').on('show.bs.modal', function (event) {
        
        var button = $(event.relatedTarget) 
   
        var name1 = button.data('myname') 
        var type = button.data('rem_id') 
        var id = button.data('rem_id')
        var modal = $(this)

         modal.find('.modal-body #rem_id').val(id);
        
          console.log(type)
      })
      
    </script>
    <script>
      $(document).ready(function() {
          $('table.display').DataTable({
            "order": [[ 8, "desc" ]]
       } );
       jQuery('select[name="client"]').on('change',function(){
               var clientID = jQuery(this).val();
               if(clientID)
               {
                  jQuery.ajax({
                     url : 'getVehicles/' +clientID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="vehicle"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="vehicle"]').append('<option value="'+ key +'">'+ key +''+ '</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="vehicle"]').empty();
               }
            });
      
      } );
    </script>
    <script>
        
            
     
    </script>
@endsection
