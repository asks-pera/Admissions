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
	<h2>A/Level Subject Selection</h2>
	<div class="row border border-dark rounded" style="margin:10px; padding:50px; display:block;">
		<form action="" method="post">
			@csrf
			<input type="hidden" value="{{$id}}" name="id" />
			<input type="hidden" value="{{$grade_sought}}" name="grade_sought" />
			@if($grade_sought == 'Not Set')
				<h3 class="color-danger">Please enter and save the details of the child in order to fill this section on the subject choices.</h3>
			@else
				<h3>Select Subjects as offered in the {{$grade_sought}} section in {{$medium}} medium.</h3>
				<div class="form-group row pt-5" style="padding-bottom: 20px;">
					<label class="col-md-4 col-form-label" for="alsubject1">* 1st Subject</label>
					<div class="col-md-8"><select id="alsubject1" name="alsubject1" class="form-control">
						<option value="">Select 1st Subject</option>
						@if($grade_sought == "A/Levels (Science Stream)")
							<option value="Physics" @if((isset($subjects)) && ($subjects['alsubject1'] == 'Physics')) selected @elseif(old('alsubject1')=='Physics') selected @endif>Physics</option>
						@elseif($grade_sought == "A/Levels (Commerce and Arts Stream)")
							@if($medium == "Sinhala")
								<option value="Business Studies" @if((isset($subjects)) && ($subjects['alsubject1'] == 'Business Studies')) selected @elseif(old('alsubject1')=='Business Studies') selected @endif>Business Studies</option>
								<option value="Divinity" @if((isset($subjects)) && ($subjects['alsubject1'] == 'Divinity')) selected @elseif(old('alsubject1')=='Divinity') selected @endif>Divinity</option>
								<option value="Geography" @if((isset($subjects)) && ($subjects['alsubject1'] == 'Geography')) selected @elseif(old('alsubject1')=='Geography') selected @endif>Geography</option>
								<option value="History" @if((isset($subjects)) && ($subjects['alsubject1'] == 'History')) selected @elseif(old('alsubject1')=='History') selected @endif>History</option>
							@elseif($medium == "Tamil")
								<option value="Business Studies" @if((isset($subjects)) && ($subjects['alsubject1'] == 'Business Studies')) selected @elseif(old('alsubject1')=='Business Studies') selected @endif>Business Studies</option>
								<option value="Divinity" @if((isset($subjects)) && ($subjects['alsubject1'] == 'Divinity')) selected @elseif(old('alsubject1')=='Divinity') selected @endif>Divinity</option>
							@elseif($medium == "English")
								<option value="Business Studies" @if((isset($subjects)) && ($subjects['alsubject1'] == 'Business Studies')) selected @elseif(old('alsubject1')=='Business Studies') selected @endif>Business Studies</option>
								<option value="Business Statistics" @if((isset($subjects)) && ($subjects['alsubject1'] == 'Business Statistics')) selected @elseif(old('alsubject1')=='Business Statistics') selected @endif>Business Statistics</option>
								<option value="Divinity" @if((isset($subjects)) && ($subjects['alsubject1'] == 'Divinity')) selected @elseif(old('alsubject1')=='Divinity') selected @endif>Divinity</option>
								<option value="Geography" @if((isset($subjects)) && ($subjects['alsubject1'] == 'Geography')) selected @elseif(old('alsubject1')=='Geography') selected @endif>Geography</option>
								<option value="Greek & Roman Civilisation" @if((isset($subjects)) && ($subjects['alsubject1'] == 'Greek & Roman Civilisation')) selected @elseif(old('alsubject1')=='Greek & Roman Civilisation') selected @endif>Greek & Roman Civilisation</option>
							@endif
						@elseif($grade_sought == "International A/Level")
							<option value="Physics" @if((isset($subjects)) && ($subjects['alsubject1'] == 'Physics')) selected @elseif(old('alsubject1')=='Physics') selected @endif>Physics</option>
							<option value="Accounts" @if((isset($subjects)) && ($subjects['alsubject1'] == 'Accounts')) selected @elseif(old('alsubject1')=='Accounts') selected @endif>Accounts</option>
							<option value="Law" @if((isset($subjects)) && ($subjects['alsubject1'] == 'Law')) selected @elseif(old('alsubject1')=='Law') selected @endif>Law</option>
							<option value="English Literature" @if((isset($subjects)) && ($subjects['alsubject1'] == 'English Literature')) selected @elseif(old('alsubject1')=='English Literature') selected @endif>English Literature</option>
						@endif
					</select></div>
					@error('alsubject1')<div class="col-md-4"></div><div class="col-md-8 text-danger">{{$message}}</div>@enderror
				</div>
				<div class="form-group row pt-5" style="padding-bottom: 20px;">
					<label class="col-md-4 col-form-label" for="alsubject2">* 2nd Subject</label>
					<div class="col-md-8"><select id="alsubject2" name="alsubject2" class="form-control">
						<option value="">Select 2nd Subject</option>
						@if($grade_sought == "A/Levels (Science Stream)")
							<option value="Chemistry" @if((isset($subjects)) && ($subjects['alsubject2'] == 'Chemistry')) selected @elseif(old('alsubject2')=='Chemistry') selected @endif>Chemistry</option>
							@if($medium == 'English')
								<option value="Information & Communication Technology" @if((isset($subjects)) && ($subjects['alsubject2'] == 'Information & Communication Technology')) selected @elseif(old('alsubject2')=='Information & Communication Technology') selected @endif>Information & Communication Technology</option>
							@endif
						@elseif($grade_sought == "A/Levels (Commerce and Arts Stream)")
							@if($medium == "Sinhala")
								<option value="Economics" @if((isset($subjects)) && ($subjects['alsubject2'] == 'Economics')) selected @elseif(old('alsubject2')=='Economics') selected @endif>Economics</option>
								<option value="Communication & Media studies" @if((isset($subjects)) && ($subjects['alsubject2'] == 'Communication & Media studies')) selected @elseif(old('alsubject2')=='Communication & Media studies') selected @endif>Communication & Media studies</option>
							@elseif($medium == "Tamil")
								<option value="Economics" @if((isset($subjects)) && ($subjects['alsubject2'] == 'Economics')) selected @elseif(old('alsubject2')=='Economics') selected @endif>Economics</option>
							@elseif($medium == "English")
								<option value="Economics" @if((isset($subjects)) && ($subjects['alsubject2'] == 'Economics')) selected @elseif(old('alsubject2')=='Economics') selected @endif>Economics</option>
								<option value="Communication & Media studies" @if((isset($subjects)) && ($subjects['alsubject2'] == 'Communication & Media studies')) selected @elseif(old('alsubject2')=='Communication & Media studies') selected @endif>Communication & Media studies</option>
								<option value="Information & Communication Technology" @if((isset($subjects)) && ($subjects['alsubject2'] == 'Information & Communication Technology')) selected @elseif(old('alsubject2')=='Information & Communication Technology') selected @endif>Information & Communication Technology</option>
							@endif
						@elseif($grade_sought == "International A/Level")
							<option value="Chemistry" @if((isset($subjects)) && ($subjects['alsubject2'] == 'Chemistry')) selected @elseif(old('alsubject2')=='Chemistry') selected @endif>Chemistry</option>
							<option value="Economics" @if((isset($subjects)) && ($subjects['alsubject2'] == 'Economics')) selected @elseif(old('alsubject2')=='Economics') selected @endif>Economics</option>
							<option value="Information & Communication Technology" @if((isset($subjects)) && ($subjects['alsubject2'] == 'Information & Communication Technology')) selected @elseif(old('alsubject2')=='Information & Communication Technology') selected @endif>Information & Communication Technology</option>
							<option value="Religious Studies" @if((isset($subjects)) && ($subjects['alsubject2'] == 'Religious Studies')) selected @elseif(old('alsubject2')=='Religious Studies') selected @endif>Religious Studies</option>
							<option value="Psychology" @if((isset($subjects)) && ($subjects['alsubject2'] == 'Psychology')) selected @elseif(old('alsubject2')=='Psychology') selected @endif>Psychology</option>
						@endif
					</select></div>
					@error('alsubject2')<div class="col-md-4"></div><div class="col-md-8 text-danger">{{$message}}</div>@enderror
				</div>
				<div class="form-group row pt-5" style="padding-bottom: 20px;">
					<label class="col-md-4 col-form-label" for="alsubject3">* 3rd Subject</label>
					<div class="col-md-8"><select id="alsubject3" name="alsubject3" class="form-control">
						<option value="">Select 3rd Subject</option>
						@if($grade_sought == "A/Levels (Science Stream)")
							<option value="Biology" @if((isset($subjects)) && ($subjects['alsubject3'] == 'Biology')) selected @elseif(old('alsubject3')=='Biology') selected @endif>Biology</option>
							<option value="Combined Mathematics" @if((isset($subjects)) && ($subjects['alsubject3'] == 'Combined Mathematics')) selected @elseif(old('alsubject3')=='Combined Mathematics') selected @endif>Combined Mathematics</option>
						@elseif($grade_sought == "A/Levels (Commerce and Arts Stream)")
							@if($medium == "Sinhala")
								<option value="Accounts" @if((isset($subjects)) && ($subjects['alsubject3'] == 'Accounts')) selected @elseif(old('alsubject3')=='Accounts') selected @endif>Accounts</option>
								<option value="Logic" @if((isset($subjects)) && ($subjects['alsubject3'] == 'Logic')) selected @elseif(old('alsubject3')=='Logic') selected @endif>Logic</option>
								<option value="Political Science" @if((isset($subjects)) && ($subjects['alsubject3'] == 'Political Science')) selected @elseif(old('alsubject3')=='Political Science') selected @endif>Political Science</option>
							@elseif($medium == "Tamil")
								<option value="Accounts" @if((isset($subjects)) && ($subjects['alsubject3'] == 'Accounts')) selected @elseif(old('alsubject3')=='Accounts') selected @endif>Accounts</option>
							@elseif($medium == "English")
								<option value="Accounts" @if((isset($subjects)) && ($subjects['alsubject3'] == 'Accounts')) selected @elseif(old('alsubject3')=='Accounts') selected @endif>Accounts</option>
								<option value="Logic" @if((isset($subjects)) && ($subjects['alsubject3'] == 'Logic')) selected @elseif(old('alsubject3')=='Logic') selected @endif>Logic</option>
								<option value="Political Science" @if((isset($subjects)) && ($subjects['alsubject3'] == 'Political Science')) selected @elseif(old('alsubject3')=='Political Science') selected @endif>Political Science</option>
								<option value="English Literature" @if((isset($subjects)) && ($subjects['alsubject3'] == 'English Literature')) selected @elseif(old('alsubject3')=='English Literature') selected @endif>English Literature</option>
								<option value="Japanese" @if((isset($subjects)) && ($subjects['alsubject3'] == 'Japanese')) selected @elseif(old('alsubject3')=='Japanese') selected @endif>Japanese</option>
							@endif
						@elseif($grade_sought == "International A/Level")
							<option value="Biology" @if((isset($subjects)) && ($subjects['alsubject3'] == 'Biology')) selected @elseif(old('alsubject3')=='Biology') selected @endif>Biology</option>
							<option value="Business Studies" @if((isset($subjects)) && ($subjects['alsubject3'] == 'Business Studies')) selected @elseif(old('alsubject3')=='Business Studies') selected @endif>Business Studies</option>
							<option value="Further Mathematics" @if((isset($subjects)) && ($subjects['alsubject3'] == 'Further Mathematics')) selected @elseif(old('alsubject3')=='Further Mathematics') selected @endif>Further Mathematics</option>
						@endif
					</select></div>
					@error('alsubject3')<div class="col-md-4"></div><div class="col-md-8 text-danger">{{$message}}</div>@enderror
				</div>
				<div class="form-group row pt-5" style="padding-bottom: 20px;">
					<label class="col-md-4 col-form-label" for="alsubject4">* 4th Subject</label>
					<div class="col-md-8"><select id="alsubject4" name="alsubject4" class="form-control">
						<option value="">Select 4th Subject</option>
						@if(($grade_sought == "A/Levels (Science Stream)") || ($grade_sought == "A/Levels (Commerce and Arts Stream)"))
							<option value="General English" @if((isset($subjects)) && ($subjects['alsubject4'] == 'General English')) selected @elseif(old('alsubject4')=='General English') selected @endif>General English</option>
						@elseif($grade_sought == "International A/Level")
							<option value="Further Mathematics" @if((isset($subjects)) && ($subjects['alsubject4'] == 'Further Mathematics')) selected @elseif(old('alsubject4')=='Further Mathematics') selected @endif>Further Mathematics</option>
							<option value="English Language" @if((isset($subjects)) && ($subjects['alsubject4'] == 'English Language')) selected @elseif(old('alsubject4')=='English Language') selected @endif>English Language</option>
							<option value="History" @if((isset($subjects)) && ($subjects['alsubject4'] == 'History')) selected @elseif(old('alsubject4')=='History') selected @endif>History</option>
							<option value="Mathematics" @if((isset($subjects)) && ($subjects['alsubject4'] == 'Mathematics')) selected @elseif(old('alsubject4')=='Mathematics') selected @endif>Mathematics</option>
						@endif
					</select></div>
					@error('alsubject4')<div class="col-md-4"></div><div class="col-md-8 text-danger">{{$message}}</div>@enderror
				</div>
			@endif
			<div class="row">
				<div class="col-md-6 text-center"><a class="btn btn-primary btn-lg" style="margin:10px 0;" type="button" href="{{url('application/status')}}">Back</a></div>
				<div class="col-md-6 text-center"><input class="btn btn-primary btn-lg" style="margin:10px 0;" type="submit" @if(!isset($subjects)) value="Save Data" @else value="Update Data" @endif id="cmdSave" name="cmdSave"/></div>
			</div>
		</form>
	</div>
@endsection