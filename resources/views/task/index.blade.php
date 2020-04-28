
@extends('layouts.app')
@section('content')
		<section style="padding-left: 60px; padding-top: 80px; height: 100vh; background: #EEEEEE;">
      <div class="container-fluid" style="background: #EEEEEE;">
        <div class="row mb-12">
          <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
            <div class="row align-items-center">
              <div class="col-xl-11 col-12 mb-4 mb-xl-0">
                <h3 class="text-muted text-center mb-3">Task</h3>
                <button type="button" class="btn btn-primary btn-gb" data-toggle="modal" data-target="#myModal">Create Task</button>
                

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

{{-- create --}}


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
     
        <h4 class="modal-title" id="myModalLabel">New Task</h4>
      </div>
      <form action="{{route('task.store')}}" method="post" >
          {{csrf_field()}}  
          <div id="entries_list"></div>
        <div class="modal-body">
           <div class="row"><div  class="col-5">
            <div class="form-group">
              <label for="task"><i class="fa fa-outdent text-primary"></i> Task</label>
              <input type="text" class="form-control" name="task" id="task" placeholder="task">
            </div>
            <div class="form-group">
              <label for="title"><i class="fa fa-user text-primary"></i> Requested By</label>
              <input type="text" class="form-control" name="requested_by" id="requested_by" placeholder="requested_by" value="{{ Auth::user()->name }}">
            </div>
            <div class="form-group">
              <label for="requested_to"><i class="fa fa-user text-primary"></i> Requested_to</label>
              <select class="form-control" name="requested_to" id="requested_to">
                <option disabled="" selected="">Choose Option</option>
                
               @foreach ($users as $user)
                <option value="{{$user->name}}">{{$user->name}}</option>  
                @endforeach                 
              
              </select>
            </div>
            <div class="form-group">
              <label for="Type"><i class="fa fa-car text-primary"></i> Vehicle</label>
              <select class="form-control" name="vehicles" id="vehicles">
                <option disabled="" selected="">Choose Option</option>
                 @foreach ($vehicles as $vehicle)
                <option value="{{$vehicle->plate}}">{{$vehicle->plate}}</option>  
                @endforeach                 
              
              </select>
            </div>

            </div>  
           <div  class="col-7">
            
            <div class="form-group">
              <label for="title"><i class="fa fa-calendar text-primary"></i> due Date</label>
              <input type="date" class="form-control" name="due_date" id="due_date">
            </div>
            <div class="form-group">
              <label for="title"><i class="fa fa-calendar text-primary"></i> close Date</label>
              <input type="date" class="form-control" name="closed_date" id="closed_date">
            </div>
            
            <div class="form-group">
              <label for="client"><i class="fas fa-toggle-on text-primary"></i> Status</label>
              <select class="form-control" name="status" id="status">
                <option disabled="" selected="">Choose Option</option>           
              <option value="open">Open</option>
              <option value="closed">Closed</option>
    
              </select>
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
                

