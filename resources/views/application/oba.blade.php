@extends('layout')

@section('header')
	<script type="text/javascript">
		function MountClick() {
			document.getElementById('MountOldBoy').hidden = !document.getElementById('mount').checked;
		}

		function GuruClick() {
			document.getElementById('GuruOldBoy').hidden = !document.getElementById('guru').checked;
		}

		function BandaClick() {
			document.getElementById('BandaOldBoy').hidden = !document.getElementById('banda').checked;
		}

		function PrepClick() {
			document.getElementById('PrepOldBoy').hidden = !document.getElementById('prep').checked;
		}

		function OBAMLClick() {
			document.getElementById('OBAML').hidden = !document.getElementById('oba_member').checked;
		}
		
		function FatherClick(src) {
		    if(src.value == "father")
		    {
		        document.getElementById('fatherOB').hidden = false;
		        document.getElementById('grandfatherOB').hidden = true;
		    }
		    
		    if(src.value == "grandfather")
		    {
		        document.getElementById('grandfatherOB').hidden = false;
		        document.getElementById('fatherOB').hidden = true;
		    }
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
	<h2>OBA Details</h2>
	<div class="row border border-dark rounded" style="margin:10px; padding:50px; display:block;">
		<form action="" method="post">
			@csrf
			<input type="hidden" value="{{$id}}" name="id" />
			<h3 style="text-align: center">Father / Grand Father is an old boy</h3>
			<div class="form-group border border-dark rounded p-3" >
			    <input type="radio" id="father" name="fathergrandfather" value="father" @if((isset($oba) && $oba['mount'] == 12) || (isset($oba) && $oba['mount'] == 2)) checked @endif/><label for="father">The <strong>father</strong> is an old boy of STC</label><br/>
                <input type="radio" id="fatherfather" name="fathergrandfather" value="fatherfather" @if((isset($oba) && $oba['mount'] == 13) || (isset($oba) && $oba['mount'] == 3)) checked @endif/><label for="fatherfather">The father is not an old boy of STC but the <strong>Father's Father</strong> is an Old Boy of STC</label><br/>
                <input type="radio" id="motherfather" name="fathergrandfather" value="motherfather" @if((isset($oba) && $oba['mount'] == 14) || (isset($oba) && $oba['mount'] == 4)) checked @endif/><label for="motherfather">The father is not an old boy of STC but the <strong>Mother's Father</strong> is an Old Boy of STC</label><br/>
                @error('fathergrandfather')
                    <div class="col-md-8 text-danger">{{$message}}</div>
                @enderror
			</div>
			<div class="form-group border border-dark rounded p-3" >
				<div class="row">
					<label class="col-md-6 col-form-label" for="mount">S. Thomas' College, Mount Lavinia</label>
					<div class="col-md-1"><input class="form-control mt-3" type="checkbox" id="mount" name="mount" onchange='MountClick()' @if(isset($oba) && $oba['mount'] >= 10) checked @elseif(old('mount')) checked @endif/></div>
					<div class="col-5"></div>
				</div>
				<div id="MountOldBoy" @if(isset($oba)) @if($oba['mount'] == 0) hidden @endif @elseif(old('mount') == 0) hidden @endif>
					<div class="form-group row" style="padding-bottom: 20px;">
						<label class="col-md-4 col-form-label" for="mount_from">* From</label>
						<div class="col-md-8"><input class="form-control" type="date" id="mount_from" name="mount_from" value="@if(isset($oba)){{$oba['mount_from']}}@else{{old('mount_from')}}@endif"/></div>
						@error('mount_from')
							<div class="col-md-4"></div>
							<div class="col-md-8 text-danger">{{$message}}</div>
						@enderror
					</div>
					<div class = "form-group row" style="padding-bottom: 20px;">
						<label class="col-md-4 col-form-label" for="mount_to">* To</label>
						<div class="col-md-8"><input class="form-control" type="date" id="mount_to" name="mount_to" value="@if(isset($oba)){{$oba['mount_to']}}@else{{old('mount_to')}}@endif" /></div>
						@error('mount_to')
							<div class="col-md-4"></div>
							<div class="col-md-8 text-danger">{{$message}}</div>
						@enderror
					</div>
					<div class = "form-group row" style="padding-bottom: 20px;">
						<label class="col-md-4 col-form-label" for="house">* House</label>
						<div class="col-md-8"><select id="house" name="house" class="form-control" >
							<option value="">Select House</option>
							<option value="Boarding" @if((isset($oba)) && ($oba['house'] == 'Boarding')) selected @elseif(old('house')=='Boarding') selected @endif>Boarding House (including Winchester)</option>
							<option value="Buck" @if((isset($oba)) && ($oba['house'] == 'Buck')) selected @elseif(old('house')=='Buck') selected @endif>Buck House</option>
							<option value="De Saram" @if((isset($oba)) && ($oba['house'] == 'De Saram')) selected @elseif(old('house')=='De Saram') selected @endif>De Saram House</option>
							<option value="Stone" @if((isset($oba)) && ($oba['house'] == 'Stone')) selected @elseif(old('house')=='Stone') selected @endif>Stone House</option>
							<option value="Wood" @if((isset($oba)) && ($oba['house'] == 'Wood')) selected @elseif(old('house')=='Wood') selected @endif>Wood House</option>
						</select></div>
						@error('house')
							<div class="col-md-4"></div>
							<div class="col-md-8 text-danger">{{$message}}</div>
						@enderror
					</div>
					<div class = "form-group row" style="padding-bottom: 20px;">
						<label class="col-md-4 col-form-label" for="admission">* Enter Father's/Grandfather's Name and Admission No. at STC</label>
						<div class="col-md-8"><input class="form-control" type="text" maxlength="100" placeholder="Name and Admission Number" id="admission" name="admission" value="@if(isset($oba)){{$oba['admission']}}@else{{old('admission')}}@endif" /></div>
						@error('admission')
							<div class="col-md-4"></div>
							<div class="col-md-8 text-danger">{{$message}}</div>
						@enderror
					</div>
				</div>
			</div>
			<div class="form-group border border-dark rounded p-3">
				<div class="row">
					<label class="col-md-6 col-form-label" for="guru">S. Thomas' College, Gurutalawa</label>
					<div class="col-md-1"><input class="form-control mt-3" type="checkbox" id="guru" name="guru" onchange='GuruClick()' @if(isset($oba) && $oba['guru'] == 1) checked @elseif(old('guru')) checked @endif/></div>
					<div class="col-md-5"></div>
				</div>
				<div id="GuruOldBoy" @if(isset($oba)) @if($oba['guru'] == 0) hidden @endif @elseif(old('guru') == 0) hidden @endif>
					<div class="form-group row">
						<label class="col-md-4 col-form-label" for="guru_from">* From</label>
						<div class="col-md-8"><input class="form-control" type="date" id="guru_from" name="guru_from" value="@if(isset($oba)){{$oba['guru_from']}}@else{{old('guru_from')}}@endif" /></div>
						@error('guru_from')
							<div class="col-md-4"></div>
							<div class="col-md-8 text-danger">{{$message}}</div>
						@enderror
					</div>
					<div class="form-group row">
						<label class="col-md-4 col-form-label" for="guru_to">* To</label>
						<div class="col-md-8"><input class="form-control" type="date" id="guru_to" name="guru_to" value="@if(isset($oba)){{$oba['guru_to']}}@else{{old('guru_to')}}@endif" /></div>
						@error('guru_to')
							<div class="col-md-4"></div>
							<div class="col-md-8 text-danger">{{$message}}</div>
						@enderror
					</div>
				</div>
			</div>
			<div class="form-group border border-dark rounded p-3">
				<div class="row">
					<label class="col-md-6 col-form-label" for="banda">S. Thomas' College, Bandarawela</label>
					<div class="col-md-1"><input class="form-control mt-3" type="checkbox" id="banda" name="banda" onchange='BandaClick()' @if(isset($oba) && $oba['banda'] == 1) checked @elseif(old('banda')) checked @endif/></div>
					<div class="col-md-5"></div>
				</div>
				<div id="BandaOldBoy" @if(isset($oba)) @if($oba['banda'] == 0) hidden @endif @elseif(old('banda') == 0) hidden @endif>
					<div class="form-group row">
						<label class="col-md-4 col-form-label" for="banda_from">* From</label>
						<div class="col-md-8"><input class="form-control" type="date" id="banda_from" name="banda_from" value="@if(isset($oba)){{$oba['banda_from']}}@else{{old('banda_from')}}@endif" /></div>
						@error('banda_from')
							<div class="col-md-4"></div>
							<div class="col-md-8 text-danger">{{$message}}</div>
						@enderror
					</div>
					<div class="form-group row">
						<label class="col-md-4 col-form-label" for="banda_to">* To</label>
						<div class="col-md-8"><input class="form-control" type="date" id="banda_to" name="banda_to" value="@if(isset($oba)){{$oba['banda_to']}}@else{{old('banda_to')}}@endif" /></div>
						@error('banda_to')
							<div class="col-md-4"></div>
							<div class="col-md-8 text-danger">{{$message}}</div>
						@enderror
					</div>
				</div>
			</div>
			<div class="form-group border border-dark rounded p-3">
				<div class="row">
					<label class="col-md-6 col-form-label" for="prep">S. Thomas' Preparatory School, Kollupitiya</label>
					<div class="col-md-1"><input class="form-control" type="checkbox" id="prep" name="prep" onchange='PrepClick()' @if(isset($oba) && $oba['prep'] == 1) checked @elseif(old('prep')) checked @endif/></div>
					<div class="col-md-5"></div>
				</div>
				<div id="PrepOldBoy" @if(isset($oba)) @if($oba['prep'] == 0) hidden @endif @elseif(old('prep') == 0) hidden @endif>
					<div class="form-group row">
						<label class="col-form-label col-md-4" for="prep_from">* From</label>
						<div class="col-md-8"><input class="form-control mt-3" type="date" id="prep_from" name="prep_from" value="@if(isset($oba)){{$oba['prep_from']}}@else{{old('prep_from')}}@endif" /></div>
						@error('prep_from')
							<div class="col-md-4"></div>
							<div class="col-md-8 text-danger">{{$message}}</div>
						@enderror
					</div>
					<div class="form-group row">
						<label class="col-md-4 col-form-label" for="prep_to">* To</label>
						<div class="col-md-8"><input class="form-control" type="date" id="prep_to" name="prep_to" value="@if(isset($oba)){{$oba['prep_to']}}@else{{old('prep_to')}}@endif" /></div>
						@error('prep_to')
							<div class="col-md-4"></div>
							<div class="col-md-8 text-danger">{{$message}}</div>
						@enderror
					</div>
				</div>
			</div>
			<hr/>
			<div class="form-group border border-dark rounded p-3">
				<div class="row">
					<label class="col-form-label col-md-6" for="oba_member">Are you a member of the Old Boy's Association of S. Thomas' College, Mount Lavinia?</label>
					<div class="col-md-1"><input class="form-control" type="checkbox" id="oba_member" name="oba_member" onchange='OBAMLClick()' @if(isset($oba) && $oba['oba_member'] == 1) checked @elseif(old('oba_member')) checked @endif/></div>
					<div class="col-md-5"></div>
				</div>
				<div id="OBAML" @if(isset($oba)) @if($oba['oba_member'] == 0) hidden @endif @elseif(old('oba_member') == 0) hidden @endif>
					<div class="form-group row">
						<label class="col-md-4 col-form-label" for="oba_date">* Date of joining the OBA</label>
						<div class="col-md-8"><input class="form-control mt-3" type="date" id="oba_date" name="oba_date" value="@if(isset($oba)){{$oba['oba_date']}}@else{{old('oba_date')}}@endif"  /></div>
						@error('oba_date')
							<div class="col-md-4"></div>
							<div class="col-md-8 text-danger">{{$message}}</div>
						@enderror
					</div>
					<div class = "form-group row">
						<label class="col-form-label col-md-4" for="oba_number">* Membership Number</label>
						<div class="col-md-8"><input class="form-control" type="text" id="oba_number" name="oba_number" value="@if(isset($oba)){{$oba['oba_number']}}@else{{old('oba_number')}}@endif" maxlength=15  /></div>
						@error('oba_number')
							<div class="col-md-4"></div>
							<div class="col-md-8 text-danger">{{$message}}</div>
						@enderror
					</div>
				</div>
			</div>
    		</div>
			<div class="row">
				<div class="col-md-6 text-center"><a class="btn btn-primary btn-lg" style="margin:10px 0;" type="button" href="{{url('application/status')}}">Back</a></div>
				<div class="col-md-6 text-center"><input class="btn btn-primary btn-lg" style="margin:10px 0;" type="submit" @if(!isset($oba)) value="Save Data" @else value="Update Data" @endif id="cmdSave" name="cmdSave"/></div>
			</div>
		</form>
	</div>
@endsection