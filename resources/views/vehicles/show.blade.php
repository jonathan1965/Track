
@extends('layouts.app')
@include('inc.navbar')
@include('inc.messages')
@section('content')
		<section style="padding-left: 60px; padding-top: 80px; height: 100vh; background: #EEEEEE;">
      <div class="container-fluid">
        <div class="row mb-12">
          <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
            <div class="row align-items-center">
              <div class="col-xl-11 col-12 mb-4 mb-xl-0">
                <h3 class="text-muted text-center mb-3">Task</h3>
                <button type="button" class="btn btn-info btn-gb" data-toggle="modal" data-target="#myModal">Create Task</button>
                

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
          {{-- <td ><a href="public/images/{{$entry->image}}" target="_blank">{{$entry->image}}</a> </td>
          <td > <a href="public/files/{{$entry->file}}" target="_blank">{{$entry->file}}</a> </td> --}}
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
      $(document).ready(function() {
    $('table.display').DataTable({
      "order":[[0,"desc"]]
    });
} );
    </script>
   
@endsection
