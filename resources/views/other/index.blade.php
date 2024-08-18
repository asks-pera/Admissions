@extends('layout')

@section('navigation')
	<a style="margin: 0px 10px" class="btn btn-primary btn-primary" href="{{url('/')}}">Home</a>
@endsection

@section('year')
	 - {{$year}}
@endsection

@section('content')
	<h2 class="text-center">Welcome to Admissions for Other Grades for {{$year}}</h2><br/>
	<p>Welcome to the Application Form for Student Admissions for the year {{$year}}</p><p><strong>This application form is for Grade 2, Grade 3, Grade 4, Grade 5, Grade 7, Grade 8,  Grade 9 and Grade 10 only</strong>.<p>Please read and understand the following information before proceeding to purchase this application. If you have already purchased the application form, please use the link in your emails to log in to the application form.</p><br/>
	<ul class="display_4">
		<li>This website is made available for parents to fill the Application Form online, to seek admission for your son(s) to S. Thomas' College, Mount Lavinia. However, filling this application form does not guarantee admission, and will be dependent on the application process.</li>
		<li>Only after successful completion and submission of the application form, will the admissions process begin.</li>
		<li>You will be required to purchase an application form using the given payment gateway for <strong>Rs.1,500/- and would be non-refundable</strong>. After which <b>you will be emailed the login credentials</b>, using which you can log in at anytime to fill and finally submit same.<br/>
		<i>Please note:- If the form is <b>SUBMITTED AFTER</b> the closing date, the form will not be accepted.</i></li>
		<li>You may navigate forward and backward in the form and edit any information before you finally submit. However, please ensure you save each category before proceeding to the next to avoid loss of data. After it is submitted, you will no longer be able to make changes to the form.</li>
		<li><b>DO NOT USE THE BROWSER FORWARD OR BACK BUTTONS.</b></li>
		<li>At the point of subitting the form, you will be required to accept and agree to the following:-
			<ul class="">
				<li>I hereby certify that the particulars given above are true and correct. If they are found to be false, wrong or incorrect, I undertake to withdraw the child from S. Thomas' College, should I be requested to do so.</li>
				<li>I accept that submitting this application form does not guarantee entrance to S. Thomas' College, and that the admission process must follow its course. I will not contact the school office until I receive a feedback from the office.</li>
				<li>I accept that I will not be able to alter any information after submission, and that I have understood the admission process.</li>
				<li>I accept that the decision of S.Thomas' College shall be final and conclusive on whether to grant entrance to a child and all matters pertaining thereto and cannot be questioned</li>
				<li>I accept that this is a computer generated Application Form which does not require a physical signature</li>
			</ul>
		</li>
		<li>During the time of purchasing, you will be required to enter an email address. Please use the personal email address of either the father or the mother of the child, as <b>this email address will be used for any and all further communication including the login credentials</b>.</li>
		<li>After the form is submitted, the information will be verified and short-listed according to the criteria set by the Board of Governors of S. Thomas' College. Accordingly, you will receive an email from us indicating you of the next step in the process. Please await said email. If you have not received the email within 10 to 15 working days of the closing date, then please call the Registrar's office for more information.</li>
		<li>Please use Chrome, Firefox, Microsoft Edge, Internet Explorer or Safari to complete the form. You will be required to enable JavaScript for the application to work properly.</li>
	</ul>
	<br />
	<noscript><b>JAVASCRIPT HAS NOT BEEN ENABLED. YOU CANNOT PROCEED UNTIL IT IS ENABLED</b>Visit <a href="https://www.whatismybrowser.com/guides/how-to-enable-javascript/?utm_source=whatismybrowsercom&utm_medium=internal&utm_campaign=breadcrumbs">How To Enable Javascript</a> to find out how.</noscript>
	<form action="" method="post">
		@csrf
		<div class = "row" style="padding-bottom: 20px;">
			<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"><label for="email">* Enter email address</label></div>
			<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12"><input style="width:100%" type="text" maxlength="100"  placeholder="Enter email address" id="email" name="email" value=""/></div>
			@error('email')
				<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"></div>
				<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12" style="color:red">{{$message}}</div>
			@enderror
			<div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"></div>
			<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12"><small>Note: The email address you provide here will be used by the school for all further correspondence</small></div>
		</div>
		<div class="text-right"><input type='submit' value='Confirm Email' class="btn btn-primary btn-lg" /></div>
	</form>
@endsection

