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
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js">
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"> 
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"> 
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.bootstrap4.min.css">
    
  
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">

    
 

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
    <body style="font-size:12px;"  class=" {{ Request::path() == 'login' ? 'background-image' : '' }}">
        
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
 @if( Request::path()=='login')
   {{-- <footer class="fixed-bottom ft-danger">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-10 col-lg-9 col-md-8 ml-auto">
            <div class="row border-top pt-3">
              <div class="col-lg-6 text-center">
                <ul class="list-inline">
                  <li class="list-inline-item mr-2">
                    <a href="https://creaxion.rw/" class="text-dark" target="_blank"><strong>Service Track</strong></a>
                  </li>
                 
                </ul>
              </div>
              
              <div class="col-lg-6 text-center">
                
                <p>&copy; <strong>2019 Copyright. Made by</strong> <span class="text-success"><strong> Bandag</strong> </span></p>
               
              </div>
              
            </div>
          </div>
        </div>
      </div>
    
    </footer>  --}}
    @endif
    </body>
</html>
