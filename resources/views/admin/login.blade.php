@extends('layout')

@section('navigation')
	<a style="margin: 0px 10px" class="btn btn-primary btn-primary" href="{{url('/')}}">Home</a>
@endsection

@section('content')
	<h2>For Office Use Only</h2>
	<div class="mask d-flex align-items-center h-100">
        <div class="container">
          	<div class="row justify-content-center">
            	<div class="col-xl-5 col-md-8">
              		<form class="bg-white  rounded-5 shadow-5-strong p-5" action="" method="post">
              			@csrf
                		<div class="form-outline mb-4">
                  			<input type="text" id="name" name="name" class="form-control" value="{{old('name')}}"/>
                  			<label class="form-label" for="name">Username</label>
                  			@error('name')
								<div style="color:red">{{$message}}</div>
							@enderror
                		</div>
		                <div class="form-outline mb-4">
		                  	<input type="password" id="password" name="password" class="form-control" />
		                  	<label class="form-label" for="password">Password</label>
		                  	@error('password')
								<div style="color:red">{{$message}}</div>
							@enderror
		                </div>
                		<button type="submit" class="btn btn-primary btn-block">Login</button>
              		</form>
            	</div>
          	</div>
        </div>
    </div>
@endsection