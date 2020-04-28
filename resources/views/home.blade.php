<?php
use App\Vehicle;
use App\Service;
use App\Client;
use App\Task;
use App\Entry;
  
?>
{{-- @if(Auth::user()->usertype == 'admin' || 'user') --}}
@extends('layouts.app')
@section('content')
<div class="modal fade" id="sign-out">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Want to leave?</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            Press logout to leave
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Stay Here</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Logout</button>
          </div>
        </div>
      </div>
    </div>
    <!-- end of modal -->

    <!-- cards -->
    <section>
      <div class="container-fluid"  style="background: #EEEEEE;">
        <div class="row" style="background: #EEEEEE;">
          <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
            <div class="row pt-md-5 mt-md-3 mb-5">
              <div class="col-xl-3 col-sm-6 p-2">
                <a href="/vehicles" style="text-decoration: none;"><div class="card card-common">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <i class="fas fa-car fa-3x text-success"></i>
                      <div class="text-right text-secondary">
                        <h5>Total # of<br>Vehicles</h5>
                        <h3><?php echo $vehicles ?></h3>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-secondary">
                    <i class="fas fa-sync mr-3"></i>
                    <span>Updated Now</span>
                  </div>
                </div></a>
              </div>
              <div class="col-xl-3 col-sm-6 p-2">
                <a href="/reminder" style="text-decoration: none;"> <div class="card card-common">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <i class="fas fa-clock fa-3x text-warning"></i>
                      <div class="text-right text-secondary">
                        <h5>Reminders<br>due this week</h5>
                        <h3>{{$remindersDueThisWeek}}</h3>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-secondary">
                    <i class="fas fa-sync mr-3"></i>
                    <span>Updated Now</span>
                  </div>
                </div></a>
              </div>
              @if($userType == 'admin')
              <div class="col-xl-3 col-sm-6 p-2">
                <a href="/clients" style="text-decoration: none;"> <div class="card card-common">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <i class="fas fa-users fa-3x text-info"></i>
                      <div class="text-right text-secondary">
                        <h5>Total #<br>of Clients</h5>
                        <h3><?php echo $clients; ?></h3>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-secondary">
                    <i class="fas fa-sync mr-3"></i>
                    <span>Updated Now</span>
                  </div>
                </div></a>
              </div>
              @else

              <div class="col-xl-3 col-sm-6 p-2">
                <a href="/clients" style="text-decoration: none;"> <div class="card card-common">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <i class="fab fa-servicestack fa-3x"></i>
                      <div class="text-right text-secondary">
                        <h5>Total #<br>of Services</h5>
                        <h3><?php echo $services; ?></h3>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-secondary">
                    <i class="fas fa-sync mr-3"></i>
                    <span>Updated Now</span>
                  </div>
                </div></a>
              </div>

              @endif
              <div class="col-xl-3 col-sm-6 p-2">
                <a href="/task" style="text-decoration: none;">  <div class="card card-common">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <i class="fas fa-chart-line fa-3x text-danger"></i>
                      <div class="text-right text-secondary">
                        <h5>Open<br>Tasks</h5>
                        <h3><?php echo $tasks; ?></h3>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-secondary">
                    <i class="fas fa-sync mr-3"></i>
                    <span>Updated Now</span>
                  </div>
                </div></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- <div id="" style="padding-left: 340px" class="row">
    <table class="col-lg-5">
      <tr>
        <td style="width: 300px !important;"><div id="Sarah_chart_div" style="border: 1px solid #ccc"></div></td>
        <td><div id="Anthony_chart_div" style="border: 1px solid #ccc"></div></td>
      
        <td><div id="piechart_div" style="border: 1px solid #ccc"></div></td>
        <td><div id="barchart_div" style="border: 1px solid #ccc"></div></td>
      </tr>
    </table></div> -->
    <section style="padding-left: 60px;">
      <div class="container-fluid">
        <div class="row" style="background: #EEEEEE; ">
          <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
            <div class="row align-items-center">
              <div class="col-xl-11 col-12 mb-4 mb-xl-0">
                <h3 class="text-muted text-center mb-3">General Report</h3>
                
                <table id="" class="display" style="width:100%" data-page-length="25">
        <thead>
            <tr>
              <th>Serial#</th>
               <th>Client</th>
               <th>Vehicle</th>
               <th>Service</th>
               <th>Amount</th>
               <th>Date</th>
                
                <!-- <th>Total Paid</th>
                <th>Balance</th> -->
                
                
            </tr>
        </thead>
        <tbody>
          @foreach($entries as $entry)
            <tr>
              <td>{{$entry->id}}</td>
               <td>{{$entry->client->name}}</td>
                <td>{{$entry->vehicle->plate}}</td>
                <td>{{$entry->service}}</td>
                <th>{{number_format($entry->amount)}}</th>
                <th>{{$entry->created_at}}</th>
                
                <!-- <td>800,000</td>
                <td>200,000</td> -->
                
                
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

      <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="reminder-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Reminders</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <h2>You have:</h2>
      <h5><b>{{$expiredReminders}} </b> expired reminder(s)</h5>
      
      <h5><b>{{$remindersDueToday}} </b> reminder(s) due today</h5>
      <h5><b>{{$remindersDueThisWeek}}</b>  reminder(s) due this week</h5>
      <h5><b>{{$remindersDueThisMonth}}</b>  reminder(s) due this month</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       <a href="/reminder"> <button type="button" class="btn btn-primary">Go to My Reminders Menu</button></a>
      </div>
    </div>
  </div>
