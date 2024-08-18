@extends('layout')

@section('navigation')
    <a style="margin: 0px 10px" class="btn btn-primary btn-primary" href="{{url('admin')}}">Back</a>
    <a style="margin: 0px 10px" class="btn btn-primary btn-primary" href="{{url('admin/logout')}}">Logout</a>
@endsection

@section('header')
    <meta name="csrf-token" content="{{csrf_token()}}">
	<script type="text/javascript">
		$.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token]').attr('content')}
        });
		function overrideClicked()
		{
			var value = false;
			if(document.getElementById('overrideApplication').checked == true)
				value = true;
			$.ajax({
				type:'POST',
				url:"{{url('admin/settings/override')}}",
				data:{
					value: value,
					_token:'{{csrf_token()}}',
				},
				success: function(data) {
					console.log(data);
					document.getElementById('result').innerHTML = data.success;
				},
				error: function(data, textStatus, errorThrown) {
					console.log(data);
				},
			});
		}
	</script>
@endsection

@section('content')
	<h2>Select record to change</h2>
	<div style="padding-left:3em">
	@foreach ($setting as $item)
		<h3><a href="{{route('settings.edit', $item['id'])}}">{{$item['name']}}</a> for {{$item['year']}}</h3>
		<ul>
			<li>{{$item['open']}}</li>
			<li>{{$item['close']}}</li>
		</ul>
	@endforeach
	</div>
	<div style="text-align: right"><p><a href="{{ route('settings.create') }}">Create Item</a></p></div>
	<div style="text-align:left"><p>Override Application <input type="checkbox" name="overrideApplication" id="overrideApplication" onchange="overrideClicked()" @if($override == true) checked @endif><div style="color:green;" id="result"></div></p></div>
@endsection