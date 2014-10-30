<html>
<head>
	@include('includes.head')
	@section('style')
	@show
</head>
<body>
	@include('layouts.login-navbar')
	<!-- Container -->
	<div class="container-fluid">
		<!-- Content -->
		@yield('content')
	</div>

	@include('includes.footer')
</body>
</html>