@if(Auth::user()->usertype == 'admin')
@extends('layouts.app')
@section('content')
     <section style="padding-left: 30px; padding-top: 80px;  background: #EEEEEE;">
      <div class="container-fluid" style=" background: #EEEEEE;">     
    <div class="row justify-content-center">
      <div class="col-sm-9" style="padding-left: 80px;">
        <h3 class="text-muted text-center mb-3">Users</h3>
        <button type="button" class="btn btn-primary text-right btn-gb1 " data-toggle="modal" data-target="#myModal">Create New User</button>
      <table class="display" id="example" data-page-length='25'>
       
          <thead>
            
            <tr>
              <th scope="col">#</th>
              <th scope="col">Names</th>
              <th scope="col">Email</th>
              <th scope="col">Client</th>
              <th scope="col">User Type</th>
              <th scope="col">action</th>
            </tr>
          </thead>
        
          <tbody>
            
                @foreach ($users as $user)
                <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->client}}</td>
                <td> <b> {{$user->usertype}}</b></td>
                <td> 
                 
                  <button type="button" class="btn btn-primary-outline  btn-sm" data-myname="{{$user->name}}" data-myclient="{{$user->client}}" data-usertp={{$user->usertype}}  data-user_id={{$user->id}}  data-toggle="modal" data-target="#edit">
                    <i class="fa fa-edit text-success"></i> 
                  </button>
                  
                <button type="button" class="btn btn-primary-outline btn-sm" data-user_id={{$user->id}}   data-toggle="modal" data-target="#delete"><i class="fa fa-trash text-danger"></i></button>
                 </td>
                  </tr>
                @endforeach
          </tbody>
   
       </table>
      
        </div> 
      </div> 
           

       <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title">New User</h4>
                  </div>
                <form class="" style="color:black;" action="{{route('user.store')}}" method="post">
                           {{csrf_field()}}
                              <div class="modal-body">
                                  <div class="form-row">
                                      <div class="col">
                                          <!-- Name -->
                                          <div class="md-form">
                                            <label for="materialRegisterFormFirstName" class=""><i class="fas fa-heading text-primary"></i> Name</label>
                                              <input type="text" id="" class="form-control" name="name" >
                                          </div>
                                      </div>
                                  </div> 
                      
                                  <!-- E-mail -->
                                   <div class="md-form mt-0">
                                    <label for="email"><i class="fas fa-envelope-square text-primary"></i> E-mail</label>
                                      <input type="email" id="email" class="form-control" name="email">
                                    </div>
                                  
                                    <div class="md-form">
                                      <label for=""><i class="fas fa-adjust text-primary"></i> Client</label>
                                         <select name="client" class="form-control" >

                                            <option selected disabled>Choose Client</option>
                                            @foreach ($clients as $client)
                                            <option value="{{$client->name}}">{{$client->name}}</option>
                                            @endforeach
                                            
                                      </select>
                                      </div>
                                 
                                  <div class="md-form">
                                    <label for=""><i class="fas fa-adjust text-primary"></i> Usertype</label>
                                       <select name="usertype" class="form-control" >
                                          <option value=""></option>
                                          <option value="admin">Admin</option>
                                          <option value="user">User</option>
                                          <option value="other">Other</option>
                                    </select>
                                    </div>

                                    <div class="md-form mt-0">
                                      <label for=""><i class="fas fa-key text-primary"></i> Password</label>
                                        <input type="password" id="password" class="form-control" name="password">
                                      </div>
                                     </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                                  </form>
                                </div>         
                              </div>
                      </form> 
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal --> 





       <div class="modal fade" tabindex="-1" role="dialog" id="edit">
            <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Edit User</h4>
            </div>
              <div class="card-body">
              <div class="row">
                  <div class="col-md-6">
        <form action="{{route('user.update','test')}}" method="post">
          {{method_field('patch')}}
          {{csrf_field()}}
                <div class="modal-body">
                    <input type="hidden" name="user_id" id="user_id" value="">   
                      <div class="form-group">
                          <label for="title"><i class="fas fa-heading text-primary"></i> Name</label>
                          <input type="text" name="username" class="form-control" id="title"  value="" aria-describedby="" placeholder="Enter Name ">
                        </div>
                        <div class="md-form">
                          <label for=""><i class="fas fa-adjust text-primary"></i> Client</label>
                             <select name="client" id="client" class="form-control" >

                                <option selected disabled>Choose Client</option>
                                @foreach ($clients as $client)
                                <option value="{{$client->name}}">{{$client->name}}</option>
                                @endforeach
                                
                          </select>
                          </div>
                  <div class="form-group">
                      <label for=""><i class="fas fa-adjust text-primary"></i> Give Role</label>
                      <select name="usertype" class="form-control" id="usertp" >
                          <option value="admin">Admin</option>
                          <option value="user">User</option>
                          <option value="other">Other</option>
                      </select>
                  </div>

                  <div class="model-footer">
                    <button type="submit" class="btn btn-succes">Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                </div>
        </form>
                  </div>
              </div>
        </div>

              </div>         
            </div>
          </form>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->




      <div class="modal  fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog" role="document" >
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <form action="{{route('user.destroy','test')}}" method="post">
                {{method_field('delete')}}
                {{csrf_field()}}
              <div class="modal-body" style="background:#f7c3c3">
              <p class="text-center">
               <b> Are you sure you want to delete this?</b> 
              </p>
                  <input type="hidden" name="users_id" id="user_id" value="">
      
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
                <button type="submit" class="btn btn-warning">Yes, Delete</button>
              </div>
            </form>
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
       $('#edit').on('show.bs.modal', function (event) {
        
        var button = $(event.relatedTarget) 
        var name1 = button.data('myname') 
        var client = button.data('myclient') 
        var type = button.data('usertp') 
        var id = button.data('user_id')
        var modal = $(this)
      
         modal.find('.modal-body #title').val(name1);
         modal.find('.modal-body #client').val(client);
         modal.find('.modal-body #user_id').val(id);
         modal.find('.modal-body #usertp').val(type);
          console.log(type)
      })


      $('#delete').on('show.bs.modal', function (event) {
        
        var button = $(event.relatedTarget) 
   
        var name1 = button.data('myname') 
        var type = button.data('usertp') 
        var id = button.data('user_id')
        var modal = $(this)

         modal.find('.modal-body #user_id').val(id);
        
          console.log(type)
      })
      
    </script>
    <script>
      $(document).ready(function() {
          $('table.display').DataTable();
      } );
    </script>
@endsection
@endif