<div class="table-responsive-sm">
  <table id="examples" class="display" class="table table-striped table-bordered">
    <thead>
        <tr>
          <th class="text-center">S.No</th>
          <th class="text-center">Task</th>
          <th class="text-center">Requested BY</th>
          <th class="text-center">Requested To</th>
          <th class="text-center">Vehicles</th>
          <th class="text-center">Due Date</th>
          <th class="text-center">Closed Date</th>
          <th class="text-center">Action</th>
          <th class="text-center">Flag Status</th>
          
        </tr>
    </thead>
    <tbody>
      @foreach ($tasks as $task)
          
      
        <tr>
          
          <td style="text-align:center;width: 50px;">{{$task->id}}</td>
          <td style="width: 50px;">{{$task->task}}</td>
          <td class="text-center">{{$task->requested_by}}</td>
          <td class="text-center">{{$task->requested_to}}</td>
          <td class="text-center">{{$task->vehicle->plate}}</td>
          <td class="text-center">{{$task->due_date}}</td>
          <td class="text-center">{{$task->closed_date}}</td>
          
          <td style="text-align: center; width:10%;"> 
            <button style=" width:40%;" class=" btn-primary-outline"  data-toggle="modal" data-target="#edit" data-task_id={{$task->id}} data-mytask="{{$task->task}}" data-myrequested_by="{{$task->requested_by}}" data-myrequested_to="{{$task->requested_to}}" data-myvehicles="{{$task->vehicle->plate}}" data-mydue_date="{{$task->due_date}}" data-myclosed_date="{{$task->closed_date}}" data-mystatus="{{$task->status}}"><i class="fa fa-edit text-success" style="font-size:12px"></i></button>
            
            <button style="width:40%;" class=" btn-primary-outline" data-task_id={{$task->id}} data-toggle="modal"  data-target="#delete"><i class="fa fa-trash text-danger" style="font-size:12px"></i></button> 
          
          </td> 
          @if($task->status == 'open')
            <td class="text-center">
              <i class="fas fa-asterisk text-danger h6"></i>
            </td>
          @elseif($task->status == 'closed')
          <td class="text-center">
           <i class="fas fa-asterisk text-success h6"></i>
          </td>
          @else
          <td class="text-center">
            <i class="fas fa-asterisk text-muted h6"></i>
          </td>
         @endif 
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
    </section>
    <!-- Delete Modal -->
    <div class="modal  fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
      </div>
      <form action="{{route('task.destroy','test')}}" method="post">
           {{method_field('delete')}}
          {{csrf_field()}}
        <div class="modal-body">
        <p class="text-center">
          Are you sure you want to delete this?
        </p>
            <input type="hidden" name="task_id" id="task_id" value="">

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
   {{-- Edit reminderj --}}


   <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
       
          <h4 class="modal-title" id="myModalLabel">Edit Task</h4>
        </div>
        <form action="{{route('task.update','test')}}" method="post" >
          {{method_field('patch')}}
            {{csrf_field()}}
            
          <div class="modal-body">
            <input type="hidden" name="task_id" id="task_id" value="">
             <div class="row">
               <div  class="col-5">
              <div class="form-group">
                <label for="task"><i class="fa fa-outdent text-primary"></i> Task</label>
                <input type="text" class="form-control" name="task" id="task" placeholder="task">
              </div>
              <div class="form-group">
                <label for="requested_by"><i class="fa fa-user text-primary"></i> Requested By</label>
                <input type="text" class="form-control" name="requested_by" id="requested_by" placeholder="Requested By">
              </div>
              <div class="form-group">
                <label for="requested_to"><i class="fa fa-user text-primary"></i> Requested To</label>
                <select class="form-control" name="requested_to" id="requested_to">
                  <option disabled="" selected="">Choose Option</option>
                  @foreach ($users as $user)
                  <option value="{{$user->name}}">{{$user->name}}</option>  
                  @endforeach                
                
                </select>
              </div>
              <div class="form-group">
                <label for="Type"><i class="fa fa-car text-primary"></i> Vehicle</label>
                <select class="form-control" name="vehicles" id="vehicles">
                  <option disabled="" selected="">Choose Option</option>
                  @foreach ($vehicles as $vehicle)vehicles
                  <option value="{{$vehicle->plate}}">{{$vehicle->plate}}</option>  
                  @endforeach                
                
                </select>
              </div>
              
              </div>

                  {{-- next lap  --}}
             <div  class="col-7">
              <div class="form-group">
                <label for="title"><i class="fa fa-calendar text-primary"></i> due Date</label>
                <input type="date" class="form-control" name="due_date" id="due_date">
              </div>
              <div class="form-group">
                <label for="title"><i class="fa fa-calendar text-primary"></i> Closed Date</label>
                <input type="date" class="form-control" name="closed_date" id="closed_date">
              </div>
              <div class="form-group">
                <label for="client"><i class="fas fa-toggle-on text-primary"></i> Status</label>
              <select class="form-control" name="status" id="status">
                <option disabled="" selected="">Choose Option</option>           
              <option value="open">Open</option>
              <option value="closed">Closed</option>
    
              </select>
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
      var task = button.data('mytask')
      var requested_by = button.data('myrequested_by')
      var requested_to = button.data('myrequested_to')
      var vehicles = button.data('myvehicles')
      var due_date = button.data('mydue_date') 
      var closed_date = button.data('myclosed_date') 
      var status = button.data('mystatus') 
     
      var task_id = button.data('task_id') 
      var modal = $(this)
      console.log(requested_to);
      modal.find('.modal-body #task').val(task);
      modal.find('.modal-body #requested_by').val(requested_by);
      modal.find('.modal-body #requested_to').val(requested_to);
      modal.find('.modal-body #vehicles').val(vehicles);
      modal.find('.modal-body #due_date').val(due_date);
      modal.find('.modal-body #closed_date').val(closed_date);
      modal.find('.modal-body #status').val(status);
      modal.find('.modal-body #task_id').val(task_id);
})
  $('#delete').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var task_id = button.data('task_id') 
      var modal = $(this)
      modal.find('.modal-body #task_id').val(task_id);
})
</script>
    <script>
      $(document).ready(function() {
    $('table.display').DataTable({
      "order":[[0,"desc"]]
    });
} );
    </script>
   
@endsection
