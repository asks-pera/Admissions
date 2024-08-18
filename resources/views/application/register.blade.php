@extends('layout')

@section('year')
	- {{$year}}
@endsection

@section('content')
	<h2>Register to purchase an Application Form for {{$year}} Admissions</h2><br/>
	<form method="post" action="">
		@csrf
		@error('email')
			<div class="text-danger"><p>This email has already been verified. please check your emails for the credentials. Please check the spam as well.</p></div>
			<div class="text-primary"><p>This error may occur if you have already submitted an application form using this portal. However, if you wish to purchase another application form having the same email address, please click <a href="{{url('newreg?email=' . $email . '&section=' . $section)}}"><strong>HERE</strong></a>.</p></div>
			<div class="text-danger"><p>Please submit the first application before you click the above link, because the first application will be unavailable for edit after clicking the same.</p></div>
		@enderror
		<div class = "row" style="padding-bottom: 20px;">
			<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"><label for="section">* Section</label></div>
			<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12"><input style="width:100%" type="text" readonly="readonly" id="section" name="section" value="{{$section}}"/></div>
		</div>
		<div class = "row" style="padding-bottom: 20px;">
			<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"><label for="name">* Name of Parent</label></div>
			<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12"><input style="width:100%" type="text" maxlength="250" placeholder="Enter Name of Parent" id="name" name="name" value="{{old('name')}}" /></div>
			@error('name')
				<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"></div>
				<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12 text-danger">{{$message}}</div>
			@enderror
		</div>
		<div class = "row" style="padding-bottom: 20px;">
			<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"><label for="nic">* NIC / Passport No.</label></div>
			<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12"><input style="width:100%" type="text" maxlength="20" placeholder="Enter Sri Lankan National Identiy Card Number" id="nic" name="nic" title="National Identity Card / Passport Number" value="{{old('nic')}}"/></div>
			@error('nic')
				<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"></div>
				<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12 text-danger">{{$message}}</div>
			@enderror
		</div>
		<div class = "row" style="padding-bottom: 20px;">
			<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"><label for="mobile">* Mobile Number</label></div>
			<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12"><input style="width:100%" type="text" maxlength="20" placeholder="Enter Mobile Number" id="mobile" name="mobile" value="{{old('mobile')}}"/></div>
			@error('mobile')
				<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"></div>
				<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12 text-danger">{{$message}}</div>
			@enderror
		</div>
		<div class = "row" style="padding-bottom: 20px;">
			<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"><label for="email">* Verified Email address</label></div>
			<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12"><input style="width:100%" type="email" maxlength="100" readonly value="{{$email}}"/></div>
		</div>
		@if($section == "Branch Schools")
			<div class = "row" style="padding-bottom: 20px;">
				<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"><label for="branch">* Select Branch</label></div>
				<div class="col-md-8"><select id="branch" name="branch" class="form-control">
						<option value="">Select Branch</option>
						<option value="S. Thomas' Preparatory School, Kollupitiya" @if(old('branch')=="S. Thomas' Preparatory School, Kollupitiya") selected @endif>S. Thomas' Preparatory School, Kollupitiya</option>
						<option value="S. Thomas' College, Gurutalawa" @if(old('branch')=="S. Thomas' College, Gurutalawa") selected @endif>S. Thomas' College, Gurutalawa</option>
						<option value="S. Thomas' College, Bandarawela" @if(old('branch')=="S. Thomas' College, Bandarawela") selected @endif>S. Thomas' College, Bandarawela</option>
					</select>
				</div>
				@error('branch')
					<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"></div>
					<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12 text-danger">{{$message}}</div>
				@enderror
			</div>
		@endif
		<p>Terms and conditions</p>
		<ul class="small">
			<li>I hereby certify that the particulars given above are true and correct. If they are found to be false, wrong or incorrect, I undertake to withdraw the child from S. Thomas' College, should I be requested to do so.</li>
			<li>I accept that canvassing in any form will lead to the disqualification of this application.</li>
			<li>I accept that submitting this application form does not guarantee entrance to S. Thomas' College, and that the admission process must follow its course. I will not contact the school office until I receive a feedback from the office.</li>
			<li>I accept that I will not be able to alter any information after submission, and that I have understood the admission process.</li>
			<li>I accept that the decision of S.Thomas' College shall be final and conclusive on whether to grant entrance to a child and all matters pertaining thereto and cannot be questioned</li>
			<li>I accept that this is a computer generated Application Form which does not require a physical signature</li>
		</ul>
		<div class = "row" style="padding-top: 20px;">
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-1"></div>
			<div class="col-lg-1 col-md-2 col-sm-1 col-xs-1"><input type="checkbox" id="confirm" name="confirm" /></div>
			<div class="col-lg-9 col-md-8 col-sm-9 col-xs-10"><label for="confirm">* I hereby accept and confirm the following terms and conditions</label></div>
			@error('confirm')
				<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"></div>
				<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12 text-danger">{{$message}}</div>
			@enderror
		</div>
		<p style="text-align:center"><input class="btn btn-primary btn-lg" type="submit" value="Register Now" id="submit" name="submit"/></p>
	</form>
@endsection