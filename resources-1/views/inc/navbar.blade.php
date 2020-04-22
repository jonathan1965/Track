<nav class="navbar navbar-expand-md navbar-light">
      <button class="navbar-toggler ml-auto mb-2 bg-light" type="button" data-toggle="collapse" data-target="#myNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="myNavbar">
        <div class="container-fluid">
          <div class="row">
            <!-- sidebar -->
            <div class="col-xl-2 col-lg-1 col-md-3 sidebar fixed-top">
              <a href="#" class="navbar-brand text-white d-block mx-auto text-center py-3 mb-4 bottom-border"><img src="bandag.png" class="img-fluid rounded-circle mr-1" width="100"></a>
              <div class="bottom-border pb-3">
                <img src="images/user.png" width="50" class="rounded-circle mr-3">
                <a href="#" class="text-white">{{ Auth::user()->name }}</a>
              </div>
              <ul class="navbar-nav flex-column mt-4">
                <li class="nav-item"><a href="/" class="nav-link text-white p-3 mb-2"><i class="fas fa-home text-light fa-lg mr-3"></i>Dashboard</a></li>
                <li class="nav-item {{ Request::segment(1) === 'entries' ? 'current' : null }}"><a href="/entries" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-file text-light fa-lg mr-3"></i>Service Data</a></li>
                <!-- <li class="nav-item"><a href="reports.html" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fa fa-money-bill text-light fa-lg mr-3"></i>Status Reports</a></li> -->
                <li class="nav-item {{ Request::segment(1) === 'services' ? 'current' : null }}"><a href="/services" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fa fa-server text-light fa-lg mr-3"></i>Services</a></li>
                <li class="nav-item"><a href="/clients" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-users text-light fa-lg mr-3"></i>Clients</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-clock text-light fa-lg mr-3"></i>Reminders</a></li>
                <li class="nav-item {{ Request::segment(1) === 'vehicles' ? 'current' : null }}"><a href="/vehicles" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-car text-light fa-lg mr-3"></i>Vehicles</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-tasks text-light fa-lg mr-3"></i>Tasks</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-users text-light fa-lg mr-3"></i>Users</a></li>
                <li class="nav-item {{ Request::segment(1) === 'locations' ? 'current' : null }}"><a href="/locations" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-map-marker text-light fa-lg mr-3"></i>Locations</a></li>
                <!-- <li class="nav-item"><a href="drivers.html" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-car text-light fa-lg mr-3"></i>Drivers</a></li>
                <li class="nav-item {{ Request::segment(1) === 'locations' ? 'current' : null }}"><a href="drivers.html" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-gas-pump text-light fa-lg mr-3"></i>Stations</a></li> -->
                
              </ul> 
            </div>
            <!-- end of sidebar -->

            <!-- top-nav -->

            <div class="col-xl-10 col-lg-9 col-md-8 ml-auto bg-dark fixed-top py-2 top-navbar">
              <div class="row align-items-center">
                <div class="col-md-4">
                  <h4 class="text-light text-uppercase mb-0">Service Track</h4>
                </div>
                <div class="col-md-5">
                  <!-- <form>
                    <div class="input-group">
                      <input type="text" class="form-control search-input" placeholder="Search...">
                      <button type="button" class="btn btn-white search-button"><i class="fas fa-search text-danger"></i></button>
                    </div>
                  </form> -->
                </div>
                <div class="col-md-3">
                  <ul class="navbar-nav">
                    <li class="nav-item icon-parent"><a href="#" class="nav-link icon-bullet"><i class="fas fa-comments text-muted fa-lg"></i></a></li>
                    <li class="nav-item icon-parent"><a href="#" class="nav-link icon-bullet"><i class="fas fa-bell text-muted fa-lg"></i></a></li>
                    <li class="nav-item ml-md-auto"><a href="{{ url('/logout') }}" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();" class="nav-link"><i class="fas fa-sign-out-alt text-danger fa-lg"></i></a><form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form></li>
                  </ul>
                </div>
              </div>
            </div>
            <!-- end of top-nav -->
          </div>
        </div>
      </div>
    </nav>
    <!-- end of navbar -->