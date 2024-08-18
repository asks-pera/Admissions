@extends('layout')

@section('navigation')
	<a style="margin: 0px 10px" class="btn btn-primary btn-primary" href="{{url('application/status')}}">Back</a>
@endsection

@section('year')
	- {{$year}}
@endsection

@section('content')
	<div id="student_picture"><img src="{{url('/uploads/' . $picture . '')}}" height='120' alt="" style='float:right' /></div>
	<h2>Church Details</h2>
	<form action="" method="post" border="1px border grey">
		@csrf
		<input type="hidden" value="{{$id}}" name="id" />
		<div class = "form-group row" style="padding-bottom: 20px;">
			<label class="col-md-4 col-form-label" for="parish">* Name of the Parish</label>
			<div class="col-md-8"><input class="form-control" type="text" maxlength="100" placeholder="Enter name of the parish you attend" id="parish" name="parish" value="@if(isset($church)){{$church['parish']}}@else{{old('parish')}}@endif"/></div>
			@error('parish')
				<div class="col-md-4"></div>
				<div class="col-md-8 text-danger">{{$message}}</div>
			@enderror
		</div>
		<div class = "form-group row" style="padding-bottom: 20px;">
			<label class="col-md-4 col-form-label" for="priest">* Name and address of the Parish Priest</label>
			<div class="col-md-8"><input class="form-control" type="text" maxlength="200" placeholder="Enter name and address of the Parish Priest" id="priest" name="priest" value="@if(isset($church)){{$church['priest']}}@else{{old('priest')}}@endif" /></div>
			@error('priest')
				<div class="col-md-4"></div>
				<div class="col-md-8 text-danger">{{$message}}</div>
			@enderror
		</div>
		<div class="row" style="margin-top:10px; ">
			<div class="col-md-6 text-center"><a class="btn btn-primary btn-lg" style="margin:10px 0;" type="button" href="{{url('application/status')}}">Back</a></div>
			<div class="col-md-6 text-center"><input class="btn btn-primary btn-lg" style="margin:10px 0;" type="submit" @if(!isset($church)) value="Save Data" @else value="Update Data" @endif id="cmdSave" name="cmdSave"/></div>
		</div>
	</form>
@endsection