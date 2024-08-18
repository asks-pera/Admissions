<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>S. Thomas' College - Admissions</title>
	<link id="page_favicon" href="favicon.ico?v=2" rel="icon" type="image/x-icon" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  	<link rel="stylesheet" href="{{ url('css/style.css') }}"  />
</head>
<body>
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark blue-gradient scrolling-navbar justify-content-end" style="background-color: #335577; height:55px">
	    <a style="margin: 0px 10px" class="btn btn-primary btn-primary" href="{{url('admin/sorting')}}">Sort Applications</a>
		<a style="margin: 0px 10px" class="btn btn-primary btn-primary" href="{{url('admin/settings')}}">Settings</a>
		<a style="margin: 0px 10px" class="btn btn-primary btn-primary" href="{{url('admin/logout')}}">Logout</a>
    </nav>
	<div class="container header_background mt-4 pt-4">
		<div class="row" style="background-color: #88CCFF;">
			<div class="p-3 mx-auto"><img src="{{ url('images/crest2.png') }}" height="150" alt="crest.jpg" /></div>
			<div class="mx-auto my-auto text-center"><h1><strong>S. Thomas' College, Mount Lavinia<br/>Admissions - {{date('Y')}}</strong></h1></div>
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
		<form action="list" method="get">
			<div class = "row" style="padding-bottom: 20px;">
				<div class="col-lg-2 col-md-2 col-sm-5 col-xs-12"><label for="section">* Section</label></div>
				<div class="col-lg-4 col-md-4 col-sm-7 col-xs-12">
					<select class="form-control" id="section" name="section">
						<option value="">Select Section</option>
						<option value="Nursery">Nursery</option>
						<option value="Kindergarten (Grade 1)">Kindergarten (Grade 1)</option>
						<option value="Other Grades">Other Grades</option>
						<option value="Grade 6">Grade 6</option>
						<option value="Branch Schools">Branch Schools</option>
						<option value="ALevels">ALevels</option>
						<option value="International ALevels">International ALevels</option>
					</select>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-5 col-xs-12"><label for="year">* Year</label></div>
				<div class="col-lg-4 col-md-4 col-sm-7 col-xs-12">
					<select class="form-control" id="year" name="year">
						<option value="">Select Year</option>
						<option value="2022">2022</option>
						<option value="2023">2023</option>
						<option value="2024">2024</option>
						<option value="2025">2025</option>
					</select>
				</div>
			</div>
			<div class = "row" style="padding-bottom: 20px;">
				<div class="col-lg-2 col-md-2 col-sm-5 col-xs-12"></div>
				<div class="col-lg-4 col-md-4 col-sm-7 col-xs-12" style="color:red">
					@error('section')
						{{$message}}
					@enderror
				</div>
				<div class="col-lg-2 col-md-2 col-sm-5 col-xs-12"></div>
				<div class="col-lg-4 col-md-4 col-sm-7 col-xs-12" style="color:red">
					@error('year')
						{{$message}}
					@enderror
				</div>
			</div>
			<div style="text-align:right"><input type="submit" class='btn btn-primary btn-lg' style='margin:10px' value="Submit"/></div>
		</form>
	</div>
</body>
</html>