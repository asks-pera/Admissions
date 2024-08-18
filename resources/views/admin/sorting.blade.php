@extends ('layout')

@section('navigation')
	<a style="margin: 0px 10px" class="btn btn-primary btn-primary" href="{{URL::previous()}}">Back</a>
@endsection

@section('header')
	<meta name="csrf-token" content="{{csrf_token()}}">
	<script type="text/javascript">
		function LoadData() 
		{
			$.ajax({
                type:'POST',
                url:"{{url('admin/loaddata')}}",
                data:{ 
                    section : document.getElementById('section').value, 
                    year : document.getElementById('year').value, 
                    _token:'{{csrf_token()}}' },
                success:function(data) {
                    document.getElementById('LoadedData').innerHTML = data.success;
                },
                error: function(data, textStatus, errorThrown) {
                    console.log(data);
                },
            });
		}
	</script>
@endsection

@section('content')
	<h2 style="text-align: center;">Sort Applications</h2>
	<div class = "row" style="padding-bottom: 20px;">
		<div class="col-lg-2 col-md-2 col-sm-5 col-xs-12"><label for="section">* Section</label></div>
		<div class="col-lg-4 col-md-4 col-sm-7 col-xs-12">
			<select class="form-control" id="section" name="section">
				<option value="">Select Section</option>
				<option value="Nursery">Nursery</option>
				<option value="Kindergarten (Grade 1)">Kindergarten (Grade 1)</option>
				<option value="Other Grades">Other Grades</option>
				<option value="Grade 6">Grade 6</option>
				<option value="Branch Schools">Branch Schools</option>
				<option value="ALevels">ALevels</option>
				<option value="International ALevels">International ALevels</option>
			</select>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-5 col-xs-12"><label for="year">* Year</label></div>
		<div class="col-lg-4 col-md-4 col-sm-7 col-xs-12">
			<select class="form-control" id="year" name="year">
				<option value="">Select Year</option>
				<option value="2022">2022</option>
				<option value="2023">2023</option>
				<option value="2024">2024</option>
			</select>
		</div>
	</div>
	<div style="text-align:center;"><div class="btn btn-primary" onclick="LoadData()">Load Data</div>

	<div id="LoadedData"></div>
@endsection