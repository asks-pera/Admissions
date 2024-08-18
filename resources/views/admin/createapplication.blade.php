@extends('layout')

@section('year')

@endsection

@section('content')
	<h2>Create Application - Admissions</h2><br/>
	<form method="post" action="">
		@csrf
		<div class = "row" style="padding-bottom: 20px;">
			<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"><label for="section">* Section</label></div>
			<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12"><input style="width:100%" type="text" readonly="readonly" id="section" name="section" value="{{$request['section']}}"/></div>
		</div>
		<div class = "row" style="padding-bottom: 20px;">
			<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"><label for="name">* Name of Parent</label></div>
			<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12"><input style="width:100%" type="text" maxlength="250" placeholder="Enter Name of Parent" id="name" name="name" value="{{$request['name']}}" /></div>
		</div>
		<div class = "row" style="padding-bottom: 20px;">
			<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"><label for="nic">* NIC / Passport No.</label></div>
			<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12"><input style="width:100%" type="text" maxlength="20" placeholder="Enter Sri Lankan National Identiy Card Number" id="nic" name="nic" title="National Identity Card / Passport Number" value="{{$request['nic']}}"/></div>
		</div>
		<div class = "row" style="padding-bottom: 20px;">
			<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"><label for="mobile">* Mobile Number</label></div>
			<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12"><input style="width:100%" type="text" maxlength="20" placeholder="Enter Mobile Number" id="mobile" name="mobile" value="{{$request['mobile']}}"/></div>
		</div>
		<div class = "row" style="padding-bottom: 20px;">
			<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"><label for="email">* Verified Email address</label></div>
			<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12"><input style="width:100%" type="email" maxlength="100" readonly value="{{$request['email']}}"/></div>
		</div>
		@if($request['section'] == "Branch Schools")
			<div class = "row" style="padding-bottom: 20px;">
				<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"><label for="branch">* Select Branch</label></div>
				<div class="col-md-8"><select id="branch" name="branch" class="form-control">
						<option value="">Select Branch</option>
						<option value="S. Thomas' Preparatory School, Kollupitiya" @if(old('branch')=="S. Thomas' Preparatory School, Kollupitiya") selected @endif>S. Thomas' Preparatory School, Kollupitiya</option>
						<option value="S. Thomas' College, Gurutalawa" @if(old('branch')=="S. Thomas' College, Gurutalawa") selected @endif>S. Thomas' College, Gurutalawa</option>
						<option value="S. Thomas' College, Bandarawela" @if(old('branch')=="S. Thomas' College, Bandarawela") selected @endif>S. Thomas' College, Bandarawela</option>
					</select>
				</div>
			</div>
		@endif
		<p style="text-align:center"><input class="btn btn-primary btn-lg" type="submit" value="Register Now" id="submit" name="submit"/></p>
	</form>
@endsection