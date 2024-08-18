@extends('layout')

@section('header')
<style>
	#intro {
		background-image: url('../images/bg-pic.jpg');
        height: 50vh;
	}

    @media (min-width: 992px) {
		#intro {
          	margin-top: 0px;
        }
    }

	.navbar .nav-link {
		color: #fff !important;
	}
</style>
@endsection

@section('year')
	- {{date('Y')}}
@endsection

@section('content')
	<h2>Login</h2>
	<p>Use the Log in details found in your email to access the application form</p>
	<div id="intro" class="bg-image shadow-2-strong">
		<div class="mask d-flex align-items-center h-100" style="background-color: rgba(0, 0, 0, 0.8);">
	        <div class="container">
	          	<div class="row justify-content-center">
	            	<div class="col-xl-5 col-md-8">
	              		<form class="bg-white  rounded-5 shadow-5-strong p-5" action="" method="post">
	              			@csrf
	                		<div class="form-outline mb-4">
	                  			<input type="email" id="email" name="email" class="form-control" value="{{old('email')}}"/>
	                  			<label class="form-label" for="email">Email address</label>
	                  			@error('email')
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
	                		<button type="submit" class="btn btn-primary btn-block">Sign in</button>
	              		</form>
	              		@if(session('error'))
							<div style="color:red">{{ session('error')}}</div>
						@endif
	            	</div>
	          	</div>
	        </div>
	    </div>
	</div>
@endsection

    