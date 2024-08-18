@extends('layout')

@section('navigation')
	<a style="margin: 0px 10px" class="btn btn-primary btn-primary" href="{{url('application/status')}}">Back</a>
@endsection

@section('year')
	- {{$year}}
@endsection

@section('content')
	<div id="student_picture"><img src="{{url('/uploads/' . $picture . '')}}" height='120' alt="" style='float:right' /></div>
	<h2>Thomian Connections</h2>
	<form action="" method="post" border="1px border grey">
		@csrf
		<input type="hidden" value="{{$id}}" name="id" />
		<div class = "form-group row" style="padding-bottom: 20px;">
			<p>What we consider Thomian Connections are - 
       		<ol>
       			<li>Maternal / Paternal Father / Grandfather being a Thomian</li>
				<li>Maternal / Paternal Uncle being a Thomian</li>
				<li>Any Aunt, Uncle or Grandparent being / have been in the STC Staff / Board of Governors, etc.</li>
       		</ol>
       		<p>Please enter the details in the following format :-</p>
       		<p>Name of Old boy / staff member - Admission Number (if applicable) / duration of study / stay at STC Mount - Relationship to the child </p>
			<label class="col-md-4 col-form-label" for="connection">* Connections</label>
			<div class="col-md-8"><textarea class="form-control" style="height:75px" maxlength="500" placeholder="Enter details of Thomian connections" id="connection" name="connection">@if(isset($connections)){{$connections['connection']}}@else{{old('connection')}}@endif</textarea></div>
			@error('connection')
				<div class="col-md-4"></div>
				<div class="col-md-8 text-danger">{{$message}}</div>
			@enderror
		</div>
		<div class="row" style="margin-top:10px; ">
			<div class="col-md-6 text-center"><a class="btn btn-primary btn-lg" style="margin:10px 0;" type="button" href="{{url('application/status')}}">Back</a></div>
			<div class="col-md-6 text-center"><input class="btn btn-primary btn-lg" style="margin:10px 0;" type="submit" @if(!isset($connections)) value="Save Data" @else value="Update Data" @endif id="cmdSave" name="cmdSave"/></div>
		</div>
	</form>
@endsection