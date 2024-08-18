@extends('layout')

@section('header')

@endsection

@section('navigation')
	<a style="margin: 0px 10px" class="btn btn-primary btn-primary" href="{{url('application/status')}}">Back</a>
@endsection

@section('year')
	- {{$year}}
@endsection

@section('content')
	<div id="student_picture"><img src="{{url('/uploads/' . $picture . '')}}" height='120' alt="" style='float:right' /></div>
	<h2>General Details</h2>
	<div class="row border border-dark rounded" style="margin:10px; padding:50px; display:block;">
		<form action="" method="post">
			@csrf
			<input type="hidden" value="{{$id}}" name="id" />
			@if(($section == 'Other Grades') || ($section == 'Grade 6') || ($section == 'Branch Schools') || ($section == 'ALevels') || ($section == 'International ALevels'))
				<div class="form-group row pt-5" style="padding-bottom: 20px;">
					<label for="sports" class="col-md-4 col-form-label">* Sports and Games</label>
					<div class="col-md-8"><textarea class="form-control" style="height:75px" maxlength="500" placeholder="Sports and Games of the child" id="sports" name="sports">@if(isset($general)){{$general['sports']}}@else{{old('sports')}}@endif</textarea></div>
					@error('sports')
						<div class="col-md-4"></div>
						<div class="col-md-8 text-danger">{{$message}}</div>
					@enderror
				</div>
				<div class="form-group row pt-5" style="padding-bottom: 20px;">
					<label for="societies" class="col-md-4 col-form-label">* Clubs and Societies</label>
					<div class="col-md-8"><textarea class="form-control" style="height:75px" maxlength="500" placeholder="Clubs and Societies of the child" id="societies" name="societies">@if(isset($general)){{$general['societies']}}@else{{old('societies')}}@endif</textarea></div>
					@error('societies')
						<div class="col-md-4"></div>
						<div class="col-md-8 text-danger">{{$message}}</div>
					@enderror
				</div>
				<div class="form-group row pt-5" style="padding-bottom: 20px;">
					<label for="other" class="col-md-4 col-form-label">* Other Achievements</label>
					<div class="col-md-8"><textarea class="form-control" style="height:75px" maxlength="500" placeholder="Other achievements of the child" id="other" name="other">@if(isset($general)){{$general['other']}}@else{{old('sports')}}@endif</textarea></div>
					@error('other')
						<div class="col-md-4"></div>
						<div class="col-md-8 text-danger">{{$message}}</div>
					@enderror
				</div>
			@endif
			<div class = "form-group row" style="padding-bottom: 20px;">
				<label class="col-md-4 col-form-label" for="boarding">Will you need the boarding?</label>
				<div class="col-md-8"><select id="boarding" name="boarding" class="form-control">
					<option value="">Select</option>
					<option value="Day Scholar" @if((isset($general)) && ($general['boarding'] == 'Day Scholar')) selected @elseif(old('boarding')=='Day Scholar') selected @endif>Day Scholar - Do not require boarding</option>
					<option value="Day Boarding" @if((isset($general)) && ($general['boarding'] == 'Day Boarding')) selected @elseif(old('boarding')=='Day Boarding') selected @endif>Day Boarding - Daily from 6.00am to 6.00pm</option>
					<option value="Full Boarding" @if((isset($general)) && ($general['boarding'] == 'Full Boarding')) selected @elseif(old('boarding')=='Full Boarding') selected @endif>Full Boarding</option>
				</select></div>
				@error('boarding')<div class="col-md-4"></div><div class="col-md-8 text-danger">{{$message}}</div>@enderror
			</div>
			<div class="row">
				<div class="col-md-6 text-center"><a class="btn btn-primary btn-lg" style="margin:10px 0;" type="button" href="{{url('application/status')}}">Back</a></div>
				<div class="col-md-6 text-center"><input class="btn btn-primary btn-lg" style="margin:10px 0;" type="submit" @if(!isset($general)) value="Save Data" @else value="Update Data" @endif id="cmdSave" name="cmdSave"/></div>
			</div>
		</form>
	</div>
@endsection