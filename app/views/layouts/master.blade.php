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
	<div class="container" style="margin-top:85px;">
		<!-- Content -->
		<div class="row">
			
			<div class="col-md-2">
				<div class="list-group">				 
				  <a href="{{URL::Route('coorMentorHome')}}" <?php if ($link == 1): ?>class="list-group-item active"<?php else: ?>class="list-group-item"<?php endif ?>>Profile</a>
				  <?php if(Session::get('entityDtl')['coor_flag'] == 1 || Session::get('entityDtl')['coor_flag'] == 2){ ?>
				  	<a href="{{URL::Route('project')}}"<?php if ($link == 2): ?>class="list-group-item active"<?php else: ?>class="list-group-item"<?php endif ?>>Projects</a>
				  <?php } ?>
				  <?php if(Session::get('entityDtl')['eyic_flag'] == 1) { ?>
				  	<a href="{{URL::Route('mentorproject')}}"<?php if ($link == 3): ?>class="list-group-item active"<?php else: ?>class="list-group-item"<?php endif ?>>Mentor Projects</a>
				  <?php } ?>
				  <a href="#" class="list-group-item">Resources</a>				  
				</div>
			</div>
			
			<div class="col-md-7" >
				@if(Session::has('success'))
				<div class="alert alert-success">{{ Session::get('success') }}</div>
				@elseif (!empty($success))
				<div class="alert alert-success">{{ $success }}</div>
				@endif

				@if ($errors->has())
				<div class="alert alert-danger">
					@foreach ($errors->all() as $error)
					{{ $error }}<br/>
					@endforeach
				</div>
				@endif

				@yield('content')
			</div>
			
			<div class="col-md-3">
				@yield('notice')
			</div>
		</div>

	</div>
	@include('includes.footer')
</body>
</html>