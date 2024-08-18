@extends ('layout');

@section ('content')
    <input type="button" onclick="Clicked()" value="Click"/>
    
    <script type="text/javascript">
        function Clicked() 
        {
            window.location.replace('https://fees.stcmount.com/testreturn');
        }
        
    </script>
@endsection