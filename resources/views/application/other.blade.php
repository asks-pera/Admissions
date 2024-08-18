@extends('layout')

@section('header')
<script type='text/javascript'>
	function STC_Sel(child){
		if(document.getElementById('chkOther_' + child + '_STC').checked == true) {
			document.getElementById('txtOther_' + child + '_Class').disabled = false;
			document.getElementById('txtOther_' + child + '_House').disabled = false;
			document.getElementById('txtOther_' + child + '_Admission').disabled = false;
			document.getElementById('txtOther_' + child + '_Medium').disabled = false;
			document.getElementById('txtOther_' + child + '_Joined').disabled = false;	
			document.getElementById('txtOther_' + child + '_Joined_Grade').disabled = false;		
			document.getElementById('txtOther_' + child + '_School').disabled = true;
		} else {
			document.getElementById('txtOther_' + child + '_Class').disabled = true;
			document.getElementById('txtOther_' + child + '_House').disabled = true;
			document.getElementById('txtOther_' + child + '_Admission').disabled = true;
			document.getElementById('txtOther_' + child + '_Medium').disabled = true;
			document.getElementById('txtOther_' + child + '_Joined').disabled = true;	
			document.getElementById('txtOther_' + child + '_Joined_Grade').disabled = true;	
			document.getElementById('txtOther_' + child + '_School').disabled = false;
		} 
	}

	function SelectSiblings() {
		var num = document.getElementById('num').value;
		var names = {!!$names!!};
		var sex = {!!$sexes!!};
		var dob  = {!!$dobs!!};
		var stc = {!!$stcs!!};
		var classes ={!!$classes!!};
		var house = {!!$houses!!};
		var admission = {!!$admissions!!};
		var medium = {!!$mediums!!};
		var joined = {!!$joined!!};
		var joinedgrade = {!!$joinedGrade!!};
		var school = {!!$schools!!};
		var other = "";
		for(var i = 1; i <= num; i++) {
			other += "<div style=\"border-style:solid; border-color:#999999; padding:10px; border-width:1px; margin:5px 0px;\"><h4 style=\"text-align:center; font-weight:bold; padding:10px 0;\">Child " + i + "</h4><div class=\"form-group row\" style=\"padding-bottom:20px;\"><label class=\"col-md-4 col-form-label\" for=\"txtOther_" + i + "_Name\">* Enter the full name of child</label><div class=\"col-md-8\"><input class=\"form-control\" type=\"text\" maxlength=\"100\" required placeholder=\"Enter the full name of child\" id=\"txtOther_" + i + "_Name\" name=\"txtOther_" + i + "_Name\" value=\"" + names[i - 1] + "\"/></div></div><div class=\"form-group row\" style=\"padding-bottom:20px;\"><label class=\"col-md-4 col-form-label\" for=\"txtOther_" + i + "_Sex\">* Sex</label><div class=\"col-md-8\">";
			if(sex[i-1] == "Male") {
				other += "<select id=\"txtOther_" + i + "_Sex\" name=\"txtOther_" + i + "_Sex\" class=\"form-control\" required><option value=\"Male\" selected>Male</option><option value=\"Female\">Female</option></select>";
			} else if(sex[i-1] == "Female") {
				other += "<select id=\"txtOther_" + i + "_Sex\" name=\"txtOther_" + i + "_Sex\" class=\"form-control\" required><option value=\"Male\">Male</option><option value=\"Female\" selected>Female</option></select>";
			} else {
				other += "<select id=\"txtOther_" + i + "_Sex\" name=\"txtOther_" + i + "_Sex\" class=\"form-control\" required><option value=\"Male\">Male</option><option value=\"Female\">Female</option></select>";
			}
			other += "</div></div><div class=\"form-group row\" style=\"padding-bottom:20px;\"><label class=\"col-md-4 col-form-label\"for=\"txtOther_" + i + "_DOB\">* Date of Birth</label><div class=\"col-md-8\"><input type=\"date\" class=\"form-control\" required id=\"txtOther_" + i + "_DOB\" name=\"txtOther_" + i + "_DOB\" value=\"" + dob[i-1] + "\"/></div></div><div class=\"form-group row\" style=\"padding-bottom:20px;\"><label class=\"col-md-6 col-form-label\"for=\"chkOther_" + i + "_STC\">Attends S. Thomas' College, Mount Lavinia</label><div class=\"col-md-1\" style=\"padding-top:15px\">";
			if(stc[i-1] == 1) {
				other += "<input class=\"form-control\" type=\"checkbox\" id=\"chkOther_" + i + "_STC\" name=\"chkOther_" + i + "_STC\" onclick=\"STC_Sel(" + i + ")\" checked /></div></div><div class=\"form-group row\" style=\"padding-bottom:20px;\"><label class=\"col-md-4 col-form-label\" for=\"txtOther_" + i + "_Class\">* Enter Class in STC</label><div class=\"col-md-8\"><input class=\"form-control\" type=\"text\" maxlength=\"15\" placeholder=\"Enter son's class in STC\" id=\"txtOther_" + i + "_Class\" name=\"txtOther_" + i + "_Class\" required value=\"" + classes[i-1] +"\" /></div></div><div class=\"form-group row\" style=\"padding-bottom:20px;\"><label class=\"col-md-4 col-form-label\" for=\"txtOther_" + i + "_House\">* House</label><div class=\"col-md-8\"><select id=\"txtOther_" + i + "_House\" name=\"txtOther_" + i + "_House\" class=\"form-control\" required ><option value=\"\">* Select House</option>";
				if(house[i-1] == "Boarding") other += "<option value=\"Boarding\" selected>Boarding House (including Winchester)</option>";
				else other += "<option value=\"Boarding\">Boarding House (including Winchester)</option>";
				if(house[i-1] == "Buck") other += "<option value=\"Buck\" selected>Buck House</option>";
				else other += "<option value=\"Buck\">Buck House</option>";
				if(house[i-1] == "De Saram") other += "<option value=\"De Saram\" selected >De Saram House</option>";
				else other += "<option value=\"De Saram\">De Saram House</option>";
				if(house[i-1] == "Stone") other += "<option value=\"Stone\" selected>Stone House</option>";
				else other += "<option value=\"Stone\">Stone House</option>";
				if(house[i-1] == "Wood") other += "<option value=\"Wood\" selected>Wood House</option>";
				else other += "<option value=\"Wood\">Wood House</option>";
				other += "</select></div></div><div class=\"form-group row\" style=\"padding-bottom:20px;\"><label class=\"col-md-4 col-form-label\" for=\"txtOther_" + i + "_Admision\">* Enter Admission No. at STC</label><div class=\"col-md-8\"><input class=\"form-control\" type=\"text\" maxlength=\"5\" placeholder=\"Enter son's Admission No. at STC\" id=\"txtOther_" + i + "_Admission\" name=\"txtOther_" + i + "_Admission\" required value=\"" + admission[i-1] + "\" /></div></div><div class=\"form-group row\" style=\"padding-bottom:20px;\"><label class=\"col-md-4 col-form-label\"for=\"txtOther_" + i + "_Medium\">* Medium of Study</label><div class=\"col-md-8\"><select id=\"txtOther_" + i + "_Medium\" name=\"txtOther_" + i + "_Medium\" class=\"form-control\" required ><option value=\"\">Select Medium</option>";
				if(medium[i-1] == "Sinhala") other+= "<option value=\"Sinhala\" selected>Sinhala</option>";
				else other+= "<option value=\"Sinhala\">Sinhala</option>";
				if(medium[i-1] == "Tamil") other += "<option value=\"Tamil\" selected>Tamil</option>"; 
				else other += "<option value=\"Tamil\">Tamil</option>"; 
				if(medium[i-1] == "Bi-Lingual") other += "<option value=\"Bi-Lingual\" selected>Bi-Lingual</option>";
				else other += "<option value=\"Bi-Lingual\">Bi-Lingual</option>";
				other += "</select></div></div><div class=\"form-group row\" style=\"padding-bottom:20px;\"><label class=\"col-md-4 col-form-label\" for=\"txtOther_" + i + "_Joined\">* When did he join STC?</label><div class=\"col-md-8\"><input class=\"form-control\" type=\"date\" placeholder=\"Enter when your son entered STC\" id=\"txtOther_" + i + "_Joined\" name=\"txtOther_" + i + "_Joined\" required value=\"" + joined[i-1] +"\" /></div></div><div class=\"form-group row\" style=\"padding-bottom:20px;\"><label class=\"col-md-4 col-form-label\" for=\"txtOther_" + i + "_Joined_Grade\">* Enter Grade at which he joined STC</label><div class=\"col-md-8\"><input class=\"form-control\" type=\"text\" maxlength=\"25\" placeholder=\"Enter son's class when he joined STC\" id=\"txtOther_" + i + "_Joined_Grade\" name=\"txtOther_" + i + "_Joined_Grade\" required value=\"" + joinedgrade[i-1] +"\" /></div></div><div class=\"form-group row\" style=\"padding-bottom:20px;\"><label class=\"col-md-4 col-form-label\" for=\"txtOther_" + i + "_School\">* Enter name of the child's school</label><div class=\"col-md-8\"><input class=\"form-control\" type=\"text\" maxlength=\"100\" placeholder=\"Enter name of school other than STC\" id=\"txtOther_" + i + "_School\" name=\"txtOther_" + i + "_School\" required disabled /></div></div></div>";
			} else {
				other += "<input class=\"form-control\" type=\"checkbox\" id=\"chkOther_" + i + "_STC\" name=\"chkOther_" + i + "_STC\" onclick=\"STC_Sel(" + i + ")\"/></div></div><div class=\"form-group row\" style=\"padding-bottom:20px;\"><label class=\"col-md-4 col-form-label\" for=\"txtOther_" + i + "_Class\">* Enter Class in STC</label><div class=\"col-md-4\"><input class=\"form-control\" type=\"text\" maxlength=\"15\" placeholder=\"Enter son's class in STC\" id=\"txtOther_" + i + "_Class\" name=\"txtOther_" + i + "_Class\" disabled /></div></div><div class=\"form-group row\" style=\"padding-bottom:20px;\"><label class=\"col-md-4 col-form-label\" for=\"txtOther_" + i + "_House\">* House</label><div class=\"col-md-8\"><select id=\"txtOther_" + i + "_House\" name=\"txtOther_" + i + "_House\" class=\"form-control\" disabled><option value=\"\">* Select House</option><option value=\"Boarding\">Boarding House (including Winchester)</option><option value=\"Buck\">Buck House</option><option value=\"De Saram\">De Saram House</option><option value=\"Stone\">Stone House</option><option value=\"Wood\">Wood House</option></select></div></div><div class=\"form-group row\" style=\"padding-bottom:20px;\"><label class=\"col-md-4 col-form-label\" for=\"txtOther_" + i + "_Admision\">* Enter Admission No. at STC</label><div class=\"col-md-8\"><input class=\"form-control\" type=\"text\" maxlength=\"5\" placeholder=\"Enter son's Admission No. at STC\" id=\"txtOther_" + i + "_Admission\" name=\"txtOther_" + i + "_Admission\" disabled /></div></div><div class=\"form-group row\" style=\"padding-bottom:20px;\"><label class=\"col-md-4 col-form-label\" for=\"txtOther_" + i + "_Medium\">* Medium of Study</label><div class=\"col-md-8\"><select id=\"txtOther_" + i + "_Medium\" name=\"txtOther_" + i + "_Medium\" class=\"form-control\" disabled><option value=\"\">Select Medium</option><option value=\"Sinhala\">Sinhala</option><option value=\"Tamil\">Tamil</option><option value=\"BiLingual\">Bi-Lingual</option></select></div></div><div class=\"form-group row\" style=\"padding-bottom:20px;\"><label class=\"col-md-4 col-form-label\" for=\"txtOther_" + i + "_Joined\">* When did he join STC?</label><div class=\"col-md-8\"><input class=\"form-control\" type=\"date\" placeholder=\"Enter when your son entered STC\" id=\"txtOther_" + i + "_Joined\" name=\"txtOther_" + i + "_Joined\" disabled /></div></div><div class=\"form-group row\" style=\"padding-bottom:20px;\"><label class=\"col-md-4 col-form-label\" for=\"txtOther_" + i + "_Joined_Grade\">* Enter Grade at which he joined STC</label><div class=\"col-md-8\"><input class=\"form-control\" type=\"text\" maxlength=\"25\" placeholder=\"Enter son's class when he joined STC\" id=\"txtOther_" + i + "_Joined_Grade\" name=\"txtOther_" + i + "_Joined_Grade\" disabled /></div></div><div class=\"form-group row\" style=\"padding-bottom:20px;\"><label class=\"col-md-4 col-form-label\" for=\"txtOther_" + i + "_School\">* Enter name of the child's school</label><div class=\"col-md-8\"><input class=\"form-control\" type=\"text\" maxlength=\"100\" placeholder=\"Enter name of school other than STC\" id=\"txtOther_" + i + "_School\" name=\"txtOther_" + i + "_School\" value=\"" + school[i-1] +"\"/></div></div></div>";
			}
		}
		document.getElementById("otherChildren").innerHTML = other;
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
	<h2>Other Children's Details</h2>
	<div class="row border border-dark rounded" style="margin:10px; padding:50px; display:block;">
		<form method="post" action="">
			@csrf
			<input type="hidden" value="{{$id}}" name="id" />
			<div class="form-group row" style="padding-bottom: 20px;">
				<label class="col-md-8 col-form-label" for="num">* How many other children in the family, <strong>excluding the child for whom admission is sought</strong> using this form?</label>
				<div class="col-md-4"><select class="form-control" id="num" name="num" required onchange="SelectSiblings()">
					<option value="0" @if((isset($num)) && ($num == '0')) selected @elseif(old('num')=='0') selected @endif>0</option>
					<option value="1" @if((isset($num)) && ($num == '1')) selected @elseif(old('num')=='1') selected @endif>1</option>
					<option value="2" @if((isset($num)) && ($num == '2')) selected @elseif(old('num')=='2') selected @endif>2</option>
					<option value="3" @if((isset($num)) && ($num == '3')) selected @elseif(old('num')=='3') selected @endif>3</option>
					<option value="4" @if((isset($num)) && ($num == '4')) selected @elseif(old('num')=='4') selected @endif>4</option>
				</select></div>
			</div>
			<div id="otherChildren"></div>	
			<div class="row">
				<div class="col-md-6 text-center"><a class="btn btn-primary btn-lg" style="margin:10px 0;" type="button" href="{{url('application/status')}}">Back</a></div>
				<div class="col-md-6 text-center"><input class="btn btn-primary btn-lg" style="margin:10px 0;" type="submit" value="{{$text}}" id="cmdSave" name="cmdSave"/></div>
			</div>	
		</form>
	</div>
	<script type="text/javascript">
		SelectSiblings();
	</script>
@endsection