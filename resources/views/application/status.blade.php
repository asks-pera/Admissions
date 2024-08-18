@extends('layout')

@section('navigation')
	@if($state != 'Application Submitted')
		<a style="margin: 0px 10px" class="btn btn-primary btn-primary" href="{{url('application/logout')}}">Logout</a>
	@endif
@endsection

@section('year')
	- {{$year}}
@endsection

@section('content')
	<h2 class="text-center">Welcome to the Online Application form for student admission to S. Thomas' College, Mount Lavinia</h2><br/>
	<p class="text-center alert alert-info">Current Status of the Application Form - <strong>{{$state}}</strong></p>
	<div class="border p-3 h-100">
		<ol>
			<li><div class="row pl-3 ml-3"><div class="col-sm">Purchase Application</div>
				@if(!$status['purchased'])
					<div class="col-sm alert alert-danger text-center">Incomplete</div>
					<div class="col-sm text-center"><a href="{{ url('/formpurchase?id=' . $status['id'] . time() . '')}}">Purchase Application</a></div>
				@else
					<div class="col-sm alert alert-success text-center">Completed</div>
					<div class="col-sm text-center"></div>
				@endif
				</div>
			</li>
			<li><div class="row pl-3 ml-3"><div class="col-sm">Child's Details</div>
				@if($status['purchased'] && !$status['submitted'] && !$status['child'])
					<div class="col-sm alert alert-danger text-center">Incomplete</div>
					<div class="col-sm text-center"><a href="{{ url('/application/child?id=' . $status['id'] . '')}}">Enter Child's Details</a></div>
				@elseif($status['purchased'] && !$status['submitted'] && $status['child'])
					<div class="col-sm alert alert-success text-center">Completed</div>
					<div class="col-sm text-center"><a href="{{ url('/application/child?id=' . $status['id'] . '')}}">Update Child's Details</a></div>
				@elseif($status['purchased'] && $status['submitted'])
					<div class="col-sm alert alert-success text-center">Completed</div>
					<div class="col-sm text-center"></div>
				@else
					<div class="col-sm alert alert-danger text-center">Incompleted</div>
					<div class="col-sm text-center"></div>
				@endif
				</div>
			</li>
			<li><div class="row pl-3 ml-3"><div class="col-sm">Father's Details</div>
				@if($status['purchased'] && !$status['submitted'] && !$status['father'])
					<div class="col-sm alert alert-danger text-center">Incomplete</div>
					<div class="col-sm text-center"><a href="{{ url('/application/father?id=' . $status['id'] . '')}}">Enter Father's Details</a></div>
				@elseif($status['purchased'] && !$status['submitted'] && $status['father'])
					<div class="col-sm alert alert-success text-center">Completed</div>
					<div class="col-sm text-center"><a href="{{ url('/application/father?id=' . $status['id'] . '')}}">Update Father's Details</a></div>
				@elseif($status['purchased'] && $status['submitted'])
					<div class="col-sm alert alert-success text-center">Completed</div>
					<div class="col-sm text-center"></div>
				@else 
					<div class="col-sm alert alert-danger text-center">Incomplete</div>
					<div class="col-sm text-center"></div>
				@endif
				</div>
			</li>
			<li><div class="row pl-3 ml-3"><div class="col-sm">Mother's Details</div>
				@if($status['purchased'] && !$status['submitted'] && !$status['mother'])
					<div class="col-sm alert alert-danger text-center">Incomplete</div>
					<div class="col-sm text-center"><a href="{{ url('/application/mother?id=' . $status['id'] . '')}}">Enter Mother's Details</a></div>
				@elseif($status['purchased'] && !$status['submitted'] && $status['mother'])
					<div class="col-sm alert alert-success text-center">Completed</div>
					<div class="col-sm text-center"><a href="{{ url('/application/mother?id=' . $status['id'] . '')}}">Update Mother's Details</a></div>
				@elseif($status['purchased'] && $status['submitted'])
					<div class="col-sm alert alert-success text-center">Completed</div>
					<div class="col-sm text-center"></div>
				@else 
					<div class="col-sm alert alert-danger text-center">Incomplete</div>
					<div class="col-sm text-center"></div>
				@endif
				</div>
			</li>
			<li><div class="row pl-3 ml-3"><div class="col-sm">Details of other Children</div>
				@if($status['purchased'] && !$status['submitted'] && !$status['other'])
					<div class="col-sm alert alert-danger text-center">Incomplete</div>
					<div class="col-sm text-center"><a href="{{ url('/application/other?id=' . $status['id'] . '')}}">Enter details of other children</a></div>
				@elseif($status['purchased'] && !$status['submitted'] && $status['other'])
					<div class="col-sm alert alert-success text-center">Completed</div>
					<div class="col-sm text-center"><a href="{{ url('/application/other?id=' . $status['id'] . '')}}">Update details of other children</a></div>
				@elseif($status['purchased'] && $status['submitted'])
					<div class="col-sm alert alert-success text-center">Completed</div>
					<div class="col-sm text-center"></div>
				@else 
					<div class="col-sm alert alert-danger text-center">Incomplete</div>
					<div class="col-sm text-center"></div>
				@endif
				</div>
			</li>
			@if(($section == "ALevels") || ($section == "Grade 6") || ($section == "Branch Schools") || ($section == "International ALevels"))
				<li><div class="row pl-3 ml-3"><div class="col-sm">Exam Results</div>
					@if($status['purchased'] && !$status['submitted'] && !$status['results'])
						<div class="col-sm alert alert-danger text-center">Incomplete</div>
						<div class="col-sm text-center"><a href="{{ url('/application/results?id=' . $status['id'] . '')}}">Enter Exam Results</a></div>
					@elseif($status['purchased'] && !$status['submitted'] && $status['results'])
						<div class="col-sm alert alert-success text-center">Completed</div>
						<div class="col-sm text-center"><a href="{{ url('/application/results?id=' . $status['id'] . '')}}">Update Exam Results</a></div>
					@elseif($status['purchased'] && $status['submitted'])
						<div class="col-sm alert alert-success text-center">Completed</div>
						<div class="col-sm text-center"></div>
					@else 
						<div class="col-sm alert alert-danger text-center">Incomplete</div>
						<div class="col-sm text-center"></div>
					@endif
					</div>
				</li>
			@endif
			@if(($section == "Branch Schools") || ($section == "ALevels") || ($section == "International ALevels"))
				<li><div class="row pl-3 ml-3"><div class="col-sm">Subject Choices</div>
					@if($status['purchased'] && !$status['submitted'] && !$status['subjects'])
						<div class="col-sm alert alert-danger text-center">Incomplete</div>
						<div class="col-sm text-center"><a href="{{ url('/application/subjects?id=' . $status['id'] . '')}}">Enter Subject Choices</a></div>
					@elseif($status['purchased'] && !$status['submitted'] && $status['subjects'])
						<div class="col-sm alert alert-success text-center">Completed</div>
						<div class="col-sm text-center"><a href="{{ url('/application/subjects?id=' . $status['id'] . '')}}">Update Subject Choices</a></div>
					@elseif($status['purchased'] && $status['submitted'])
						<div class="col-sm alert alert-success text-center">Completed</div>
						<div class="col-sm text-center"></div>
					@else 
						<div class="col-sm alert alert-danger text-center">Incomplete</div>
						<div class="col-sm text-center"></div>
					@endif
					</div>
				</li>
			@endif
			@if($religion == 'Christian')
				<li><div class="row pl-3 ml-3"><div class="col-sm">Church Details</div>
					@if($status['purchased'] && !$status['submitted'] && !$status['church'])
						<div class="col-sm alert alert-danger text-center">Incomplete</div>
						<div class="col-sm text-center"><a href="{{ url('/application/church?id=' . $status['id'] . '')}}">Enter Church Details</a></div>
					@elseif($status['purchased'] && !$status['submitted'] && $status['church'])
						<div class="col-sm alert alert-success text-center">Completed</div>
						<div class="col-sm text-center"><a href="{{ url('/application/church?id=' . $status['id'] . '')}}">Update Church Details</a></div>
					@elseif($status['purchased'] && $status['submitted'])
						<div class="col-sm alert alert-success text-center">Completed</div>
						<div class="col-sm text-center"></div>
					@else 
						<div class="col-sm alert alert-danger text-center">Incomplete</div>
						<div class="col-sm text-center"></div>
					@endif
					</div>
				</li>
			@endif
			@if(($oba == 1) || ($section == "Nursery"))
				<li><div class="row pl-3 ml-3"><div class="col-sm">OBA Details</div>
					@if($status['purchased'] && !$status['submitted'] && !$status['oba'])
						<div class="col-sm alert alert-danger text-center">Incomplete</div>
						<div class="col-sm text-center"><a href="{{ url('/application/oba?id=' . $status['id'] . '')}}">Enter OBA Details</a></div>
					@elseif($status['purchased'] && !$status['submitted'] && $status['oba'])
						<div class="col-sm alert alert-success text-center">Completed</div>
						<div class="col-sm text-center"><a href="{{ url('/application/oba?id=' . $status['id'] . '')}}">Update OBA Details</a></div>
					@elseif($status['purchased'] && $status['submitted'])
						<div class="col-sm alert alert-success text-center">Completed</div>
						<div class="col-sm text-center"></div>
					@else 
						<div class="col-sm alert alert-danger text-center">Incomplete</div>
						<div class="col-sm text-center"></div>
					@endif
					</div>
				</li>
			@endif
			<li><div class="row pl-3 ml-3"><div class="col-sm">STC Staff Details</div>
				@if($status['purchased'] && !$status['submitted'] && !$status['staff'])
					<div class="col-sm alert alert-danger text-center">Incomplete</div>
					<div class="col-sm text-center"><a href="{{ url('/application/staff?id=' . $status['id'] . '')}}">Enter Staff Details</a></div>
				@elseif($status['purchased'] && !$status['submitted'] && $status['staff'])
					<div class="col-sm alert alert-success text-center">Completed</div>
					<div class="col-sm text-center"><a href="{{ url('/application/staff?id=' . $status['id'] . '')}}">Update Staff Details</a></div>
				@elseif($status['purchased'] && $status['submitted'])
					<div class="col-sm alert alert-success text-center">Completed</div>
					<div class="col-sm text-center"></div>
				@else 
					<div class="col-sm alert alert-danger text-center">Incomplete</div>
					<div class="col-sm text-center"></div>
				@endif
				</div>
			</li>
			<li><div class="row pl-3 ml-3"><div class="col-sm">Connections</div>
				@if($status['purchased'] && !$status['submitted'] && !$status['connections'])
					<div class="col-sm alert alert-danger text-center">Incomplete</div>
					<div class="col-sm text-center"><a href="{{ url('/application/connections?id=' . $status['id'] . '')}}">Enter Connections</a></div>
				@elseif($status['purchased'] && !$status['submitted'] && $status['connections'])
					<div class="col-sm alert alert-success text-center">Completed</div>
					<div class="col-sm text-center"><a href="{{ url('/application/connections?id=' . $status['id'] . '')}}">Update Connections</a></div>
				@elseif($status['purchased'] && $status['submitted'])
					<div class="col-sm alert alert-success text-center">Completed</div>
					<div class="col-sm text-center"></div>
				@else 
					<div class="col-sm alert alert-danger text-center">Incomplete</div>
					<div class="col-sm text-center"></div>
				@endif
				</div>
			</li>
			@if($section != "Nursery")
				<li><div class="row pl-3 ml-3"><div class="col-sm">General Information</div>
					@if($status['purchased'] && !$status['submitted'] && !$status['general'])
						<div class="col-sm alert alert-danger text-center">Incomplete</div>
						<div class="col-sm text-center"><a href="{{ url('/application/general?id=' . $status['id'] . '')}}">Enter General Information</a></div>
					@elseif($status['purchased'] && !$status['submitted'] && $status['general'])
						<div class="col-sm alert alert-success text-center">Completed</div>
						<div class="col-sm text-center"><a href="{{ url('/application/general?id=' . $status['id'] . '')}}">Update General Information</a></div>
					@elseif($status['purchased'] && $status['submitted'])
						<div class="col-sm alert alert-success text-center">Completed</div>
						<div class="col-sm text-center"></div>
					@else 
						<div class="col-sm alert alert-danger text-center">Incomplete</div>
						<div class="col-sm text-center"></div>
					@endif
					</div>
				</li>
			@endif
			<li><div class="row pl-3 ml-3"><div class="col-sm">Submit</div>
				@if($submit == 0)
					<div class="col-sm alert alert-danger text-center">Some sections remain incomplete</div>
					<div class="col-sm text-center"></div>
				@elseif($submit == 1)
					<div class="col-sm alert alert-danger text-center">All sections complete - Form to be submitted</div>
					<div class="col-sm text-center"><a href="{{ url('/application/submit?id=' . $status['id'] . '')}}">Review & Submit Application</a></div>
				@elseif($submit == 2)
					<div class="col-sm alert alert-danger text-center">Minimum Criteria not met - Father musit be an old boy or the father / mother must be a member of staff</div>
					<div class="col-sm text-center"></div>
				@elseif($submit == 99)
					<div class="col-sm alert alert-success text-center">Application has already been submitted</div>
					<div class="col-sm text-center"><a href="{{ url('/application/finalised?id=' . $status['id'] . '')}}">View Completed Application</a></div>
				@endif
				</div>
			</li>
		</ol>
	</div>

@endsection