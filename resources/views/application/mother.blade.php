@extends('layout')

@section('header')
<script type='text/javascript'>
	function religionselected() {
		document.getElementById('divChristian').hidden = !(document.getElementById('religion').value == "Christian");
		document.getElementById('divOther').hidden = !(document.getElementById('religion').value == "Other");
	}
</script>
@endsection

@section('navigation')
	<a style="margin: 0px 10px" class="btn btn-primary btn-primary" href="{{url('application/status')}}">Back</a>
@endsection

@section('year')
	- {{$year}}
@endsection

@section('content')
	<div id="student_picture"><img src="{{url('/uploads/' . $picture . '')}}" height='120' alt="" style='float:right' /></div>
	<h2>Mother's Details</h2>
	<div class="row border border-dark rounded" style="margin:10px; padding:50px; display:block;">
		<form action="" method="post">
			@csrf
			<input type="hidden" value="{{$id}}" name="id" />
			<div class = "form-group row" style="padding-bottom: 20px;">
				<label for="name" class="col-md-4 col-form-label">* Name</label>
				<div class="col-md-8"><input type="text" class="form-control" maxlength="50" placeholder="Enter Name of Mother" id="name" name="name" value="@if(isset($mother)){{$mother['name']}}@else{{old('name')}}@endif"/></div>
				@error('name')
					<div class="col-md-4"></div>
					<div class="col-md-8 text-danger">{{$message}}</div>
				@enderror
			</div>
			<div class = "form-group row" style="padding-bottom: 20px;">
				<label for="occupation" class="col-md-4 col-form-label">* Occupation</label>
				<div class="col-md-8"><input class="form-control" type="text" maxlength="100" placeholder="Enter Occupation of the Mother" id="occupation" name="occupation" value="@if(isset($mother)){{$mother['occupation']}}@else{{old('occupation')}}@endif" /></div>
				@error('occupation')
					<div class="col-md-4"></div>
					<div class="col-md-8 text-danger">{{$message}}</div>
				@enderror
			</div>
			<div class = "form-group row" style="padding-bottom: 20px;">
				<label for="employment" class="col-md-4 col-form-label">* Employment</label>
				<div class="col-md-8"><textarea class="form-control" style="height:75px" maxlength="500" placeholder="Enter Employment details of the Mother" id="employment" name="employment">@if(isset($mother)){{$mother['employment']}}@else{{old('employment')}}@endif</textarea></div>
				@error('employment')
					<div class="col-md-4"></div>
					<div class="col-md-8 text-danger">{{$message}}</div>
				@enderror
			</div>
			<div class = "form-group row" style="padding-bottom: 20px;">
				<label for="mobile" class="col-md-4 col-form-label">* Mobile</label>
				<div class="col-md-8"><input class="form-control" type="text" maxlength="100" placeholder="Enter Mobile number of the Mother" id="mobile" name="mobile" value="@if(isset($mother)){{$mother['mobile']}}@else{{old('mobile')}}@endif" /></div>
				@error('mobile')
					<div class="col-md-4"></div>
					<div class="col-md-8 text-danger">{{$message}}</div>
				@enderror
			</div>
			<div class = "form-group row" style="padding-bottom: 20px;">
				<label for="email" class="col-md-4 col-form-label">* Email</label>
				<div class="col-md-8"><input class="form-control" type="text" maxlength="100" placeholder="Enter Email address of the Mother" id="email" name="email" value="@if(isset($mother)){{$mother['email']}}@else{{old('email')}}@endif" /></div>
				@error('email')
					<div class="col-md-4"></div>
					<div class="col-md-8 text-danger">{{$message}}</div>
				@enderror
			</div>
			<div class = "form-group row" style="padding-bottom: 20px;">
				<label for="address" class="col-md-4 col-form-label">* Residential Address</label>
				<div class="col-md-8"><textarea class="form-control" style="height:75px" maxlength="500" placeholder="Enter residential address" id="address" name="address">@if(isset($mother)){{$mother['address']}}@else{{old('address')}}@endif</textarea></div>
				@error('address')
					<div class="col-md-4"></div>
					<div class="col-md-8 text-danger">{{$message}}</div>
				@enderror
			</div>
			<div class = "form-group row" style="padding-bottom: 20px;">
				<label class="col-md-4 col-form-label" for="religion">* Religion</label>
				<div class="col-md-8"><select id="religion" name="religion" class="form-control" onchange="religionselected()">
					<option value="">Select Religion</option>
					<option value="Christian" @if((isset($mother)) && ($mother['religion'] == 'Christian')) selected @elseif(old('religion')=='Christian') selected @endif>Christian</option>
					<option value="Buddhist" @if((isset($mother)) && ($mother['religion'] == 'Buddhist')) selected @elseif(old('religion')=='Buddhist') selected @endif>Buddhist</option>
					<option value="Islam" @if((isset($mother)) && ($mother['religion'] == 'Islam')) selected @elseif(old('religion')=='Islam') selected @endif>Islam</option>
					<option value="Hinduism" @if((isset($mother)) && ($mother['religion'] == 'Hinduism')) selected @elseif(old('religion')=='Hinduism') selected @endif>Hinduism</option>
					<option value="Other" @if((isset($mother)) && ($mother['religion'] == 'Other')) selected @elseif(old('religion')=='Other') selected @endif>Other</option>
				</select></div>
				@error('religion')
					<div class="col-md-4"></div>
					<div class="col-md-8 text-danger">{{$message}}</div>
				@enderror
			</div>
			<div id="divChristian" @if(isset($mother)) @if ($mother['religion'] != 'Christian') hidden @endif @elseif(old('religion')!='Christian') hidden @endif>
				<div class = "form-group row" style="padding-bottom: 20px;">
					<label class="col-md-4 col-form-label" for="denomination">* Denomination</label>
					<div class="col-md-8"><input class="form-control" type="text" maxlength="50" placeholder="Denomination" id="denomination" name="denomination" value="@if(isset($mother)){{ $mother['denomination'] }}@else{{old('denomination')}}@endif" /></div>
					@error('denomination')
						<div class="col-md-4"></div>
						<div class="col-md-8 text-danger">{{$message}}</div>
					@enderror
				</div>
				<div class = "form-group row" style="padding-bottom: 20px;">
					<label class="col-md-4 col-form-label" for="baptism_date">* Date of baptism</label>
					<div class="col-md-8"><input class="form-control" type="date" id="baptism_date" name="baptism_date" value="@if(isset($mother)){{$mother['baptism_date']}}@else{{old('baptism_date')}}@endif"/></div>
					@error('baptism_date')
						<div class="col-md-4"></div>
						<div class="col-md-8 text-danger">{{$message}}</div>
					@enderror
				</div>
			</div>
			<div id="divOther" @if(isset($mother)) @if ($mother['religion'] != 'Other') hidden @endif @elseif(old('religion')!='Other') hidden @endif>
				<div class = "form-group row" style="padding-bottom: 20px;">
					<label class="col-md-4 col-form-label" for="other">* Other (Specify)</label>
					<div class="col-md-8"><input class="form-control" type="text" maxlength="50" placeholder="Religion Other" id="other" name="other" value="@if(isset($mother)){{$mother['other']}}@else{{old('other')}}@endif" /></div>	
					@error('other')
						<div class="col-md-4"></div>
						<div class="col-md-8 text-danger">{{$message}}</div>
					@enderror
				</div>
			</div>
			<div class = "form-group row" style="padding-bottom: 20px;">
				<label class="col-md-4 col-form-label" for="nic">* National Identity Card / Passport Number</label>
				<div class="col-md-8"><input class="form-control" type="text" maxlength="100" placeholder="National Identity Card / Passport Number" id="nic" name="nic" value="@if(isset($mother)){{$mother['nic']}}@else{{old('nic')}}@endif" /></div>
				@error('nic')
					<div class="col-md-4"></div>
					<div class="col-md-8 text-danger">{{$message}}</div>
				@enderror
			</div>
			<div class = "form-group row" style="padding-bottom: 20px;">
				<label class="col-md-4 col-form-label" for="old_school">* Enter Mother's Old School</label>
				<div class="col-md-8"><input class="form-control" type="text" maxlength="100" placeholder="Enter the name of the Mother's old school" id="old_school" name="old_school" value="@if(isset($mother)){{$mother['old_school']}}@else{{old('old_school')}}@endif"/></div>
				@error('old_school')
					<div class="col-md-4"></div>
					<div class="col-md-8 text-danger">{{$message}}</div>
				@enderror
			</div>
			<div class = "form-group row" style="padding-bottom: 20px;">
				<label class="col-md-4 col-form-label" for="income">* Enter Mother's Monthly Income in LKR</label>
				<div class="col-md-8"><input class="form-control" type="text" maxlength="20" placeholder="Enter the monthly income of the Mother in Rs." id="income" name="income" value="@if(isset($mother)){{$mother['income']}}@else{{old('income')}}@endif"/></div>
				<small><strong>Note:</strong> Proof of this income will need to be submitted for confirmation at the interview if shortlisted.</small>
				@error('income')
					<div class="col-md-4"></div>
					<div class="col-md-8 text-danger">{{$message}}</div>
				@enderror
			</div>
			<div class="row">
				<div class="col-md-6 text-center"><a class="btn btn-primary btn-lg" style="margin:10px 0;" type="button" href="{{url('application/status')}}">Back</a></div>
				<div class="col-md-6 text-center"><input class="btn btn-primary btn-lg" style="margin:10px 0;" type="submit" @if(!isset($mother)) value="Save Data" @else value="Update Data" @endif id="cmdSave" name="cmdSave"/></div>
			</div>
		</form>
	</div>
@endsection