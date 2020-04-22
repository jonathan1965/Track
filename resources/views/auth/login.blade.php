@extends('layouts.app')

@section('content')
<center>
    
        <div class="container bg_set">
            
            <div class="col-12 col-lg-12 col-md-12 col-sm-12">
                <img src="images/Bandag bg 1-02.png" width="256px" height="128px">
                <div class=" login_card ">
                    <div class="panel">
                        <div class="panel-heading display-5 pb-3" >
                         <div class="form-header">
                            <h4>WELCOME TO</h4>
                            <h4>SERVICE TRACK</h4>
                            <h4>YOUR ONLINE FLEET MANAGEMENT TOOL</h4>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}
        
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>
        
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="E-Mail Address">
        
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
        
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Password</label>
        
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" required placeholder="Password">
        
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                            </label>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Login
                                        </button>
        
                                        {{-- <a class="btn btn-link" href="{{ route('password.request') }}">
                                            Forgot Your Password?
                                        </a> --}}
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                </div>
             </div>       
        </div>     
    </div>
    </div>
</div>

    
<div class="container-fluid longest">
    <div class="col-12 col-lg-12 col-md-12 col-sm-12">
        <h3 >THE BEST PERFORMANCE IS THE ONE THAT LAST THE LONGEST</h3>
    </div>  
</div>





</center>
@endsection
