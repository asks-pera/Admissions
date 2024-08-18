@extends('layout')

@section('navigation')
    <a style="margin: 0px 10px" class="btn btn-primary btn-primary" href="{{url('admin/login')}}">Admin</a>
    @if(count($states) >0)
        <a style="margin: 0px 10px" class="btn btn-primary btn-primary" href="{{url('application/login')}}">Application</a>
    @endif
@endsection

@section('year')
    - {{date('Y')}}
@endsection

@section('content')
    @if(isset($info))
        <div class="alert alert-info">{{$info}}</div>
    @endif
    <h2 class="text-center">Admissions</h2><br/>
    <p>Admissions applications open for various grades at various times of the year.</p>
    <p>The relevant application form will be made available only during that time.</p>
    <p>Please check here regularly for the application form to be available.</p>
    <p><strong>Please note the following:-</strong>
        <ul>
            <li>Applications for admission will <strong>only</strong> be accepted if completed using this website.</li>
            <li>Please do not give anyone money for admissions. No one is authorised to collect money for College.</li>
        </ul>
    </p><br/>
    <ul>
    @foreach ($settings as $setting)
        <li><strong>{{$setting['name']}}</strong> applications for {{$setting['year']}} will be open from <strong>{{$setting['open']}}</strong> to <strong>{{$setting['close']}}</strong></li><br/>
    @endforeach
    </ul><br />
    <h3>Application Forms which are open are :</h3>
    <p class="text-center">

    @if(count($states) == 0)
        <div class="alert alert-danger text-center">ALL APPLICATIONS CLOSED</div>
    @else
        @foreach ($states as $state)
            <a style="margin:0px 20px" href="{{url($state['link'])}}" class='btn btn-primary btn-lg' style='margin:10px'>{{$state['name']}}</a>
        @endforeach
    @endif
    </p>
@endsection