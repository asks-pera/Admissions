@extends('layout')

@section('navigation')
	<a style="margin: 0px 10px" class="btn btn-primary btn-primary" href="{{url('application/status')}}">Back</a>
@endsection

@section('year')
	- {{$year}}
@endsection

@section('content')
	<h2>Summary</h2>
	<div class="row border border-dark rounded" style="margin:10px; padding:50px; display:block;">
		<embed src="{{url('uploads/' . $id . '_pdf.pdf')}}" height="400" width="100%"/>
		<form action="" method="post">
			@csrf
			<input type="hidden" value="{{$id}}" name="id" />
			<p>The application form is now complete. Please read and accept the following conditions and Submit the form for consideration. Please note that the form will not be processed unless the conditions are accepted and the form is submitted. Please go back to each section and double check if all the required information has been provided, because the form cannot be changed after submition.</p>
			<p>If you are happy with the provided information please accept the following terms and conditions and click submit.</p>
			<ul>
				<li>I hereby certify that the particulars given above are true and correct. If they are found to be false, wrong or incorrect, I undertake to withdraw the child from S. Thomas' College, should I be requested to do so.</li>
				<li>I accept that submitting this application form does not guarantee entrance to S. Thomas' College, and that the admission process must follow its course. I will not contact the school office until I receive a feedback from the office.</li>
				<li>I accept that I will not be able to alter any information after submission, and that I have understood the admission process.</li>
				<li>I accept that the decision of S.Thomas' College shall be final and conclusive on whether to grant entrance to a child and all matters pertaining thereto and cannot be questioned</li>
				<li>I accept that this is a computer generated Application Form which does not require a physical signature</li>
			</ul>
			<div class = "form-group row" style="padding-bottom: 0px;">
				<label class="col-md-4 col-form-label" for="accept">* Accept and Submit Application Form?</label>
				<div class="col-md-1" style="padding-top:15px"><input class="form-control" type="checkbox" id="accept" name="accept" value="accept"></div>
				@error('accept')
					<div class="col-md-4"></div>
					<div class="col-md-8 text-danger">{{$message}}</div>
				@enderror
			</div>
			<div class="row">
				<div class="col-md-6 text-center"><a class="btn btn-primary btn-lg" style="margin:10px 0;" type="button" href="{{url('application/status')}}">Back</a></div>
				<div class="col-md-6 text-center"><input class="btn btn-primary btn-lg" style="margin:10px 0;" type="submit" value="Submit Form" id="cmdSave" name="cmdSave"/></div>
			</div>
		</form>
	</div>
@endsection