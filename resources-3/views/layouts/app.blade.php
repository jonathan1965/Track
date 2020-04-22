<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="title icon" href="images/title-img.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css" integrity="sha256-IvM9nJf/b5l2RoebiFno92E5ONttVyaEEsdemDC6iQA=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" integrity="sha256-aa0xaJgmK/X74WM224KMQeNQC2xYKwlAt08oZqjeF0E=" crossorigin="anonymous" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPOdaFlfXOWngpe2LkFsjuKTkbn9bW90A&libraries=places"></script>
    <title>Service Track</title>
    <style>
        div.dataTables_wrapper {
        margin-bottom: 3em;
        }
        textarea{
            width: 450px;
        }
        thead input {
        width: 120%;
    }
    </style>
  </head>
    <body style="font-size: 12px;">
        
                    @if (Auth::guest())
                        <!--<div class="jumbotron text-center">
                          <h1 class="display-4">TMS</h1>
                          
                          <p class="lead">
                            <a href="{{ url('/login') }}" class="btn btn-primary text-center">Login</a>
                        <a href="{{ url('/register') }}" class="btn btn-success text-center">Register</a>
                          </p>
                        </div>-->
                        
                    @else

                       @include('inc.navbar')
                     
                           <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>-->
                                
                                @include('inc.messages')
                            <!--<ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>-->
                       
                    @endif
              
 @yield('content')
   <!-- <footer class="fixed-bottom">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
            <div class="row border-top pt-3">
              <div class="col-lg-6 text-center">
                <ul class="list-inline">
                  <li class="list-inline-item mr-2">
                    <a href="https://creaxion.rw/" class="text-dark" target="_blank">Service Track</a>
                  </li>
                 
                </ul>
              </div>
              <div class="col-lg-6 text-center">
                <p>&copy; 2019 Copyright. Made by <span class="text-success">Creaxion</span></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer> -->
    </body>
</html>
