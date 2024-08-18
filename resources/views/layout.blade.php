<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>S. Thomas' College - Admissions</title>
	<link id="page_favicon" href="{{url('favicon.ico?v=2')}}" rel="icon" type="image/x-icon" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  	<link rel="stylesheet" href="{{ url('css/style.css') }}"  />
  	@yield('header')
</head>
<body>
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark blue-gradient scrolling-navbar justify-content-end" style="background-color: #335577; height:55px">
        @yield('navigation')
    </nav>
	<div class="container header_background mt-4 pt-4">
		<div class="row" style="background-color: #88CCFF;">
			<div class="p-3 mx-auto"><img src="{{ url('images/crest2.png') }}" height="150" alt="crest.jpg" /></div>
			<div class="mx-auto my-auto text-center"><h1><strong>S. Thomas' College, Mount Lavinia<br/>Admissions @yield('year')</strong></h1></div>
		</div>
	</div>
	<div class="container body_background" >
		@if(session('success') !== null)
			<div class="alert alert-success">{{ session('success') }}</div>
		@endif
		@if(session('error') !== null)
			<div class="alert alert-danger">{{ session('error') }}</div>
		@endif
		@if(session('info') !== null)
			<div class="alert alert-info">{{ session('info') }}</div>
		@endif
		@if(isset($success))
			<div class="alert alert-success">{{ $success }}</div>
		@endif
		@if(isset($error))
			<div class="alert alert-danger">{{ $error }}</div>
		@endif
		@if(isset($info))
			<div class="alert alert-info">{{ $info }}</div>
		@endif
		@yield('content')
	</div>
	<div class="footer">
		<hr>
		<footer>
			<p style="text-align: center; display: block;"><a href="https://www.stcmount.edu.lk" target="_blank">S. Thomas' College, Mount Lavinia &copy; {{date('Y')}}</a><br />
			Email - <a href="mailto:admissions@stcmount.lk">admissions@stcmount.lk</a></p>
		</footer>
	</div>
</body>
</html>