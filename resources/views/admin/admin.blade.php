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
		<a style="margin: 0px 10px" class="btn btn-primary btn-primary" href="{{url('admin')}}">Back</a>
		<a style="margin: 0px 10px" class="btn btn-primary btn-primary" href="{{url('admin/settings')}}">Settings</a>
		<a style="margin: 0px 10px" class="btn btn-primary btn-primary" href="{{url('admin/logout')}}">Logout</a>
    </nav>
	<div class="container-fluid header_background mt-4 pt-4">
		<div class="row" style="background-color: #88CCFF;">
			<div class="p-3 mx-auto"><img src="{{ url('images/crest2.png') }}" height="150" alt="crest.jpg" /></div>
			<div class="mx-auto my-auto text-center"><h1><strong>S. Thomas' College, Mount Lavinia<br/>Admissions - {{date('Y')}}</strong></h1></div>
		</div>
	</div>
	<div class="container-fluid body_background" >
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
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-3">
				<ul style="list-style: none;">
					<li>Total Registered = {{$total}}</li>
					<li>Not Purchased = {{$notpurchased}}</li>
					<li>Purchased Not Submitted = {{$purchased}}</li>
					<li>Submitted = {{$submitted}}</li>
				</ul>
			</div>
			<div class="col-sm-3">
				@if($section == 'Nursery')
				<ul style="list-style: none;">
					<li>2+ - {{$nursery[0]}}</li>
					<li>3+ - {{$nursery[1]}}</li>
					<li>4+ - {{$nursery[2]}}</li>
				</ul>
				@endif
			</div>
			<div class="col-sm-3"></div>
		</div>
		
		<table border="2" style="width:100%">
			<thead>
				<th width="20px">ID</th>
				<th width="200px">Name</th>
				<th width="50px">Mobile</th>
				<th width="100px">Email</th>
				@if($link == 'branch') <th width="300px">Branch</th> @endif
				<th width="100px">Purchased</th>
				<th width="100px">Submitted</th>
				@if($link == 'branch' || $link=='alevel') <th width="200px">Section</th>@endif
				<th width="50px">Application</th>
				<th width="50px">Make PDF</th>
			</thead>
			@foreach($applicants as $applicant)
				@if($applicant['submitted'])
					<tr style="background-color: lightgreen;">
				@elseif($applicant['purchased'])
					<tr style="background-color: lightyellow;">
				@else
					<tr style="background-color: red;">
				@endif
						<td><a href="{{url('admin/show?id=' . $applicant['id'] . '&section=' . $section)}}">{{$applicant['id']}}</a></td>
						<td>{{$applicant['name']}}</td>
						<td>{{$applicant['mobile']}}</td>
						<td>{{$applicant['email']}}</td>
						@if($link == 'branch') <td>{{$applicant['branch']}}</td>@endif
						<td>@if($applicant['purchased']) {{$applicant['purchased_date']}} @else No @endif</td>
						<td>@if($applicant['submitted']) {{$applicant['submitted_date']}} @else No @endif</td>
						@if($link == 'branch' || $link=='alevel') <td>
							@foreach($sections as $child)
								@if($child['id'] == $applicant['id'])
									{{$child['grade_sought']}}
									@break;
								@endif
							@endforeach
						</td> @endif
						@if($applicant['submitted']) 
							<td><a href="https://admissions.stcmount.com/uploads/{{$applicant['id']}}_pdf.pdf" target="blank">Application</a></td>
							<td><a href="{{url('make?id=' . $applicant['id'])}}">Make Application</a></td>
						@endif
					</tr>
			@endforeach
		</table>
		<div class="d-flex justify-content-center">{{$applicants->appends(['section'=>$section])->links()}}</div>
		<br/>
		<p style="text-align:center"><a class="btn btn-primary btn-primary" style="margin: 20px" href="{{url('admin/download?link=' . $link)}}">Download Master Data</a><!--<a class="btn btn-primary btn-primary" style="margin: 20px" href="{{url('admin/downloadapplications?link=' . $link)}}">Combine Applications</a>--></p>
	</div>
</body>
</html>