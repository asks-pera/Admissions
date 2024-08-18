@extends('layout')
@section('navigation')
    <a style="margin: 0px 10px" class="btn btn-primary btn-primary" href="{{url('admin/logout')}}">Logout</a>
@endsection
@section('content')
	<form action="{{ route('settings.store') }}" method="POST">
		@csrf
		<div class = "row" style="padding-bottom: 20px;">
			<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"><label for="txtSettingSection">* Select Section</label></div>
			<div class="col-md-8"><select id="txtSettingSection" name="txtSettingSection" class="form-control" required>
				<option value="">Select Section</option>
				@foreach($list as $item)
					<option value="{{$item}}">{{$item}}</option>
				@endforeach
				</select>
			</div>
		</div>
		<div class = "row" style="padding-bottom: 20px;">
			<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"><label for="txtYear">* Year</label></div>
			<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12"><input style="width:100%" type="text" required value="2023" id="txtYear" name="txtYear" /></div>
		</div>
		<div class = "row" style="padding-bottom: 20px;">
			<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"><label for="txtOpen">* Open Date</label></div>
			<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12"><input style="width:100%" type="text" required placeholder="yyyy/mm/dd hh:mm:ss" id="txtOpen" name="txtOpen" /></div>
		</div>
		<div class = "row" style="padding-bottom: 20px;">
			<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"><label for="txtClose">* Close Date</label></div>
			<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12"><input style="width:100%" type="text" required placeholder="yyyy/mm/dd hh:mm:ss" id="txtClose" name="txtClose" /></div>
		</div>
		<div style="text-align:right"><input type="submit" class='btn btn-primary btn-lg' style='margin:10px' value="Submit"/></div>
	</form>
@endsection