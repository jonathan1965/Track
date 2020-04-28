@extends('layouts.app')
@section('content')
<section style="padding-left: 60px; padding-top: 80px;  background: #EEEEEE;">
  <div class="container-fluid">
    <h3 class="text-muted text-center mb-3">Report</h3>
    <div class="row mb-12">
      <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
        <table id="examples">
          <div class="row">
            <div class="col-md-3 mb-xl-0">
              <div class="form-group">
                <label for="client"><i class="fas fa-user-shield text-primary"></i> Client</label>
                <select class="form-control" name="client" id="client">
                  
                  <option value="" selected disabled>Choose Client</option>
                  @if (Auth::user()->usertype == 'admin')
                   @foreach ($clients as $client)
                      <option value="{{$client->name}}">{{$client->name}}</option>
                  @endforeach
                  @else
                  <option value="{{$clients->name}}">{{$clients->name}}</option> 
                 @endif
                </select>
              </div>
              <div class="form-group">
                <label for="title"><i class="fa fa-calendar text-primary"></i> From Date</label>
                <input type="text" autocomplete="off" class="form-control" id="min" name="min">
              </div>
              <div class="form-group">
                <label for="title"><i class="fa fa-calendar text-primary"></i> To Date</label>
                <input type="text" autocomplete="off" class="form-control" id="max" name="max">
              </div>
              <div>
                <button id="filter-button" class="btn btn-success btn-block">Filter</button>
              </div>
            </div>
            <div class="col-md-2  mb-xl-0">
              <div class="form-group">
                <label for="client"><i class="fas fa-user-shield text-primary"></i> Vehicles</label>
                <select class="form-control" name="vehicle" id="vehicle" multiple>


                </select>
              </div>
            </div>
            <div class="col-md-2  mb-xl-0">
              <div class="form-group">
                <label for="client"><i class="fas fa-user-shield text-primary"></i> Selected Vehicle</label>
                <select class="form-control" name="s_vehicle" id="s_vehicle" multiple>


                </select>
              </div>
            </div>
            <div class="col-md-2  mb-xl-0">
              <div class="form-group">
                <label for="client"><i class="fas fa-user-shield text-primary"></i>Services</label>
                <select class="form-control" name="service" id="service" multiple>



                </select>
              </div>
            </div>
            <div class="col-md-2  mb-xl-0">
              <div class="form-group">
                <label for="client"><i class="fas fa-user-shield text-primary"></i> Selected Services</label>
                <select class="form-control" name="s_service" id="s_service" multiple>


                </select>
              </div>
            </div>
          </div>
        </table>
        <div style="width:800px; height:500px">
          <canvas id="myChart"></canvas>
        </div>

      </div>

    </div>
  </div>



  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"
    integrity="sha256-qSIshlknROr4J8GMHRlW3fGKrPki733tLq+qeMCR05Q=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"
    integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"
    integrity="sha256-arMsf+3JJK2LoTGqxfnuJPFTU4hAK57MtIPdFpiHXOU=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
    integrity="sha256-Uv9BNBucvCPipKQ2NS9wYpJmi8DTOEfTA/nH2aoJALw=" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
    integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous">
  </script>
  <script src="{{asset('script.js')}}"></script>
  <script type="text/javascript">
    let selectedPlate = null;

    function searchVehicle() {
      var client = jQuery('select[name="client"]').val();
      var startingDate = $('#min').val();
      var endingDate = $('#max').val();

      if (client) {
        jQuery.ajax({
          url: 'getVehicles/' + client,
          type: "GET",
          data: {
            startingDate: startingDate,
            endingDate: endingDate
          },
          dataType: "json",
          success: function (data) {
            console.log(data);
            jQuery('select[name="vehicle"]').empty();
            jQuery('select[name="s_vehicle"]').empty();
            jQuery('select[name="service"]').empty();
            jQuery('select[name="s_service"]').empty();
            jQuery.each(data, function (key, value) {
              $('select[name="vehicle"]').append('<option value="' + key + '">' + key + '</option>');
            });
          }
        });
      } else {
        jQuery('select[name="vehicle"]').empty();
        jQuery('select[name="s_vehicle"]').empty();
        jQuery('select[name="service"]').empty();
        jQuery('select[name="s_service"]').empty();
      }
    }

    jQuery(document).ready(function () {
      jQuery('select[name="client"]').on('change', function () {
        searchVehicle();
      });

      jQuery('#filter-button').on('click', function () {
        searchVehicle();
      });

      jQuery('select[name="vehicle"]').on('change', function () {
        var plate = selectedPlate = jQuery(this).val();
        if (plate) {
          var startingDate = $('#min').val();
          var endingDate = $('#max').val();
          jQuery.ajax({
            url: 'getEntries/' + plate,
            type: "GET",
            data: {
              startingDate: startingDate,
              endingDate: endingDate
            },
            dataType: "json",
            success: function (data) {

              console.log(plate);
              jQuery('select[name="service"]').empty();
              jQuery('select[name="s_service"]').empty();
              jQuery.each(data, function (key, value) {
                $('select[name="service"]').append('<option value="' + key + '">' + key +
                  '</option>');
              });
            }
          });
        } else {
          $('select[name="service"]').empty();
          jQuery('select[name="s_service"]').empty();
        }
      });

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
          if (max == null && startDate >= min) {
            return true;
          }
          if (startDate <= max && startDate >= min) {
            return true;
          }
          return false;
        }
      );


      $("#min").datepicker({
        changeMonth: true,
        changeYear: true
      });
      $("#max").datepicker({
        changeMonth: true,
        changeYear: true
      });
      var table = $('#examples').DataTable();

      // Event listener to the two range filtering inputs to redraw on input
      $('#min, #max').change(function () {
        table.draw();
      });



    });
  </script>
  <script>
    $(document).ready(function () {
      $('table.display').DataTable();
    });

    // function selectListener(id){
    //       $('#'+id).change(function() {
    //        let select = $('#s_'+id);
    //        let list =  $(this).val();
    //         select.empty();
    //         list.forEach(element => {
    //           select.append($('<option>', {
    //             value: element,
    //             text: element
    //           }))

    //          });
    //          select.val(list);
    //       });
    //     }

    //     selectListener('vehicle');
    //     selectListener('service');
  </script>
  <script>
    function selectListener(id) {
      $('#' + id).change(function () {
        let select = $('#s_' + id);
        let list = $(this).val();
        select.empty();
        list.forEach(element => {
          select.append($('<option>', {
            value: element,
            text: element
          }))

        });
        select.val(list);
      });
    }

    function chartListener(id) {
      $('#' + id).change(function () {
        let services = $(this).val();
        updateChart(selectedPlate, services);
      });
    }

    function updateChart(id, data) {
      var startingDate = $('#min').val();
      var endingDate = $('#max').val();
      jQuery.ajax({
        url: 'getChartData/' + id,
        type: "GET",
        data: {
          services: data,
          startingDate: startingDate,
          endingDate: endingDate
        },
        dataType: "json",
        success: function (data) {
          var ctx = document.getElementById('myChart').getContext('2d');
          let services = data.map((item, index) => {
            return item.service
          });
          let values = data.map((item, index) => {
            return item.totalAmount
          });

          var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
              labels: services,
              datasets: [{
                label: '# of Votes',
                data: values,
                backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',


                  'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(75, 192, 192, 1)'

                ],
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                yAxes: [{
                  ticks: {
                    min: 1000,
                    max: 10000,
                    stepSize: 1000,

                  }
                }]
              }
            }
          });
        }
      });
    }

    selectListener('vehicle');
    selectListener('service');
    chartListener('service');
  </script>

  @endsection