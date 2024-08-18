@extends('layout')

@section('navigation')
	<a style="margin: 0px 10px" class="btn btn-primary btn-primary" href="{{url('/')}}">Home</a>
@endsection

@section('year')
    - {{$year}}
@endsection

@section('content')
	<h2 class="text-center">Welcome to A/Level Admissions for Branch Schools {{$year}}</h2><br/>
	<p>Welcome to the Application Form for Student Admissions. This application form is only for those who will be sitting for the Local O/Levels this year from S. Thomas' Preperatory School, Kollupitiya, S. Thomas' College, Gurutalawa or S. Thomas' College, Bandarawela. Please read and understand the following information before proceeding to purchase this application.</p>
	<p>If you have already purchased the application form, please use the link in your emails to log in to the application form.</p><br/>
	<p style="color: red; ">Minimum Qualifications</p>
	<ul style="color:red">
		<li>Recommendataion of the Headmaster</li>
		<li>‘A’ passes in the last Term exam in Maths and Science for Physical & Biological Sciences</li>
		<li>‘A’ passes in the last Term exam in Maths and Business Studies for Commerce and Accounts</li>
	</ul><br/>
	<p>General Notes</p>
	<ul class="display_4">
		<li>This application form CANNOT be used for admissions for any other grade. This is made avaialble only for students from the Branch Schools.</li>
		<li>This website is made available for parents to fill the Application Form online. However, filling this application form does not guarantee admission, and will be dependent on tshe application process.</li>
		<li>Only after successful completion and submission of the application form, will the admissions process begin.</li>
		<li>You will be required to verify your email first by entering submitting a valid email address below. <b>This email address will be used for any and all further communication including the login credentials</b>. After which <b>you will be emailed the login credentials</b>, using which you can log in to the Application form at anytime to fill and finally submit same.
			<li>You will be required to purchase an application form using the given payment gateway for <strong>Rs.1,500/- and would be non-refundable</strong>.<br/>
		<i>Please note:- The form <b>CANNOT BE SUBMITTED AFTER THE CLOSING DATE</b>.</i></li>
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
		<li>After the form is submitted, the information will be verified and short-listed. You will then receive an email from us indicating the next step in the process. Please await said email. If you have not received the email within 10 to 15 working days of the closing date, then please call the Registrar's office for more information.</li>
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

