@extends('layout')

@section('header')
	<script type="text/javascript">
		function MotherStaff() {
			document.getElementById('motherstaffbox').hidden = !document.getElementById('mother_staff').checked;
		}

		function FatherStaff() {
			document.getElementById('fatherstaffbox').hidden = !document.getElementById('father_staff').checked;
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
	<h2>STC STAFF Details</h2>
	<div class="row border border-dark rounded" style="margin:10px; padding:50px; display:block;">
		<form action="" method="post">
			@csrf
			<input type="hidden" value="{{$id}}" name="id" />
			<div class="form-group border border-dark rounded p-3">
				<div class="row">
					<label class="col-md-6 col-form-label" for="mother_staff">Is the mother a member of the College Staff?</label>
					<div class="col-md-1"><input class="form-control mt-3" type="checkbox" id="mother_staff" name="mother_staff" onchange='MotherStaff()' @if(isset($staff) && $staff['mother_staff'] == 1) checked @elseif(old('mother_staff')) checked @endif/></div>
					<div class="col-5"></div>
				</div>
				<div id="motherstaffbox" @if(isset($staff)) @if($staff['mother_staff'] == 0) hidden @endif @elseif(old('mother_staff') == 0) hidden @endif">
					<div class="form-group row" style="padding-bottom: 20px;">
						<label class="col-md-4 col-form-label" for="mother_name">* Name</label>
						<div class="col-md-8"><input class="form-control" type="text" id="mother_name" name="mother_name" value="@if(isset($staff)){{$staff['mother_name']}}@else{{old('mother_name')}}@endif"/></div>
						@error('mother_name')
							<div class="col-md-4"></div>
							<div class="col-md-8 text-danger">{{$message}}</div>
						@enderror
					</div>
					<div class = "form-group row" style="padding-bottom: 20px;">
						<label class="col-md-4 col-form-label" for="mother_joined">* Date Joined</label>
						<div class="col-md-8"><input class="form-control" type="date" id="mother_joined" name="mother_joined" value="@if(isset($staff)){{$staff['mother_joined']}}@else{{old('mother_joined')}}@endif" /></div>
						@error('mother_joined')
							<div class="col-md-4"></div>
							<div class="col-md-8 text-danger">{{$message}}</div>
						@enderror
					</div>
					<div class="form-group row" style="padding-bottom: 20px;">
						<label class="col-md-4 col-form-label" for="mother_section">* Name of Section</label>
						<div class="col-md-8"><input class="form-control" type="text" id="mother_section" name="mother_section" value="@if(isset($staff)){{$staff['mother_section']}}@else{{old('mother_section')}}@endif"/></div>
						@error('mother_section')
							<div class="col-md-4"></div>
							<div class="col-md-8 text-danger">{{$message}}</div>
						@enderror
					</div>
					<div class="form-group row" style="padding-bottom: 20px;">
						<label class="col-md-4 col-form-label" for="mother_EPF">* EPF Number</label>
						<div class="col-md-8"><input class="form-control" type="text" id="mother_EPF" name="mother_EPF" value="@if(isset($staff)){{$staff['mother_EPF']}}@else{{old('mother_EPF')}}@endif"/></div>
						@error('mother_EPF')
							<div class="col-md-4"></div>
							<div class="col-md-8 text-danger">{{$message}}</div>
						@enderror
					</div>
				</div>
			</div>
			<div class="form-group border border-dark rounded p-3">
				<div class="row">
					<label class="col-md-6 col-form-label" for="father_staff">Is the father a member of the College Staff?</label>
					<div class="col-md-1"><input class="form-control mt-3" type="checkbox" id="father_staff" name="father_staff" onchange='FatherStaff()' @if(isset($staff) && $staff['father_staff'] == 1) checked @elseif(old('father_staff')) checked @endif/></div>
					<div class="col-5"></div>
				</div>
				<div id="fatherstaffbox" @if(isset($staff)) @if($staff['father_staff'] == 0) hidden @endif @elseif(old('father_staff') == 0) hidden @endif">
					<div class="form-group row" style="padding-bottom: 20px;">
						<label class="col-md-4 col-form-label" for="father_name">* Name</label>
						<div class="col-md-8"><input class="form-control" type="text" id="father_name" name="father_name" value="@if(isset($staff)){{$staff['father_name']}}@else{{old('father_name')}}@endif"/></div>
						@error('father_name')
							<div class="col-md-4"></div>
							<div class="col-md-8 text-danger">{{$message}}</div>
						@enderror
					</div>
					<div class = "form-group row" style="padding-bottom: 20px;">
						<label class="col-md-4 col-form-label" for="father_joined">* Date Joined</label>
						<div class="col-md-8"><input class="form-control" type="date" id="father_joined" name="father_joined" value="@if(isset($staff)){{$staff['father_joined']}}@else{{old('father_joined')}}@endif" /></div>
						@error('father_joined')
							<div class="col-md-4"></div>
							<div class="col-md-8 text-danger">{{$message}}</div>
						@enderror
					</div>
					<div class="form-group row" style="padding-bottom: 20px;">
						<label class="col-md-4 col-form-label" for="father_section">* Name of Section</label>
						<div class="col-md-8"><input class="form-control" type="text" id="father_section" name="father_section" value="@if(isset($staff)){{$staff['father_section']}}@else{{old('father_section')}}@endif"/></div>
						@error('father_section')
							<div class="col-md-4"></div>
							<div class="col-md-8 text-danger">{{$message}}</div>
						@enderror
					</div>
					<div class="form-group row" style="padding-bottom: 20px;">
						<label class="col-md-4 col-form-label" for="father_EPF">* EPF Number</label>
						<div class="col-md-8"><input class="form-control" type="text" id="father_EPF" name="father_EPF" value="@if(isset($staff)){{$staff['father_EPF']}}@else{{old('father_EPF')}}@endif"/></div>
						@error('father_EPF')
							<div class="col-md-4"></div>
							<div class="col-md-8 text-danger">{{$message}}</div>
						@enderror
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 text-center"><a class="btn btn-primary btn-lg" style="margin:10px 0;" type="button" href="{{url('application/status')}}">Back</a></div>
				<div class="col-md-6 text-center"><input class="btn btn-primary btn-lg" style="margin:10px 0;" type="submit" @if(!isset($staff)) value="Save Data" @else value="Update Data" @endif id="cmdSave" name="cmdSave"/></div>
			</div>
		</form>
	</div>
@endsection