@extends('layout')

@section('header')
	<script type="text/javascript">
		function Exam() {
			document.getElementById('exambox').hidden = !document.getElementById('scholexam').checked;
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
	<h2>Details of Examination Results</h2>
	<div class="row border border-dark rounded" style="margin:10px; padding:50px; display:block;">
		<form action="" method="post">
			@csrf
			<input type="hidden" value="{{$id}}" name="id" />
			<input type="hidden" value="{{$grade_sought}}" name="grade_sought" />
			@if($grade_sought == 'Grade 6')
				<h3>Enter Details of the Grade 5 Scholarship Examination</h3>
				<div class="row pt-5">
					<label class="col-md-6 col-form-label" for="scholexam">Did the child sit for the Grade 5 Scholarship Examination?</label>
					<div class="col-md-1"><input class="form-control mt-3" type="checkbox" id="scholexam" name="scholexam" onchange='Exam()' @if(isset($results)) @if($results['scholexam'] == 1) checked @endif @elseif(old('scholexam')) checked @endif/></div>
					<div class="col-5"></div>
				</div>
				<div id="exambox" @if(isset($results)) @if($results['scholexam'] == 0) hidden @endif @elseif(old('scholexam') == 0) hidden @endif>
					<div class="form-group row" style="padding-bottom: 20px;">
						<label class="col-md-4 col-form-label" for="scholindex">* Scholarship Examination Index Number</label>
						<div class="col-md-8"><input class="form-control" type="text" id="scholindex" name="scholindex" value="@if(isset($results)){{$results['scholindex']}}@else{{old('scholindex')}}@endif"/></div>
						@error('scholindex')
							<div class="col-md-4"></div>
							<div class="col-md-8 text-danger">{{$message}}</div>
						@enderror
					</div>
					<div class="form-group row" style="padding-bottom: 20px;">
						<label class="col-md-4 col-form-label" for="scholmark">* Scholarship Exam result</label>
						<div class="col-md-8"><input class="form-control" type="text" id="scholmark" name="scholmark" value="@if(isset($results)){{$results['scholmark']}}@else{{old('scholmark')}}@endif"/></div>
						@error('scholmark')
							<div class="col-md-4"></div>
							<div class="col-md-8 text-danger">{{$message}}</div>
						@enderror
					</div>
				</div>
			@elseif(($grade_sought == "ALevels") || ($grade_sought == 'Branch Schools'))
				@if($grade_sought == "ALevels")
					<h3>Enter Details of the G.C.E. (or International) Ordinary Level Examination Results / Pre-O/Level Term Exam Results (Pending O/Level Results)</h3>
					<div class="form-group row pt-5" style="padding-bottom: 20px;">
						<label class="col-md-4 col-form-label" for="olindex">* Examination Index Number</label>
						<div class="col-md-8"><input class="form-control" type="text" id="olindex" name="olindex" value="@if(isset($results)){{$results['olindex']}}@else{{old('olindex')}}@endif" placeholder="Enter the G.C.E. Ordinary Level Examination Index Number" /></div>
						@error('olindex')
							<div class="col-md-4"></div>
							<div class="col-md-8 text-danger">{{$message}}</div>
						@enderror
					</div>
				@elseif($grade_sought == 'Branch Schools')
					<h3>Enter Last Term Examination Results</h3>
				@endif
				<p>Enter results of the subjects that are applicable to you. If you have not sat for that exam, select "Not Applicable" in the dropdown box.</p>
				<div class="form-group row pt-5" style="padding-bottom: 20px;">
					<label class="col-md-4 col-form-label" for="olreligion">* Religion</label>
					<div class="col-md-8"><select id="olreligion" name="olreligion" class="form-control">
						<option value="">Select Result</option>
						<option value="A" @if((isset($results)) && ($results['olreligion'] == 'A')) selected @elseif(old('olreligion')=='A') selected @endif>A</option>
						<option value="B" @if((isset($results)) && ($results['olreligion'] == 'B')) selected @elseif(old('olreligion')=='B') selected @endif>B</option>
						<option value="C" @if((isset($results)) && ($results['olreligion'] == 'C')) selected @elseif(old('olreligion')=='C') selected @endif>C</option>
						<option value="S" @if((isset($results)) && ($results['olreligion'] == 'S')) selected @elseif(old('olreligion')=='S') selected @endif>S</option>
						<option value="W" @if((isset($results)) && ($results['olreligion'] == 'W')) selected @elseif(old('olreligion')=='W') selected @endif>W</option>
						<option value="NA" @if((isset($results)) && ($results['olreligion'] == 'NA')) selected @elseif(old('olreligion')=='NA') selected @endif>Not Applicable</option>
					</select></div>
					@error('olreligion')
						<div class="col-md-4"></div>
						<div class="col-md-8 text-danger">{{$message}}</div>
					@enderror
				</div>
				<div class="form-group row" style="padding-bottom: 20px;">
					<label class="col-md-4 col-form-label" for="olfirstlang">Sinhala / Tamil - First Language</label>
					<div class="col-md-8"><select id="olfirstlang" name="olfirstlang" class="form-control">
						<option value="">Select Result</option>
						<option value="A" @if((isset($results)) && ($results['olfirstlang'] == 'A')) selected @elseif(old('olfirstlang')=='A') selected @endif>A</option>
						<option value="B" @if((isset($results)) && ($results['olfirstlang'] == 'B')) selected @elseif(old('olfirstlang')=='B') selected @endif>B</option>
						<option value="C" @if((isset($results)) && ($results['olfirstlang'] == 'C')) selected @elseif(old('olfirstlang')=='C') selected @endif>C</option>
						<option value="S" @if((isset($results)) && ($results['olfirstlang'] == 'S')) selected @elseif(old('olfirstlang')=='S') selected @endif>S</option>
						<option value="W" @if((isset($results)) && ($results['olfirstlang'] == 'W')) selected @elseif(old('olfirstlang')=='W') selected @endif>W</option>
						<option value="NA" @if((isset($results)) && ($results['olfirstlang'] == 'NA')) selected @elseif(old('olfirstlang')=='NA') selected @endif>Not Applicable</option>
					</select></div>
					@error('olfirstlang')
						<div class="col-md-4"></div>
						<div class="col-md-8 text-danger">{{$message}}</div>
					@enderror
				</div>
				<div class="form-group row" style="padding-bottom: 20px;">
					<label class="col-md-4 col-form-label" for="olenglish">* English Language</label>
					<div class="col-md-8"><select id="olenglish" name="olenglish" class="form-control">
						<option value="">Select Result</option>
						<option value="A" @if((isset($results)) && ($results['olenglish'] == 'A')) selected @elseif(old('olenglish')=='A') selected @endif>A</option>
						<option value="B" @if((isset($results)) && ($results['olenglish'] == 'B')) selected @elseif(old('olenglish')=='B') selected @endif>B</option>
						<option value="C" @if((isset($results)) && ($results['olenglish'] == 'C')) selected @elseif(old('olenglish')=='C') selected @endif>C</option>
						<option value="S" @if((isset($results)) && ($results['olenglish'] == 'S')) selected @elseif(old('olenglish')=='S') selected @endif>S</option>
						<option value="W" @if((isset($results)) && ($results['olenglish'] == 'W')) selected @elseif(old('olenglish')=='W') selected @endif>W</option>
						<option value="NA" @if((isset($results)) && ($results['olenglish'] == 'NA')) selected @elseif(old('olenglish')=='NA') selected @endif>Not Applicable</option>
					</select></div>
					@error('olenglish')
						<div class="col-md-4"></div>
						<div class="col-md-8 text-danger">{{$message}}</div>
					@enderror
				</div>
				<div class="form-group row" style="padding-bottom: 20px;">
					<label class="col-md-4 col-form-label" for="olscience">* Science</label>
					<div class="col-md-8"><select id="olscience" name="olscience" class="form-control">
						<option value="">Select Result</option>
						<option value="A" @if((isset($results)) && ($results['olscience'] == 'A')) selected @elseif(old('olscience')=='A') selected @endif>A</option>
						<option value="B" @if((isset($results)) && ($results['olscience'] == 'B')) selected @elseif(old('olscience')=='B') selected @endif>B</option>
						<option value="C" @if((isset($results)) && ($results['olscience'] == 'C')) selected @elseif(old('olscience')=='C') selected @endif>C</option>
						<option value="S" @if((isset($results)) && ($results['olscience'] == 'S')) selected @elseif(old('olscience')=='S') selected @endif>S</option>
						<option value="W" @if((isset($results)) && ($results['olscience'] == 'W')) selected @elseif(old('olscience')=='W') selected @endif>W</option>
						<option value="NA" @if((isset($results)) && ($results['olscience'] == 'NA')) selected @elseif(old('olscience')=='NA') selected @endif>Not Applicable</option>
					</select></div>
					@error('olscience')
						<div class="col-md-4"></div>
						<div class="col-md-8 text-danger">{{$message}}</div>
					@enderror
				</div>
				<div class="form-group row" style="padding-bottom: 20px;">
					<label class="col-md-4 col-form-label" for="olmath">* Mathematics</label>
					<div class="col-md-8"><select id="olmath" name="olmath" class="form-control">
						<option value="">Select Result</option>
						<option value="A" @if((isset($results)) && ($results['olmath'] == 'A')) selected @elseif(old('olmath')=='A') selected @endif>A</option>
						<option value="B" @if((isset($results)) && ($results['olmath'] == 'B')) selected @elseif(old('olmath')=='B') selected @endif>B</option>
						<option value="C" @if((isset($results)) && ($results['olmath'] == 'C')) selected @elseif(old('olmath')=='C') selected @endif>C</option>
						<option value="S" @if((isset($results)) && ($results['olmath'] == 'S')) selected @elseif(old('olmath')=='S') selected @endif>S</option>
						<option value="W" @if((isset($results)) && ($results['olmath'] == 'W')) selected @elseif(old('olmath')=='W') selected @endif>W</option>
						<option value="NA" @if((isset($results)) && ($results['olmath'] == 'NA')) selected @elseif(old('olmath')=='NA') selected @endif>Not Applicable</option>
					</select></div>
					@error('olmath')
						<div class="col-md-4"></div>
						<div class="col-md-8 text-danger">{{$message}}</div>
					@enderror
				</div>
				<div class="form-group row" style="padding-bottom: 20px;">
					<label class="col-md-4 col-form-label" for="olhistory">* History</label>
					<div class="col-md-8"><select id="olhistory" name="olhistory" class="form-control">
						<option value="">Select Result</option>
						<option value="A" @if((isset($results)) && ($results['olhistory'] == 'A')) selected @elseif(old('olhistory')=='A') selected @endif>A</option>
						<option value="B" @if((isset($results)) && ($results['olhistory'] == 'B')) selected @elseif(old('olhistory')=='B') selected @endif>B</option>
						<option value="C" @if((isset($results)) && ($results['olhistory'] == 'C')) selected @elseif(old('olhistory')=='C') selected @endif>C</option>
						<option value="S" @if((isset($results)) && ($results['olhistory'] == 'S')) selected @elseif(old('olhistory')=='S') selected @endif>S</option>
						<option value="W" @if((isset($results)) && ($results['olhistory'] == 'W')) selected @elseif(old('olhistory')=='W') selected @endif>W</option>
						<option value="NA" @if((isset($results)) && ($results['olhistory'] == 'NA')) selected @elseif(old('olhistory')=='NA') selected @endif>Not Applicable</option>
					</select></div>
					@error('olhistory')
						<div class="col-md-4"></div>
						<div class="col-md-8 text-danger">{{$message}}</div>
					@enderror
				</div>
				<div class="form-group row" style="padding-bottom: 20px;">
					<label class="col-md-4 col-form-label" for="olbasket1subject">* 1st Subject Group</label>
					<div class="col-md-4"><select id="olbasket1subject" name="olbasket1subject" class="form-control">
						<option value="">Select subject from the 1st Subject Group</option>
						<option value="Business & Accounting Studies" @if((isset($results)) && ($results['olbasket1subject'] == 'Business & Accounting Studies')) selected @elseif(old('olbasket1subject')=='Business & Accounting Studies') selected @endif>Business & Accounting Studies</option>
						<option value="Geography" @if((isset($results)) && ($results['olbasket1subject'] == 'Geography')) selected @elseif(old('olbasket1subject')=='Geography') selected @endif>Geography</option>
						<option value="Civic Education" @if((isset($results)) && ($results['olbasket1subject'] == 'Civic Education')) selected @elseif(old('olbasket1subject')=='Civic Education') selected @endif>Civic Education</option>
						<option value="Entrepreneurship Studies" @if((isset($results)) && ($results['olbasket1subject'] == 'Entrepreneurship Studies')) selected @elseif(old('olbasket1subject')=='Entrepreneurship Studies') selected @endif>Entrepreneurship Studies</option>
						<option value="Second Language (Sinhala)" @if((isset($results)) && ($results['olbasket1subject'] == 'Second Language (Sinhala)')) selected @elseif(old('olbasket1subject')=='Second Language (Sinhala)') selected @endif>Second Language (Sinhala)</option>
						<option value="Second Language (Tamil)" @if((isset($results)) && ($results['olbasket1subject'] == 'Second Language (Tamil)')) selected @elseif(old('olbasket1subject')=='Second Language (Tamil)') selected @endif>Second Language (Tamil)</option>
						<option value="Pali" @if((isset($results)) && ($results['olbasket1subject'] == 'Pali')) selected @elseif(old('olbasket1subject')=='Pali') selected @endif>Pali</option>
						<option value="Sanskrit" @if((isset($results)) && ($results['olbasket1subject'] == 'Sanskrit')) selected @elseif(old('olbasket1subject')=='Sanskrit') selected @endif>Sanskrit</option>
						<option value="French" @if((isset($results)) && ($results['olbasket1subject'] == 'French')) selected @elseif(old('olbasket1subject')=='French') selected @endif>French</option>
						<option value="German" @if((isset($results)) && ($results['olbasket1subject'] == 'German')) selected @elseif(old('olbasket1subject')=='German') selected @endif>German</option>
						<option value="Hindi" @if((isset($results)) && ($results['olbasket1subject'] == 'Hindi')) selected @elseif(old('olbasket1subject')=='Hindi') selected @endif>Hindi</option>
						<option value="Japanese" @if((isset($results)) && ($results['olbasket1subject'] == 'Japanese')) selected @elseif(old('olbasket1subject')=='Japanese') selected @endif>Japanese</option>
						<option value="Arabic" @if((isset($results)) && ($results['olbasket1subject'] == 'Arabic')) selected @elseif(old('olbasket1subject')=='Arabic') selected @endif>Arabic</option>
						<option value="Korean" @if((isset($results)) && ($results['olbasket1subject'] == 'Korean')) selected @elseif(old('olbasket1subject')=='Korean') selected @endif>Korean</option>
						<option value="Chinese" @if((isset($results)) && ($results['olbasket1subject'] == 'Chinese')) selected @elseif(old('olbasket1subject')=='Chinese') selected @endif>Chinese</option>
						<option value="Russian" @if((isset($results)) && ($results['olbasket1subject'] == 'Russian')) selected @elseif(old('olbasket1subject')=='Russian') selected @endif>Russian</option>
						<option value="NA" @if((isset($results)) && ($results['olbasket1subject'] == 'NA')) selected @elseif(old('olbasket1subject')=='NA') selected @endif>Not Applicable</option>
					</select></div>
					<div class="col-md-4"><select id="olbasket1result" name="olbasket1result" class="form-control">
						<option value="">Select Result</option>
						<option value="A" @if((isset($results)) && ($results['olbasket1result'] == 'A')) selected @elseif(old('olbasket1result')=='A') selected @endif>A</option>
						<option value="B" @if((isset($results)) && ($results['olbasket1result'] == 'B')) selected @elseif(old('olbasket1result')=='B') selected @endif>B</option>
						<option value="C" @if((isset($results)) && ($results['olbasket1result'] == 'C')) selected @elseif(old('olbasket1result')=='C') selected @endif>C</option>
						<option value="S" @if((isset($results)) && ($results['olbasket1result'] == 'S')) selected @elseif(old('olbasket1result')=='S') selected @endif>S</option>
						<option value="W" @if((isset($results)) && ($results['olbasket1result'] == 'W')) selected @elseif(old('olbasket1result')=='W') selected @endif>W</option>
						<option value="NA" @if((isset($results)) && ($results['olbasket1result'] == 'NA')) selected @elseif(old('olbasket1result')=='NA') selected @endif>Not Applicable</option>
					</select></div>
					@error('olbasket1subject')
						<div class="col-md-4"></div>
						<div class="col-md-8 text-danger">{{$message}}</div>
					@enderror
					@error('olbasket1result')
						<div class="col-md-4"></div>
						<div class="col-md-8 text-danger">{{$message}}</div>
					@enderror
				</div>
				<div class="form-group row" style="padding-bottom: 20px;">
					<label class="col-md-4 col-form-label" for="olbasket2subject">* 2nd Subject Group</label>
					<div class="col-md-4"><select id="olbasket2subject" name="olbasket2subject" class="form-control">
						<option value="">Select subject from the 2nd Subject Group</option>
						<option value="Music (Oriental)" @if((isset($results)) && ($results['olbasket2subject'] == 'Music (Oriental)')) selected @elseif(old('olbasket2subject')=='Music (Oriental)') selected @endif>Music (Oriental)</option>
						<option value="Music (Western)" @if((isset($results)) && ($results['olbasket2subject'] == 'Music (Western)')) selected @elseif(old('olbasket2subject')=='Music (Western)') selected @endif>Music (Western)</option>
						<option value="Music (Carnatic)" @if((isset($results)) && ($results['olbasket2subject'] == 'Music (Carnatic)')) selected @elseif(old('olbasket2subject')=='Music (Carnatic)') selected @endif>Music (Carnatic)</option>
						<option value="Art" @if((isset($results)) && ($results['olbasket2subject'] == 'Art')) selected @elseif(old('olbasket2subject')=='Art') selected @endif>Art</option>
						<option value="Dancing (Indigenous)" @if((isset($results)) && ($results['olbasket2subject'] == 'Dancing (Indigenous)')) selected @elseif(old('olbasket2subject')=='Dancing (Indigenous)') selected @endif>Dancing (Indigenous)</option>
						<option value="Dancing (Bharatha)" @if((isset($results)) && ($results['olbasket2subject'] == 'Dancing (Bharatha)')) selected @elseif(old('olbasket2subject')=='Dancing (Bharatha)') selected @endif>Dancing (Bharatha)</option>
						<option value="English Literature" @if((isset($results)) && ($results['olbasket2subject'] == 'English Literature')) selected @elseif(old('olbasket2subject')=='English Literature') selected @endif>English Literature</option>
						<option value="Sinhala Literature" @if((isset($results)) && ($results['olbasket2subject'] == 'Sinhala Literature')) selected @elseif(old('olbasket2subject')=='Sinhala Literature') selected @endif>Sinhala Literature</option>
						<option value="Tamil Literature" @if((isset($results)) && ($results['olbasket2subject'] == 'Tamil Literature')) selected @elseif(old('olbasket2subject')=='Tamil Literature') selected @endif>Tamil Literature</option>
						<option value="Arabic Literature" @if((isset($results)) && ($results['olbasket2subject'] == 'Arabic Literature')) selected @elseif(old('olbasket2subject')=='Arabic Literature') selected @endif>Arabic Literature</option>
						<option value="Drama & Theatre (Sinhala)" @if((isset($results)) && ($results['olbasket2subject'] == 'Drama & Theatre (Sinhala)')) selected @elseif(old('olbasket2subject')=='Drama & Theatre (Sinhala)') selected @endif>Drama & Theatre (Sinhala)</option>
						<option value="Drama & Theatre (Tamil)" @if((isset($results)) && ($results['olbasket2subject'] == 'Drama & Theatre (Tamil)')) selected @elseif(old('olbasket2subject')=='Drama & Theatre (Tamil)') selected @endif>Drama & Theatre (Tamil)</option>
						<option value="Drama & Theatre (English)" @if((isset($results)) && ($results['olbasket2subject'] == 'Drama & Theatre (English)')) selected @elseif(old('olbasket2subject')=='Drama & Theatre (English)') selected @endif>Drama & Theatre (English)</option>
						<option value="NA" @if((isset($results)) && ($results['olbasket2subject'] == 'NA')) selected @elseif(old('olbasket2subject')=='NA') selected @endif>Not Applicable</option>
					</select></div>
					<div class="col-md-4"><select id="olbasket2result" name="olbasket2result" class="form-control">
						<option value="">Select Result</option>
						<option value="A" @if((isset($results)) && ($results['olbasket2result'] == 'A')) selected @elseif(old('olbasket2result')=='A') selected @endif>A</option>
						<option value="B" @if((isset($results)) && ($results['olbasket2result'] == 'B')) selected @elseif(old('olbasket2result')=='B') selected @endif>B</option>
						<option value="C" @if((isset($results)) && ($results['olbasket2result'] == 'C')) selected @elseif(old('olbasket2result')=='C') selected @endif>C</option>
						<option value="S" @if((isset($results)) && ($results['olbasket2result'] == 'S')) selected @elseif(old('olbasket2result')=='S') selected @endif>S</option>
						<option value="W" @if((isset($results)) && ($results['olbasket2result'] == 'W')) selected @elseif(old('olbasket2result')=='W') selected @endif>W</option>
						<option value="NA" @if((isset($results)) && ($results['olbasket2result'] == 'NA')) selected @elseif(old('olbasket2result')=='NA') selected @endif>Not Applicable</option>
					</select></div>
					@error('olbasket2subject')
						<div class="col-md-4"></div>
						<div class="col-md-8 text-danger">{{$message}}</div>
					@enderror
					@error('olbasket2result')
						<div class="col-md-4"></div>
						<div class="col-md-8 text-danger">{{$message}}</div>
					@enderror
				</div>
				<div class="form-group row" style="padding-bottom: 20px;">
					<label class="col-md-4 col-form-label" for="olbasket3subject">* 3rd Subject Group</label>
					<div class="col-md-4"><select id="olbasket3subject" name="olbasket3subject" class="form-control">
						<option value="">Select subject from the 3rd Subject Group</option>
						<option value="Information & Communication Technology" @if((isset($results)) && ($results['olbasket3subject'] == 'Information & Communication Technology')) selected @elseif(old('olbasket3subject')=='Information & Communication Technology') selected @endif>Information & Communication Technology</option>
						<option value="Agriculture & Food Technology" @if((isset($results)) && ($results['olbasket3subject'] == 'Agriculture & Food Technology')) selected @elseif(old('olbasket3subject')=='Agriculture & Food Technology') selected @endif>Agriculture & Food Technology</option>
						<option value="Aquatic Bioresources Technology" @if((isset($results)) && ($results['olbasket3subject'] == 'Aquatic Bioresources Technology')) selected @elseif(old('olbasket3subject')=='Aquatic Bioresources Technology') selected @endif>Aquatic Bioresources Technology</option>
						<option value="Arts & Crafts" @if((isset($results)) && ($results['olbasket3subject'] == 'Arts & Crafts')) selected @elseif(old('olbasket3subject')=='Arts & Crafts') selected @endif>Arts & Crafts</option>
						<option value="Home Economics" @if((isset($results)) && ($results['olbasket3subject'] == 'Home Economics')) selected @elseif(old('olbasket3subject')=='Home Economics') selected @endif>Home Economics</option>
						<option value="Health & Physical Education" @if((isset($results)) && ($results['olbasket3subject'] == 'Health & Physical Education')) selected @elseif(old('olbasket3subject')=='Health & Physical Education') selected @endif>Health & Physical Education</option>
						<option value="Communication & Media Studies" @if((isset($results)) && ($results['olbasket3subject'] == 'Communication & Media Studies')) selected @elseif(old('olbasket3subject')=='Communication & Media Studies') selected @endif>Communication & Media Studies</option>
						<option value="Design & Construction Technology" @if((isset($results)) && ($results['olbasket3subject'] == 'Design & Construction Technology')) selected @elseif(old('olbasket3subject')=='Design & Construction Technology') selected @endif>Design & Construction Technology</option>
						<option value="Design & Mechanical Technology" @if((isset($results)) && ($results['olbasket3subject'] == 'Design & Mechanical Technology')) selected @elseif(old('olbasket3subject')=='Design & Mechanical Technology') selected @endif>Design & Mechanical Technology</option>
						<option value="Design, Electrical & Electronic Technology" @if((isset($results)) && ($results['olbasket3subject'] == 'Design, Electrical & Electronic Technology')) selected @elseif(old('olbasket3subject')=='Design, Electrical & Electronic Technology') selected @endif>Design, Electrical & Electronic Technology</option>
						<option value="Electronic Writing & Shorthand (Sinhala)" @if((isset($results)) && ($results['olbasket3subject'] == 'Electronic Writing & Shorthand (Sinhala)')) selected @elseif(old('olbasket3subject')=='Electronic Writing & Shorthand (Sinhala)') selected @endif>Electronic Writing & Shorthand (Sinhala)</option>
						<option value="Electronic Writing & Shorthand (Tamil)" @if((isset($results)) && ($results['olbasket3subject'] == 'Electronic Writing & Shorthand (Tamil)')) selected @elseif(old('olbasket3subject')=='Electronic Writing & Shorthand (Tamil)') selected @endif>Electronic Writing & Shorthand (Tamil)</option>
						<option value="Electronic Writing & Shorthand (English)" @if((isset($results)) && ($results['olbasket3subject'] == 'Electronic Writing & Shorthand (English)')) selected @elseif(old('olbasket3subject')=='Electronic Writing & Shorthand (English)') selected @endif>Electronic Writing & Shorthand (English)</option>
						<option value="NA" @if((isset($results)) && ($results['olbasket3subject'] == 'NA')) selected @elseif(old('olbasket3subject')=='NA') selected @endif>Not Applicable</option>
					</select></div>
					<div class="col-md-4"><select id="olbasket3result" name="olbasket3result" class="form-control">
						<option value="">Select Result</option>
						<option value="A" @if((isset($results)) && ($results['olbasket3result'] == 'A')) selected @elseif(old('olbasket3result')=='A') selected @endif>A</option>
						<option value="B" @if((isset($results)) && ($results['olbasket3result'] == 'B')) selected @elseif(old('olbasket3result')=='B') selected @endif>B</option>
						<option value="C" @if((isset($results)) && ($results['olbasket3result'] == 'C')) selected @elseif(old('olbasket3result')=='C') selected @endif>C</option>
						<option value="S" @if((isset($results)) && ($results['olbasket3result'] == 'S')) selected @elseif(old('olbasket3result')=='S') selected @endif>S</option>
						<option value="W" @if((isset($results)) && ($results['olbasket3result'] == 'W')) selected @elseif(old('olbasket3result')=='W') selected @endif>W</option>
						<option value="NA" @if((isset($results)) && ($results['olbasket3result'] == 'NA')) selected @elseif(old('olbasket3result')=='NA') selected @endif>Not Applicable</option>
					</select></div>
					@error('olbasket3subject')
						<div class="col-md-4"></div>
						<div class="col-md-8 text-danger">{{$message}}</div>
					@enderror
					@error('olbasket3result')
						<div class="col-md-4"></div>
						<div class="col-md-8 text-danger">{{$message}}</div>
					@enderror
				</div>
			@elseif($grade_sought == "International ALevels")
				<h3>Enter Mock Exam Results</h3>
				<p>Enter the mark received in the most recently concluded Mock Exams in the current school.</p>
				<div class="form-group row" style="padding-bottom: 20px;">
					<label class="col-md-4 col-form-label" for="olenglish">* English Language</label>
					<div class="col-md-8"><select id="olenglish" name="olenglish" class="form-control">
						<option value="">Select Result</option>
						<option value="9" @if((isset($results)) && ($results['olenglish'] == '9')) selected @elseif(old('olenglish')=='9') selected @endif>9</option>
						<option value="8" @if((isset($results)) && ($results['olenglish'] == '8')) selected @elseif(old('olenglish')=='8') selected @endif>8</option>
						<option value="7" @if((isset($results)) && ($results['olenglish'] == '7')) selected @elseif(old('olenglish')=='7') selected @endif>7</option>
						<option value="6" @if((isset($results)) && ($results['olenglish'] == '6')) selected @elseif(old('olenglish')=='6') selected @endif>6</option>
						<option value="5" @if((isset($results)) && ($results['olenglish'] == '5')) selected @elseif(old('olenglish')=='5') selected @endif>5</option>
						<option value="4" @if((isset($results)) && ($results['olenglish'] == '4')) selected @elseif(old('olenglish')=='4') selected @endif>4</option>
					</select></div>
					@error('olenglish')
						<div class="col-md-4"></div>
						<div class="col-md-8 text-danger">{{$message}}</div>
					@enderror
				</div>
				<div class="form-group row" style="padding-bottom: 20px;">
					<label class="col-md-4 col-form-label" for="olmath">* Mathematics</label>
					<div class="col-md-8"><select id="olmath" name="olmath" class="form-control">
						<option value="">Select Result</option>
						<option value="9" @if((isset($results)) && ($results['olmath'] == '9')) selected @elseif(old('olmath')=='9') selected @endif>9</option>
						<option value="8" @if((isset($results)) && ($results['olmath'] == '8')) selected @elseif(old('olmath')=='8') selected @endif>8</option>
						<option value="7" @if((isset($results)) && ($results['olmath'] == '7')) selected @elseif(old('olmath')=='7') selected @endif>7</option>
						<option value="6" @if((isset($results)) && ($results['olmath'] == '6')) selected @elseif(old('olmath')=='6') selected @endif>6</option>
						<option value="5" @if((isset($results)) && ($results['olmath'] == '5')) selected @elseif(old('olmath')=='5') selected @endif>5</option>
						<option value="4" @if((isset($results)) && ($results['olmath'] == '4')) selected @elseif(old('olmath')=='4') selected @endif>4</option>
					</select></div>
					@error('olmath')
						<div class="col-md-4"></div>
						<div class="col-md-8 text-danger">{{$message}}</div>
					@enderror
				</div>

				<div class="form-group row pt-5" style="padding-bottom: 20px;">
					<label class="col-md-3 col-form-label" for="olreligion">* Enter Subject 1</label>
					<div class="col-md-3"><input id="olreligion" name="olreligion" class="form-control" value="@if(isset($results)) {{$results['olreligion']}} @endif"></div>
					<label class="col-md-3 col-form-label" for="olfirstlang">Result</label>
					<div class="col-md-3"><select id="olfirstlang" name="olfirstlang" class="form-control">
						<option value="">Select Result</option>
						<option value="9" @if((isset($results)) && ($results['olfirstlang'] == '9')) selected @elseif(old('olfirstlang')=='9') selected @endif>9</option>
						<option value="8" @if((isset($results)) && ($results['olfirstlang'] == '8')) selected @elseif(old('olfirstlang')=='8') selected @endif>8</option>
						<option value="7" @if((isset($results)) && ($results['olfirstlang'] == '7')) selected @elseif(old('olfirstlang')=='7') selected @endif>7</option>
						<option value="6" @if((isset($results)) && ($results['olfirstlang'] == '6')) selected @elseif(old('olfirstlang')=='6') selected @endif>6</option>
						<option value="5" @if((isset($results)) && ($results['olfirstlang'] == '5')) selected @elseif(old('olfirstlang')=='5') selected @endif>5</option>
						<option value="4" @if((isset($results)) && ($results['olfirstlang'] == '4')) selected @elseif(old('olfirstlang')=='4') selected @endif>4</option>
					</select></div>
					@error('olreligion')
						<div class="col-md-2"></div>
						<div class="col-md-4 text-danger">{{$message}}</div>
					@enderror
					@error('olfirstlang')
						<div class="col-md-2"></div>
						<div class="col-md-4 text-danger">{{$message}}</div>
					@enderror
				</div>
				<div class="form-group row" style="padding-bottom: 20px;">
					<label class="col-md-3 col-form-label" for="olscience">* Enter Subject 2</label>
					<div class="col-md-3"><input id="olscience" name="olscience" class="form-control" value="@if(isset($results)) {{$results['olscience']}} @endif"></div>
					<label class="col-md-3 col-form-label" for="olhistory">Result</label>
					<div class="col-md-3"><select id="olhistory" name="olhistory" class="form-control">
						<option value="">Select Result</option>
						<option value="9" @if((isset($results)) && ($results['olhistory'] == '9')) selected @elseif(old('olhistory')=='9') selected @endif>9</option>
						<option value="8" @if((isset($results)) && ($results['olhistory'] == '8')) selected @elseif(old('olhistory')=='8') selected @endif>8</option>
						<option value="7" @if((isset($results)) && ($results['olhistory'] == '7')) selected @elseif(old('olhistory')=='7') selected @endif>7</option>
						<option value="6" @if((isset($results)) && ($results['olhistory'] == '6')) selected @elseif(old('olhistory')=='6') selected @endif>6</option>
						<option value="5" @if((isset($results)) && ($results['olhistory'] == '5')) selected @elseif(old('olhistory')=='5') selected @endif>5</option>
						<option value="4" @if((isset($results)) && ($results['olhistory'] == '4')) selected @elseif(old('olhistory')=='4') selected @endif>4</option>
					</select></div>
					@error('olscience')
						<div class="col-md-2"></div>
						<div class="col-md-4 text-danger">{{$message}}</div>
					@enderror
					@error('olhistory')
						<div class="col-md-2"></div>
						<div class="col-md-4 text-danger">{{$message}}</div>
					@enderror
				</div>
				<div class="form-group row" style="padding-bottom: 20px;">
					<label class="col-md-3 col-form-label" for="olbasket1subject">* Enter Subject 3</label>
					<div class="col-md-3"><input id="olbasket1subject" name="olbasket1subject" class="form-control" value="@if(isset($results)) {{$results['olbasket1subject']}} @endif"></div>
					<label class="col-md-3 col-form-label" for="olbasket1result">Result</label>
					<div class="col-md-3"><select id="olbasket1result" name="olbasket1result" class="form-control">
						<option value="">Select Result</option>
						<option value="9" @if((isset($results)) && ($results['olbasket1result'] == '9')) selected @elseif(old('olbasket1result')=='9') selected @endif>9</option>
						<option value="8" @if((isset($results)) && ($results['olbasket1result'] == '8')) selected @elseif(old('olbasket1result')=='8') selected @endif>8</option>
						<option value="7" @if((isset($results)) && ($results['olbasket1result'] == '7')) selected @elseif(old('olbasket1result')=='7') selected @endif>7</option>
						<option value="6" @if((isset($results)) && ($results['olbasket1result'] == '6')) selected @elseif(old('olbasket1result')=='6') selected @endif>6</option>
						<option value="5" @if((isset($results)) && ($results['olbasket1result'] == '5')) selected @elseif(old('olbasket1result')=='5') selected @endif>5</option>
						<option value="4" @if((isset($results)) && ($results['olbasket1result'] == '4')) selected @elseif(old('olbasket1result')=='4') selected @endif>4</option>
					</select></div>
					@error('olbasket1subject')
						<div class="col-md-2"></div>
						<div class="col-md-4 text-danger">{{$message}}</div>
					@enderror
					@error('olbasket1result')
						<div class="col-md-2"></div>
						<div class="col-md-4 text-danger">{{$message}}</div>
					@enderror
				</div>
				<div class="form-group row" style="padding-bottom: 20px;">
					<label class="col-md-3 col-form-label" for="olbasket2subject">* Enter Subject 4</label>
					<div class="col-md-3"><input id="olbasket2subject" name="olbasket2subject" class="form-control" value="@if(isset($results)) {{$results['olbasket2subject']}} @endif"></div>
					<label class="col-md-3 col-form-label" for="olbasket2result">Result</label>
					<div class="col-md-3"><select id="olbasket2result" name="olbasket2result" class="form-control">
						<option value="">Select Result</option>
						<option value="9" @if((isset($results)) && ($results['olbasket2result'] == '9')) selected @elseif(old('olbasket2result')=='9') selected @endif>9</option>
						<option value="8" @if((isset($results)) && ($results['olbasket2result'] == '8')) selected @elseif(old('olbasket2result')=='8') selected @endif>8</option>
						<option value="7" @if((isset($results)) && ($results['olbasket2result'] == '7')) selected @elseif(old('olbasket2result')=='7') selected @endif>7</option>
						<option value="6" @if((isset($results)) && ($results['olbasket2result'] == '6')) selected @elseif(old('olbasket2result')=='6') selected @endif>6</option>
						<option value="5" @if((isset($results)) && ($results['olbasket2result'] == '5')) selected @elseif(old('olbasket2result')=='5') selected @endif>5</option>
						<option value="4" @if((isset($results)) && ($results['olbasket2result'] == '4')) selected @elseif(old('olbasket2result')=='4') selected @endif>4</option>
					</select></div>
					@error('olbasket2subject')
						<div class="col-md-2"></div>
						<div class="col-md-4 text-danger">{{$message}}</div>
					@enderror
					@error('olbasket2result')
						<div class="col-md-2"></div>
						<div class="col-md-4 text-danger">{{$message}}</div>
					@enderror
				</div>
				<div class="form-group row" style="padding-bottom: 20px;">
					<label class="col-md-3 col-form-label" for="olbasket3subject">Enter Subject 5</label>
					<div class="col-md-3"><input id="olbasket3subject" name="olbasket3subject" class="form-control" value="@if(isset($results)) {{$results['olbasket3subject']}} @endif"></div>
					<label class="col-md-3 col-form-label" for="olbasket3result">Result</label>
					<div class="col-md-3"><select id="olbasket3result" name="olbasket3result" class="form-control">
						<option value="">Select Result</option>
						<option value="9" @if((isset($results)) && ($results['olbasket3result'] == '9')) selected @elseif(old('olbasket3result')=='9') selected @endif>9</option>
						<option value="8" @if((isset($results)) && ($results['olbasket3result'] == '8')) selected @elseif(old('olbasket3result')=='8') selected @endif>8</option>
						<option value="7" @if((isset($results)) && ($results['olbasket3result'] == '7')) selected @elseif(old('olbasket3result')=='7') selected @endif>7</option>
						<option value="6" @if((isset($results)) && ($results['olbasket3result'] == '6')) selected @elseif(old('olbasket3result')=='6') selected @endif>6</option>
						<option value="5" @if((isset($results)) && ($results['olbasket3result'] == '5')) selected @elseif(old('olbasket3result')=='5') selected @endif>5</option>
						<option value="4" @if((isset($results)) && ($results['olbasket3result'] == '4')) selected @elseif(old('olbasket3result')=='4') selected @endif>4</option>
					</select></div>
					@error('olbasket3subject')
						<div class="col-md-2"></div>
						<div class="col-md-4 text-danger">{{$message}}</div>
					@enderror
					@error('olbasket3result')
						<div class="col-md-2"></div>
						<div class="col-md-4 text-danger">{{$message}}</div>
					@enderror
				</div>
			@endif
			<div class="row">
				<div class="col-md-6 text-center"><a class="btn btn-primary btn-lg" style="margin:10px 0;" type="button" href="{{url('application/status')}}">Back</a></div>
				<div class="col-md-6 text-center"><input class="btn btn-primary btn-lg" style="margin:10px 0;" type="submit" @if(!isset($results)) value="Save Data" @else value="Update Data" @endif id="cmdSave" name="cmdSave"/></div>
			</div>
		</form>
	</div>
@endsection