@extends('layout')

@section('header')
<script type='text/javascript'>
	function religionselected() {
		document.getElementById('divChristian').hidden = !(document.getElementById('religion').value == "Christian");
	}

	function genderSelected() {
		document.getElementById('divMedium').hidden = !(document.getElementById('gender').value == "Boy");
	}

	function gradeSelected() {
		var grade = document.getElementById('grade_sought').value;
		var medium = document.getElementById('medium');
		for(var i = medium.length; i >= 0 ; i--) {
			medium.remove(i);
		}
		if(grade == "International A/Level"){
			medium.append(new Option('English', 'English'));
			return;
		}
		medium.append(new Option('Select Medium', ''));
		medium.append(new Option('Sinhala', 'Sinhala'));
		medium.append(new Option('Tamil', 'Tamil'));
		switch (grade) {
			case "Upper 4 (Grade 7)" :
			case "Form 5 (Grade 8)" :
			case "Lower 6 (Grade 9)" : 
				medium.append(new Option('Bi-Lingual (Sinhala with English)', 'Bi-Lingual (Sinhala with English)'));
				medium.append(new Option('Bi-Lingual (Tamil with English)', 'Bi-Lingual (Tamil with English)'));
				break;
			case "A/Levels (Science Stream)":
			case "A/Levels (Commerce and Arts Stream)" :
				medium.append(new Option('English', 'English'));
				break;
		}
	}

	function selectMedium(value) {
		document.getElementById('medium').value = value;
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
	@if(isset($child))
		<div id="student_picture"><img src="{{url('/uploads/' . $child['picture'] . '')}}" height='120' alt="" style='float:right' /></div>
	@endif
	<h2>Child's Details</h2>
	<div class="row border border-dark rounded" style="margin:10px; padding:50px; display:block;">
		<form action="" method="post" enctype="multipart/form-data">
			@csrf
			<input type="hidden" value="{{$id}}" name="id" />
			<input type="hidden" value="{{$section}}" name="section" />
			<div class = "form-group row" style="padding-bottom: 20px;">
				<label for="surname" class="col-md-4 col-form-label">* Surname</label>
				<div class="col-md-8"><input type="text" class="form-control" maxlength="50" placeholder="Enter surname of child" id="surname" name="surname" value="@if(isset($child)){{ $child['surname'] }}@else{{old('surname')}}@endif"/></div>
				@error('surname')<div class="col-md-4"></div><div class="col-md-8 text-danger">{{$message}}</div>@enderror
				<small>Note: Surname as per birth certificate.</small>
			</div>
			<div class = "form-group row" style="padding-bottom: 20px;">
				<label for="other_names" class="col-md-4 col-form-label">* Other names</label>
				<div class="col-md-8"><input class="form-control" type="text" maxlength="100" placeholder="Enter other names of the child" id="other_names" name="other_names" value="@if(isset($child)){{ $child['other_names'] }}@else{{old('other_names')}}@endif" /></div>
				@error('other_names')<div class="col-md-4"></div><div class="col-md-8 text-danger">{{$message}}</div>@enderror
				<small>Note: Other names as per birth certificate.</small>
			</div>
			<div class = "form-group row" style="padding-bottom: 20px;">
				<label class="col-md-4 col-form-label" for="bc_num">* Birth Certificate Number</label>
				<div class="col-md-8"><input class="form-control" type="text" maxlength="100" placeholder="Birth Certificate Number" id="bc_num" name="bc_num" value="@if(isset($child)){{ $child['bc_num'] }}@else{{old('bc_num')}}@endif" /></div>
				@error('bc_num')<div class="col-md-4"></div><div class="col-md-8 text-danger">{{$message}}</div>@enderror
			</div>
			@if($section == "Nursery")
				<div class = "form-group row" style="padding-bottom: 20px;">
					<label class="col-md-4 col-form-label" for="gender">* Gender</label>
					<div class="col-md-8"><select id="gender" name="gender" class="form-control" onchange="genderSelected()">
						<option value="">Select Gender</option>
						<option value="Boy" @if((isset($child)) && ($child['gender'] == 'Boy')) selected @elseif(old('gender')=='Boy') selected @endif>Boy</option>
						<option value="Girl" @if((isset($child)) && ($child['gender'] == 'Girl')) selected @elseif(old('gender')=='Girl') selected @endif>Girl</option>
					</select></div>
					@error('gender')<div class="col-md-4"></div><div class="col-md-8 text-danger">{{$message}}</div>@enderror
				</div>
			@endif
			<div class = "form-group row" style="padding-bottom: 20px;">
				<label class="col-md-4 col-form-label" for="dob">* Date of Birth</label>
				<div class="col-md-8"><input class="form-control" type="date" name="dob" id="dob" value="@if(isset($child)){{ $child['dob'] }}@else{{old('dob')}}@endif" /></div>
				@error('dob')<div class="col-md-4"></div><div class="col-md-8 text-danger">{{$message}}</div>@enderror
			</div><br/>
			<div class = "form-group row" style="padding-bottom: 20px;">
				<label class="col-md-4 col-form-label" for="present_school">* Name of present school (including pre-school)</label>
				<div class="col-md-8"><input class="form-control" type="text" maxlength="100" placeholder="Name of present school (including pre-school)" id="present_school" name="present_school" value="@if(isset($child)){{ $child['present_school'] }}@else{{old('present_school')}}@endif" /></div>
				@error('present_school')<div class="col-md-4"></div><div class="col-md-8 text-danger">{{$message}}</div>@enderror
			</div>
			@if(($section != 'Nursery') && ($section != 'Kindergarten (Grade 1)'))
				<div class = "form-group row" style="padding-bottom: 20px;">
					<label class="col-md-4 col-form-label" for="present_school_joined">Joining date of present school</label>
					<div class="col-md-8"><input class="form-control" type="date" placeholder="Joining date of the present school" id="present_school_joined" name="present_school_joined" value="@if(isset($child)){{ $child['present_school_joined'] }}@else{{old('present_school_joined')}}@endif" /></div>
				</div>
				@error('present_school_joined')<div class="col-md-4"></div><div class="col-md-8 text-danger">{{$message}}</div>@enderror
				<div class = "form-group row" style="padding-bottom: 20px;">
					<label class="col-md-4 col-form-label" for="previous_schools">Names of Previous schools (if any)</label>
					<div class="col-md-8"><input class="form-control" type="text" maxlength="100" placeholder="Names of Previous schools (if any)" id="previous_schools" name="previous_schools" value="@if(isset($child)){{ $child['previous_schools'] }}@else{{old('previous_schools')}}@endif" /></div>
				</div>
				@error('previous_schools')<div class="col-md-4"></div><div class="col-md-8 text-danger">{{$message}}</div>@enderror
			@endif
			<div class = "form-group row" style="padding-bottom: 20px;">
				<label class="col-md-4 col-form-label" for="grade_sought">* Grade / Section to which admission is sought</label>
				<div class="col-md-8"><select class="form-control" id="grade_sought" name="grade_sought" onchange="gradeSelected()" />
					<option value="">Select Grade / Section</option>
					@if($section == "Nursery")
						<option value="Nursery 2+" @if(isset($child) && $child['grade_sought'] == 'Nursery 2+') selected @elseif(old('grade_sought')=='Nursery 2+') selected @endif>Nursery 2+</option>
						<option value="Nursery 3+" @if(isset($child) && $child['grade_sought'] == 'Nursery 3+') selected @elseif(old('grade_sought')=='Nursery 3+') selected @endif>Nursery 3+</option>
						<option value="Nursery 4+" @if(isset($child) && $child['grade_sought'] == 'Nursery 4+') selected @elseif(old('grade_sought')=='Nursery 4+') selected @endif>Nursery 4+</option>
					@elseif($section == "Kindergarten (Grade 1)")
						<option value="Kindergarten (Grade 1)" @if(isset($child) && $child['grade_sought'] == 'Kindergarten (Grade 1)') selected @elseif(old('grade_sought')=='Kindergarten (Grade 1)') selected @endif>Kindergarten (Grade 1)</option>
					@elseif($section == "Other Grades")
						<option value="Form 1 (Grade 2)" @if(isset($child) && $child['grade_sought'] == 'Form 1 (Grade 2)') selected @elseif(old('grade_sought')=='Form 1 (Grade 2)') selected @endif>Form 1 (Grade 2)</option>
						<option value="Form 2 (Grade 3)" @if(isset($child) && $child['grade_sought'] == 'Form 2 (Grade 3)') selected @elseif(old('grade_sought')=='Form 2 (Grade 3)') selected @endif>Form 2 (Grade 3)</option>
						<option value="Lower 3 (Grade 4)" @if(isset($child) && $child['grade_sought'] == 'Lower 3 (Grade 4)') selected @elseif(old('grade_sought')=='Lower 3 (Grade 4)') selected @endif>Lower 3 (Grade 4)</option>
						<option value="Upper 3 (Grade 5)" @if(isset($child) && $child['grade_sought'] == 'Upper 3 (Grade 5)') selected @elseif(old('grade_sought')=='Upper 3 (Grade 5)') selected @endif>Upper 3 (Grade 5)</option>
						<option value="Upper 4 (Grade 7)" @if(isset($child) && $child['grade_sought'] == 'Upper 4 (Grade 7)') selected @elseif(old('grade_sought')=='Upper 4 (Grade 7)') selected @endif>Upper 4 (Grade 7)</option>
						<option value="Form 5 (Grade 8)" @if(isset($child) && $child['grade_sought'] == 'Form 5 (Grade 8)') selected @elseif(old('grade_sought')=='Form 5 (Grade 8)') selected @endif>Form 5 (Grade 8)</option>
						<option value="Lower 6 (Grade 9)" @if(isset($child) && $child['grade_sought'] == 'Lower 6 (Grade 9)') selected @elseif(old('grade_sought')=='Lower 6 (Grade 9)') selected @endif>Lower 6 (Grade 9)</option>
						<!--<option value="Middle 6 (Grade 10)" @if(isset($child) && $child['grade_sought'] == 'Middle 6 (Grade 10)') selected @elseif(old('grade_sought')=='Middle 6 (Grade 10)') selected @endif>Middle 6 (Grade 10)</option>-->
					@elseif($section == 'Grade 6')
						<option value="Lower 4 (Grade 6)" @if(isset($child) && $child['grade_sought'] == 'Lower 4 (Grade 6)') selected @elseif(old('grade_sought')=='Lower 4 (Grade 6)') selected @endif>Lower 4 (Grade 6)</option>
					@elseif($section == "International ALevels")
						<option value="International A/Level" @if(isset($child) && $child['grade_sought'] == 'International A/Level') selected @elseif(old('grade_sought')=='International A/Level') selected @endif>International A/Level</option>
					@else
						<option value="A/Levels (Science Stream)" @if(isset($child) && $child['grade_sought'] == 'A/Levels (Science Stream)') selected @elseif(old('grade_sought')=='A/Levels (Science Stream)') selected @endif>A/Levels (Science Stream)</option>
						<option value="A/Levels (Commerce and Arts Stream)" @if(isset($child) && $child['grade_sought'] == 'A/Levels (Commerce and Arts Stream)') selected @elseif(old('grade_sought')=='A/Levels (Commerce and Arts Stream)') selected @endif>A/Levels (Commerce and Arts Stream)</option>
						<option value="International A/Level" @if(isset($child) && $child['grade_sought'] == 'International A/Level') selected @elseif(old('grade_sought')=='International A/Level') selected @endif>International A/Level</option>
					@endif
				</select></div>
				@error('grade_sought')<div class="col-md-4"></div><div class="col-md-8 text-danger">{{$message}}</div>@enderror
			</div>
			@if($section == "Nursery") 
				<div class="form-group row" style="padding-bottom: 20px;" id="divMedium" @if(isset($child)) @if($child['gender'] != 'Boy') hidden @endif @elseif(old('gender')!='Boy') hidden @endif>
					<label class="col-md-4 col-form-label" for="medium">* Medium at Kindergarten (Grade 1)</label>
					<div class="col-md-8"><select class="form-control" id="medium" name="medium">
						<option value="">Select Medium</option>
						<option value="Sinhala" @if(isset($child)) @if($child['medium'] == 'Sinhala') selected @endif @elseif(old('medium')=='Sinhala') selected @endif>Sinhala</option>
						<option value="Tamil" @if(isset($child)) @if($child['medium'] == 'Tamil') selected @endif @elseif(old('medium')=='Tamil') selected @endif>Tamil</option>
					</select></div>
					@error('medium')<div class="col-md-4"></div><div class="col-md-8 text-danger">{{$message}}</div>@enderror
				</div>
			@else
				<div class = "form-group row" style="padding-bottom: 20px;" id="divmedium">
					<label class="col-md-4 col-form-label" for="medium">* Medium</label>
					<div class="col-md-8"><select class="form-control" id="medium" name="medium"/>
						<option value="">Select Medium</option>
					</select></div>
					@error('medium')<div class="col-md-4"></div><div class="col-md-8 text-danger">{{$message}}</div>@enderror
				</div>
			@endif
			<div class = "form-group row" style="padding-bottom: 20px;">
				<label class="col-md-4 col-form-label" for="religion">* Religion</label>
				<div class="col-md-8"><select id="religion" name="religion" class="form-control" onchange="religionselected()">
					<option value="">Select Religion</option>
					<option value="Christian" @if((isset($child)) && ($child['religion'] == 'Christian')) selected @elseif(old('religion')=='Christian') selected @endif>Christian</option>
					<option value="Buddhist" @if((isset($child)) && ($child['religion'] == 'Buddhist')) selected @elseif(old('religion')=='Buddhist') selected @endif>Buddhist</option>
					<option value="Islam" @if((isset($child)) && ($child['religion'] == 'Islam')) selected @elseif(old('religion')=='Islam') selected @endif>Islam</option>
					<option value="Hinduism" @if((isset($child)) && ($child['religion'] == 'Hinduism')) selected @elseif(old('religion')=='Hinduism') selected @endif>Hinduism</option>
				</select></div>
				@error('religion')<div class="col-md-4"></div><div class="col-md-8 text-danger">{{$message}}</div>@enderror
			</div>
			<div id="divChristian" @if(isset($child)) @if ($child['religion'] != 'Christian') hidden @endif @elseif(old('religion')!='Christian') hidden @endif>
				<div class = "form-group row" style="padding-bottom: 20px;">
					<label class="col-md-4 col-form-label" for="denomination">* Denomination</label>
					<div class="col-md-8"><input class="form-control" type="text" maxlength="50" placeholder="Denomination" id="denomination" name="denomination" value="@if(isset($child)){{ $child['denomination'] }}@else{{old('denomination')}}@endif" /></div>
					@error('denomination')<div class="col-md-4"></div><div class="col-md-8 text-danger">{{$message}}</div>@enderror
				</div>
				<div class = "form-group row" style="padding-bottom: 20px;">
					<label class="col-md-4 col-form-label" for="baptism_date">* Date of baptism of child</label>
					<div class="col-md-8"><input class="form-control" type="date" id="baptism_date" name="baptism_date" value="@if(isset($child)){{ $child['baptism_date'] }}@else{{old('baptism_date')}}@endif"/></div>
					@error('baptism_date')<div class="col-md-4"></div><div class="col-md-8 text-danger">{{$message}}</div>@enderror
				</div>
			</div>
			<div class = "form-group row" style="padding-bottom: 20px;">
				<label class="col-md-4 col-form-label" for="picture">* Upload recent photograph<br/><small>Max file size = 1Mb</small></label>
				<div class="col-md-8"><input class="form-control" type="file" name="picture" id="picture" accept="image/*" /></div>
				<input type="hidden" name="file" value="@if(isset($child)){{ $child['picture'] }}@else{{old('picture')}}@endif" />
				@error('picture')<div class="col-md-4"></div><div class="col-md-8 text-danger">{{$message}}</div>@enderror
			</div>
			<div class="row">
				<div class="col-md-6 text-center"><a class="btn btn-primary btn-lg" style="margin:10px 0;" type="button" href="{{url('application/status')}}">Back</a></div>
				<div class="col-md-6 text-center"><input class="btn btn-primary btn-lg" style="margin:10px 0;" type="submit" @if(!isset($child)) value="Save Data" @else value="Update Data" @endif id="cmdSave" name="cmdSave"/></div>
			</div>
		</form>
	</div>
	<script>
		gradeSelected();
	</script>
	@if(isset($child))
		<script>
			selectMedium("{{$child['medium']}}");
		</script>
	@elseif(old('medium'))
		<script>
			selectMedium("{{old('medium')}}");
		</script>
	@endif
@endsection