</div>

    </section>
    <!-- end of cards -->

    <!-- tables -->
    
    <!-- end of activities / quick post -->

    <!-- footer -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load Charts and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Draw the pie chart for Sarah's pizza when Charts is loaded.
      google.charts.setOnLoadCallback(drawSarahChart);

      // Draw the pie chart for the Anthony's pizza when Charts is loaded.
      google.charts.setOnLoadCallback(drawAnthonyChart);

      // Callback that draws the pie chart for Sarah's pizza.
      function drawSarahChart() {

        // Create the data table for Sarah's pizza.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Fuel', 1],
          ['Repair', 1],
          ['Maintenance', 2],
          ['Inspection', 2],
          ['Quick Check', 1]
        ]);

        // Set options for Sarah's pie chart.
        var options = {title:'How Much Spent On Service',
                       width:370,
                       height:270};

        // Instantiate and draw the chart for Sarah's pizza.
        var chart = new google.visualization.PieChart(document.getElementById('Sarah_chart_div'));
        chart.draw(data, options);
      }

      // Callback that draws the pie chart for Anthony's pizza.
      function drawAnthonyChart() {

        // Create the data table for Anthony's pizza.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Fuel', 2],
          ['Repair', 2],
          ['Maintenance', 2],
          ['Inspection', 0],
          ['Quick Check', 3]
        ]);

        // Set options for Anthony's pie chart.
        var options = {title:'How Much Spent On Service',
                       width:370,
                       height:270};

        // Instantiate and draw the chart for Anthony's pizza.
        var chart = new google.visualization.PieChart(document.getElementById('Anthony_chart_div'));
        chart.draw(data, options);
      }
    </script>

    <script type="text/javascript">

      // Load Charts and the corechart and barchart packages.
      google.charts.load('current', {'packages':['corechart']});

      // Draw the pie chart and bar chart when Charts is loaded.
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Fuel', 3],
          ['Repair', 1],
          ['Maintenance', 1],
          ['Inspection', 1],
          ['Quick Check', 2]
        ]);

        var piechart_options = {title:'Pie Chart: How Much Spent On Service',
                       width:370,
                       height:270};
        var piechart = new google.visualization.PieChart(document.getElementById('piechart_div'));
        piechart.draw(data, piechart_options);

        var barchart_options = {title:'Barchart: How Much Spent On Service',
                       width:370,
                       height:270,
                       legend: 'none'};
        var barchart = new google.visualization.BarChart(document.getElementById('barchart_div'));
        barchart.draw(data, barchart_options);
      }
</script>
    <!--Div that will hold the pie chart-->

    
    
    <!-- end of footer -->
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
        $('table.display').DataTable();

         
         $('#reminder-modal').modal('show');
        
  
    
    });
</script>
@endsection
{{-- @endif --}}
