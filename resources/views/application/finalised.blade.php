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
		<embed src="{{url('uploads/' . $id . '_pdf.pdf')}}" height="1000px" width="100%"/>
	</div>
@endsection