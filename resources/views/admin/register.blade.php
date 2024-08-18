@extends('layout')

@section('navigation')
	<a style="margin: 0px 10px" class="btn btn-primary btn-primary" href="{{url('/')}}">Home</a>
@endsection

@section('content')
	<form action="" method="POST">
		@csrf
		<div class = "row" style="padding-bottom: 20px;">
			<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"><label for="name">* Username</label></div>
			<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12"><input style="width:100%" type="text" id="name" name="name"/></div>
			@error('name')
				<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"></div>
				<div style="color:red">{{$message}}</div>
			@enderror
		</div>
		<div class = "row" style="padding-bottom: 20px;">
			<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"><label for="email">* Email</label></div>
			<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12"><input style="width:100%" type="email" id="email" name="email"/></div>
			@error('email')
				<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"></div>
				<div style="color:red">{{$message}}</div>
			@enderror
		</div>
		<div class = "row" style="padding-bottom: 20px;">
			<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"><label for="password">* Password</label></div>
			<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12"><input style="width:100%" type="password" id="password" name="password"/></div>
			@error('password')
				<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"></div>
				<div style="color:red">{{$message}}</div>
			@enderror
		</div>
		<p style="text-align:center"><input class="btn btn-primary btn-lg" type="submit" value="Register" /></p>
	</form>
@endsection