@extends('layout')
@section('navigation')
    <a style="margin: 0px 10px" class="btn btn-primary btn-primary" href="{{url('admin/logout')}}">Logout</a>
@endsection
@section('content')
	<form action="{{ route('settings.update', $setting['id']) }}" method="POST">
		@csrf
		@method("PUT")
		<div class = "row" style="padding-bottom: 20px;">
			<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"><label for="txtSettingSection">* Select Section</label></div>
			<div class="col-md-8"><input id="txtSettingSection" name="txtSettingSection" class="form-control" readonly value="{{$setting['name']}}" /></div>
		</div>
		<div class = "row" style="padding-bottom: 20px;">
			<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"><label for="txtYear">* Year</label></div>
			<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12"><input style="width:100%" type="text" required value="{{$setting['year']}}" id="txtYear" name="txtYear" /></div>
		</div>
		<div class = "row" style="padding-bottom: 20px;">
			<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"><label for="txtOpen">* Open Date</label></div>
			<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12"><input style="width:100%" type="text" required placeholder="yyyy/mm/dd hh:mm:ss" id="txtOpen" name="txtOpen" value="{{$setting['open']}}"/></div>
		</div>
		<div class = "row" style="padding-bottom: 20px;">
			<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"><label for="txtClose">* Close Date</label></div>
			<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12"><input style="width:100%" type="text" required placeholder="yyyy/mm/dd hh:mm:ss" id="txtClose" name="txtClose" value="{{$setting['close']}}"/></div>
		</div>
		<div class="float-left"><a class="btn btn-primary btn-lg" href="{{route('settings.index')}}">Back</a></div>
		<div class="float-right"><input type="submit" class='btn btn-primary btn-lg' value="Update"/></div>
	</form>
	<form action="{{route('settings.destroy', $setting['id'])}}" method="post">
		@csrf
		@method("DELETE")
		<div class="text-center"><input class="btn btn-primary btn-lg" type="submit" value="Delete" /></div>
	</form>
@endsection