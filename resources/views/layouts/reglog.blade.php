<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('topline')</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('public/css/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('public/css/sb-admin-2.css?v=11')}}" rel="stylesheet">
    <link href="{{asset('public/css/custom.css')}}" rel="stylesheet">

</head>

<body>

    @yield('content')
    <script src="{{asset('public/js/jquery.min.js')}}"></script>
    <script src="{{asset('public/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('public/js/jquery.easing.min.js')}}"></script>
    <script src="{{asset('public/js/sb-admin-2.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
	        $("#type").change(function() {
		        var selectedVal = $("#type option:selected").val();
		        if(selectedVal=='2')
                {
                    $("#uuu").removeClass("hidden");
                }else{
                    $("#uuu").addClass("hidden");
                }
	        });
        });
    </script>
</body>

</html>