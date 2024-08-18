<!DOCTYPE HTML>
<html lang="en">
<head>
	<title></title>
	<style>
        /** Define the margins of your page **/
        @page {
            margin: 120px 25px;
        }

        header {
            position: fixed;
            top: -100px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 20px !important;
        }

        footer {
            position: fixed; 
            bottom: -50px; 
            left: 0px; 
            right: 0px;
            height: 50px; 
            font-size: 20px !important;
        }
    </style>
</head>
<body style="border:solid black 2px;"><!--794 x 1123-->
	<header>
		<table style="border:solid black 0px; padding-top:10px">
			<tr>
				<td style="width:100px; text-align:center;"><img src="{{$path_img}}" height="75" alt="" /></td>
				<td style="width:590px; text-align: center;"><span style="font-size: 26px; font-weight:bold;">S. Thomas' College, Mount Lavinia</span><br/><span style="font-size: 20px; font-weight:bold;">{{$section}} Admissions - {{$year}}</span></td>
			</tr>
		</table>
		<hr>
	</header>
	<footer style="text-align: center;">
		<a href="https://www.stcmount.edu.lk" target="_blank">S. Thomas' College, Mount Lavinia</a> &copy; {{$year - 1}}<br/>
		Email - <a href="mailto:admissions@stcmount.lk">admissions@stcmount.lk</a><span style="float:right; padding-right:20px"></span>
	</footer>
	<main>
		<div style="float:right; padding-right:10px; margin-top:15px"><img src="{{$child_img}}" height="150px" alt="Child's Picture"></div>
		<p style="padding-left:20px; font-size: 18px; font-weight:bold; margin:28px 0px 5px 0px">Child Information</p>
		<table style="border:solid black 0px; padding-left:30px;">
			<tr><td style="width: 150px;">Surname :</td><td style="width: 540px;">{{$child['surname']}}</td></tr>
			<tr><td>Other Names :</td><td>{{$child['other_names']}}</td></tr>
			@if($section == 'Nursery')
				<tr><td>Gender :</td><td>{{$child['gender']}}</td></tr>
			@endif
			<tr><td>Date of Birth :</td><td>{{$child['dob']}}</td></tr>
			<tr><td>BC Number :</td><td>{{$child['bc_num']}}</td></tr>
			<tr><td>Present School :</td><td>{{$child['present_school']}}</td></tr>
			@if($child['present_school_joined'] !== null)
				<tr><td>Joined Date :</td><td>{{$child['present_school_joined']}}</td></tr>
			@endif
			@if($child['previous_schools'] !== null)
				<tr><td>Previous Schools :</td><td>{{$child['previous_schools']}}</td></tr>
			@endif
			@if($child['grade_sought'] !== null) 
		        <tr><td>Section / Grade : </td><td>{{$child['grade_sought']}}</td></tr>
		    @endif
			@if($child['medium'] !== null)
				<tr><td>Medium :</td><td>{{$child['medium']}}</td></tr>
			@endif
			<tr><td>Religion :</td><td>{{$child['religion']}}</td></tr>
			@if($child['religion'] == "Christian")
				<tr><td>Denomination :</td><td>{{$child['denomination']}}</td></tr>
				<tr><td>Baptism Date :</td><td>{{$child['baptism_date']}}</td></tr>
			@endif
		</table>
		<table style="margin-top:30px; border:solid black 0px; padding-left:30px;">
			<tr><td style="width: 150px;"></td><td style="width:215px; padding-left:20px; font-size: 18px; font-weight:bold;">Father</td><td style="width:245px; padding-left:20px; font-size: 18px; font-weight:bold;">Mother</td></tr>
			<tr><td>Name :</td><td>{{$father['name']}}</td><td>{{$mother['name']}}</td></tr>
			<tr><td>Occupation :</td><td>{{$father['occupation']}}</td><td>{{$mother['occupation']}}</td></tr>
			<tr><td>Employment :</td><td>{{$father['employment']}}</td><td>{{$mother['employment']}}</td></tr>
			<tr><td>Mobile :</td><td>{{$father['mobile']}}</td><td>{{$mother['mobile']}}</td></tr>
			<tr><td>Email :</td><td>{{$father['email']}}</td><td>{{$mother['email']}}</td></tr>
			<tr><td>Address :</td><td>{{$father['address']}}</td><td>{{$mother['address']}}</td></tr>
			<tr><td>NIC :</td><td>{{$father['nic']}}</td><td>{{$mother['nic']}}</td></tr>
			@if(($father['religion']!="Other") && ($mother['religion']!="Other"))
			    <tr><td>Religion :</td><td>{{$father['religion']}}</td><td>{{$mother['religion']}}</td></tr>
			@elseif(($father['religion']=="Other") && ($mother['religion']!="Other"))
			    <tr><td>Religion :</td><td>{{$father['other']}}</td><td>{{$mother['religion']}}</td></tr>
			@elseif(($father['religion']!="Other") && ($mother['religion']=="Other"))
			    <tr><td>Religion :</td><td>{{$father['religion']}}</td><td>{{$mother['other']}}</td></tr>
	        @elseif(($father['religion']=="Other") && ($mother['religion']=="Other"))
			    <tr><td>Religion :</td><td>{{$father['other']}}</td><td>{{$mother['other']}}</td></tr>
			@endif
			@if(($father['religion']=="Christian") && ($mother['religion']=="Christian"))
			    <tr><td>Denomination :</td><td>{{$father['denomination']}}</td><td>{{$mother['denomination']}}</td></tr>
			    <tr><td>Baptism Date :</td><td>{{$father['baptism_date']}}</td><td>{{$mother['baptism_date']}}</td></tr>
			@elseif(($father['religion']!="Christian") && ($mother['religion']=="Christian"))
			    <tr><td>Denomination :</td><td></td><td>{{$mother['denomination']}}</td></tr>
			    <tr><td>Baptism Date :</td><td></td><td>{{$mother['baptism_date']}}</td></tr>
			@elseif(($father['religion']=="Christian") && ($mother['religion']!="Christian"))
			    <tr><td>Denomination :</td><td>{{$father['denomination']}}</td><td></td></tr>
			    <tr><td>Baptism Date :</td><td>{{$father['baptism_date']}}</td><td></td></tr>
			@endif
			@if($father['old_thomian'])
				<tr><td>Old School :</td><td>S. Thomas' College</td><td>{{$mother['old_school']}}</td></tr>
			@else
				<tr><td>Old School :</td><td>{{$father['old_school']}}</td><td>{{$mother['old_school']}}</td></tr>
			@endif
			<tr><td>Monthly income (LKR) :</td><td>{{$father['income']}}</td><td>{{$mother['income']}}</td></tr>
		</table>
		@if($child['religion'] == "Christian")
			<p style="padding-left:20px; font-size: 18px; font-weight:bold; margin:28px 0px 5px 0px">Church Details</p>
			<table style="border:solid black 0px; padding-left:30px;">
				<tr><td style="width: 150px;">Parish :</td><td style="width: 540px;">{{$church['parish']}}</td></tr>
				<tr><td>Parish Priest :</td><td>{{$church['priest']}}</td></tr>
			</table>
		@endif
		@if($other['num'] > 0)
			<p style="padding-left:20px; font-size: 18px; font-weight:bold; margin:28px 0px 5px 0px">Other Children : {{$other['num']}}</p>
			<table style="margin-top:5px; border:solid black 0px; padding-left:30px;">
				<tr><td style="width: 100px;">Name :</td><td style="width: 190px;">{{$other['name_1']}}</td><td style="width: 100px;">Name :</td><td style="width: 190px;">{{$other['name_2']}}</td></tr>
				<tr><td>Gender :</td><td>{{$other['sex_1']}}</td><td>Gender :</td><td>{{$other['sex_2']}}</td></tr>
				<tr><td>DoB :</td><td>{{$other['dob_1']}}</td><td>DoB :</td><td>{{$other['dob_2']}}</td></tr>
				<tr><td>School :</td><td>{{($other['stc_1']) ? 'STC' : $other['school_1']}}</td><td>School :</td><td>{{($other['stc_2']) ? 'STC' : $other['school_2']}}</td></tr>
				@if($other['stc_1'] && $other['stc_2'])
					<tr><td>Class :</td><td>{{$other['class_1']}}</td><td>Class :</td><td>{{$other['class_2']}}</td></tr>
					<tr><td>House :</td><td>{{$other['house_1']}}</td><td>House :</td><td>{{$other['house_2']}}</td></tr>
					<tr><td>Admission :</td><td>{{$other['admission_1']}}</td><td>Admission :</td><td>{{$other['admission_2']}}</td></tr>
					<tr><td>Medium :</td><td>{{$other['medium_1']}}</td><td>Medium :</td><td>{{$other['medium_2']}}</td></tr>
				@elseif($other['stc_1'] && !$other['stc_2'])
					<tr><td>Class :</td><td>{{$other['class_1']}}</td><td></td><td></td></tr>
					<tr><td>House :</td><td>{{$other['house_1']}}</td><td></td><td></td></tr>
					<tr><td>Admission :</td><td>{{$other['admission_1']}}</td><td></td><td></td></tr>
					<tr><td>Medium :</td><td>{{$other['medium_1']}}</td><td></td><td></td></tr>
				@elseif(!$other['stc_1'] && $other['stc_2'])
					<tr><td></td><td></td><td>Class :</td><td>{{$other['class_2']}}</td></tr>
					<tr><td></td><td></td><td>House :</td><td>{{$other['house_2']}}</td></tr>
					<tr><td></td><td></td><td>Admission :</td><td>{{$other['admission_2']}}</td></tr>
					<tr><td></td><td></td><td>Medium :</td><td>{{$other['medium_2']}}</td></tr>
				@endif
			</table>
			@if($other['num'] > 2)
				<table style="margin-top:30px; border:solid black 0px; padding-left:30px;">
					<tr><td style="width: 100px;">Name :</td><td style="width: 190px;">{{$other['name_3']}}</td><td style="width: 100px;">Name :</td><td style="width: 190px;">{{$other['name_4']}}</td></tr>
					<tr><td>Gender :</td><td>{{$other['sex_3']}}</td><td>Gender :</td><td>{{$other['sex_4']}}</td></tr>
					<tr><td>DoB :</td><td>{{$other['dob_3']}}</td><td>DoB :</td><td>{{$other['dob_4']}}</td></tr>
					<tr><td>School :</td><td>{{($other['stc_3']) ? 'STC' : $other['school_3']}}</td><td>School :</td><td>{{($other['stc_4']) ? 'STC' : $other['school_4']}}</td></tr>
					@if($other['stc_3'] && $other['stc_4'])
						<tr><td>Class :</td><td>{{$other['class_3']}}</td><td>Class :</td><td>{{$other['class_4']}}</td></tr>
						<tr><td>House :</td><td>{{$other['house_3']}}</td><td>House :</td><td>{{$other['house_4']}}</td></tr>
						<tr><td>Admission :</td><td>{{$other['admission_3']}}</td><td>Admission :</td><td>{{$other['admission_4']}}</td></tr>
						<tr><td>Medium :</td><td>{{$other['medium_3']}}</td><td>Medium :</td><td>{{$other['medium_4']}}</td></tr>
					@elseif($other['stc_3'] && !$other['stc_4'])
						<tr><td>Class :</td><td>{{$other['class_3']}}</td><td></td><td></td></tr>
						<tr><td>House :</td><td>{{$other['house_3']}}</td><td></td><td></td></tr>
						<tr><td>Admission :</td><td>{{$other['admission_3']}}</td><td></td><td></td></tr>
						<tr><td>Medium :</td><td>{{$other['medium_3']}}</td><td></td><td></td></tr>
					@elseif(!$other['stc_3'] && $other['stc_4'])
						<tr><td></td><td></td><td>Class :</td><td>{{$other['class_4']}}</td></tr>
						<tr><td></td><td></td><td>House :</td><td>{{$other['house_4']}}</td></tr>
						<tr><td></td><td></td><td>Admission :</td><td>{{$other['admission_4']}}</td></tr>
						<tr><td></td><td></td><td>Medium :</td><td>{{$other['medium_4']}}</td></tr>
					@endif
				</table>
			@endif
			<br/>
		@endif
		@if($oba !== "")
			<p style="padding-left:20px; font-size: 18px; font-weight:bold; margin:28px 0px 5px 0px">OBA Details</p>
			<table style="margin-top:5px; border:solid black 0px; padding-left:30px;">
			    @if($oba['mount'])
					<tr><td style="width: 150px;">Father / Grandfather :</td><td style="width: 190px;">
					    @if(($oba['mount'] == 2) || ($oba['mount'] == 12))
					        Father
					    @elseif(($oba['mount'] == 3) || ($oba['mount'] == 13))
					        Paternal Grandfather
					    @elseif(($oba['mount'] == 4) || ($oba['mount'] == 14))
					        Maternal Grandfather
					    @endif
					    </td><td style="width: 150px;"></td><td style="width: 190px;"></td></tr>
					<br/>
				@endif
				@if($oba['mount'] >= 10)
					<tr><td style="width: 150px;">Mount Lavinia :</td><td style="width: 190px;">YES</td><td style="width: 150px;"></td><td style="width: 190px;"></td></tr>
					<tr><td>From : </td><td>{{$oba['mount_from']}}</td><td>To : </td><td>{{$oba['mount_to']}}</td></tr>
					<tr><td>House : </td><td>{{$oba['house']}}</td><td>Admission No. : </td><td>{{$oba['admission']}}</td></tr>
					<br/>
				@endif
				@if($oba['guru'])
					<tr><td>Gurutalawa :</td><td>YES</td><td></td><td></td></tr>
					<tr><td>From : </td><td>{{$oba['guru_from']}}</td><td>To : </td><td>{{$oba['guru_to']}}</td></tr>
					<br/>
				@endif
				@if($oba['banda'])
					<tr><td>Bandarawela :</td><td>YES</td><td></td><td></td></tr>
					<tr><td>From : </td><td>{{$oba['banda_from']}}</td><td>To : </td><td>{{$oba['banda_to']}}</td></tr>
					<br/>
				@endif
				@if($oba['prep'])
					<tr><td>Kollupitiya :</td><td>YES</td><td></td><td></td></tr>
					<tr><td>From : </td><td>{{$oba['prep_from']}}</td><td>To : </td><td>{{$oba['prep_to']}}</td></tr>
					<br/>
				@endif
				@if($oba['oba_member'])
					<tr><td>OBA Member :</td><td>YES</td><td></td><td></td></tr>
					<tr><td>OBA Number : </td><td>{{$oba['oba_number']}}</td><td>Joining Date : </td><td>{{$oba['oba_date']}}</td></tr>
				@else
					<tr><td>OBA Member :</td><td>NO</td><td></td><td></td></tr>
				@endif
			</table><br/>
		@endif
		@if($staff['mother_staff'])
			<p style="padding-left:20px; font-size: 18px; font-weight:bold; margin:28px 0px 5px 0px">Mother is a member of staff</p>
			<table style="border:solid black 0px; padding-left:30px;">
				<tr><td style="width: 150px;">Name :</td><td style="width: 540px;">{{$staff['mother_name']}}</td></tr>
				<tr><td>Joined Date :</td><td>{{$staff['mother_joined']}}</td></tr>
				<tr><td>Section :</td><td>{{$staff['mother_section']}}</td></tr>
				<tr><td>EPF :</td><td>{{$staff['mother_EPF']}}</td></tr>
			</table><br/>
		@endif
		@if($staff['father_staff'])
			<p style="padding-left:20px; font-size: 18px; font-weight:bold; margin:28px 0px 5px 0px">Father is a member of staff</p>
			<table style="border:solid black 0px; padding-left:30px;">
				<tr><td style="width: 150px;">Name :</td><td style="width: 540px;">{{$staff['father_name']}}</td></tr>
				<tr><td>Joined Date :</td><td>{{$staff['father_joined']}}</td></tr>
				<tr><td>Section :</td><td>{{$staff['father_section']}}</td></tr>
				<tr><td>EPF :</td><td>{{$staff['father_EPF']}}</td></tr>
			</table><br/>
		@endif
		@if(($section == "Branch Schools") || ($section == "ALevels") || ($section == "Grade 6"))
			<p style="padding-left:20px; font-size: 18px; font-weight:bold; margin:28px 0px 5px 0px">Examination Results</p>
			<table style="border:solid black 0px; padding-left:30px;">
			@if($section == "Grade 6")
				<tr><td style="width: 150px;">Schol Index :</td><td style="width: 540px;">{{$results['scholindex']}}</td></tr>
				<tr><td>Schol Marks :</td><td>{{$results['scholmark']}}</td></tr>
			@else
				@if($section == "ALevels")
					<tr><td style="width: 150px;">O/Level Index :</td><td style="width: 540px;">{{$results['olindex']}}</td></tr>
				@endif
				<tr><td style="width: 250px;">Religion :</td><td style="width: 340px;">{{$results['olreligion']}}</td></tr>
				<tr><td>First Language : </td><td>{{$results['olfirstlang']}}</td></tr>
				<tr><td>English : </td><td>{{$results['olenglish']}}</td></tr>
				<tr><td>Science : </td><td>{{$results['olscience']}}</td></tr>
				<tr><td>Math : </td><td>{{$results['olmath']}}</td></tr>
				<tr><td>History : </td><td>{{$results['olhistory']}}</td></tr>
				<tr><td>{{$results['olbasket1subject']}} : </td><td>{{$results['olbasket1result']}}</td></tr>
				<tr><td>{{$results['olbasket2subject']}} : </td><td>{{$results['olbasket2result']}}</td></tr>
				<tr><td>{{$results['olbasket3subject']}} : </td><td>{{$results['olbasket3result']}}</td></tr>
			@endif
			</table><br/>
		@endif
		@if($section == "International ALevels")
			<p style="padding-left:20px; font-size: 18px; font-weight:bold; margin:28px 0px 5px 0px">Mock Examination Results</p>
			<table style="border:solid black 0px; padding-left:30px;">
				<tr><td>English : </td><td>{{$results['olenglish']}}</td></tr>
				<tr><td>Math : </td><td>{{$results['olmath']}}</td></tr>
				<tr><td>{{$results['olreligion']}} : </td><td>{{$results['olfirstlang']}}</td></tr>
				<tr><td>{{$results['olscience']}} : </td><td>{{$results['olhistory']}}</td></tr>
				<tr><td>{{$results['olbasket1subject']}} : </td><td>{{$results['olbasket1result']}}</td></tr>
				<tr><td>{{$results['olbasket2subject']}} : </td><td>{{$results['olbasket2result']}}</td></tr>
				@if(isset($results['olbasket3subject']))<tr><td>{{$results['olbasket3subject']}} : </td><td>{{$results['olbasket3result']}}</td></tr>@endif
			</table><br/>
		@endif
		@if(($section == "Branch Schools") || ($section == "ALevels") || ($section == "International ALevels"))
			<p style="padding-left:20px; font-size: 18px; font-weight:bold; margin:28px 0px 5px 0px">A/Level Subject Choices</p>
			<table style="border:solid black 0px; padding-left:30px;">
				<tr><td style="width: 150px;">Subject 1 :</td><td style="width: 540px;">{{$subjects['alsubject1']}}</td></tr>
				<tr><td>Subject 2 :</td><td>{{$subjects['alsubject2']}}</td></tr>
				<tr><td>Subject 3 :</td><td>{{$subjects['alsubject3']}}</td></tr>
				<tr><td>Subject 4 :</td><td>{{$subjects['alsubject4']}}</td></tr>
			</table><br/>
		@endif
		<p style="padding-left:20px; font-size: 18px; font-weight:bold; margin:28px 0px 5px 0px">Thomian Connections</p>
		<table style="border:solid black 0px; padding-left:30px;">
			<tr><td style="width: 150px;">Connections :</td><td style="width: 540px;">{{$connections['connection']}}</td></tr>
		</table><br/>
		@if($section != 'Nursery')
			<p style="padding-left:20px; font-size: 18px; font-weight:bold; margin:28px 0px 5px 0px">General</p>
			<table style="border:solid black 0px; padding-left:30px;">
				<tr><td style="width: 150px;">Boarding / Day Boarding :</td><td style="width: 540px;">{{$general['boarding']}}</td></tr>
				@if($section != 'Kindergarten (Grade 1)')
					<tr><td style="width: 150px;">Sports & Games :</td><td style="width: 540px;">{{$general['sports']}}</td></tr>
					<tr><td>Clubs & Societies :</td><td>{{$general['societies']}}</td></tr>
					<tr><td>Other Achievements :</td><td>{{$general['other']}}</td></tr>
				@endif		
			</table><br/>
		@endif
	</main>
</body>
</html>