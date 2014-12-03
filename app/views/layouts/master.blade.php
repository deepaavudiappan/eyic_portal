<html>
<head>
	@include('includes.head') 
	@section('style')
	@show
	<style>
		.subMenu {
		    background: linear-gradient(to right, #ffffff 0%, #f4f4f4 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
		    border-right: 1px solid #e7e7e7;		    
		    list-style: none outside none;
		    padding-top: 55px;
		}
		.subMenu li {		    
		    border-top : 1px solid #e7e7e7;
		    border-bottom : 1px solid #e7e7e7;
		}		
		.subMenu a {
		    border-right: 1px solid #e7e7e7;
		    color: #333333;
		    display: block;
		    margin-right: -1px;
		    padding: 14px 0;
		}
		.subMenu a:hover, .subMenu .active a {
		    background: no-repeat scroll left top #ffffff;
		    border-right: medium none;
		    color: #66bb00;
		    text-decoration: none;
		}		
</style>
	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
	<!-- <link rel="icon" href="/img/eyantra.jpg" type="image/x-icon"> -->
	@yield('styles')

</head>

<body>
	@include('includes.navbar')
	<!-- Container -->
	<div class="container" style="margin-top: 85px;min-height:400px;">
		<!-- Content -->		

		@yield('content')
	</div>
	
	
	@include('includes.footer')
</body>

</html>