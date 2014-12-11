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
					{{ HTML::linkRoute('coorMentorHome', 'Profile', [], ['class'	=> 'list-group-item', 'id'	=> 'profileLk']) }}
					@if(Session::get('entityDtl')['coor_flag'] == 1 || Session::get('entityDtl')['coor_flag'] == 2)
					{{ HTML::linkRoute('project', 'Register Project', [], ['class'	=> 'list-group-item', 'id'	=> 'regProLk']) }}
					@endif
					@if(Session::get('entityDtl')['eyic_flag'] == 1)
					{{ HTML::linkRoute('mentorproject', 'Mentored Projects', [], ['class'	=> 'list-group-item', 'id'	=> 'menProLk']) }}
					@endif
					{{ HTML::linkRoute('dcoor', 'Coordinator Document', [], ['class'	=> 'list-group-item', 'id'	=> 'coorDocLk']) }}
					{{ HTML::linkRoute('dmentor', 'Mentor and Student Info', [], ['class'	=> 'list-group-item', 'id'	=> 'menStdntDocLk']) }}
					{{ HTML::linkRoute('dplag', 'Plagiarism', [], ['class'	=> 'list-group-item', 'id'	=> 'plagDocLk']) }}
				</div>
			</div>
			
			<div class="col-md-9" >
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
		</div>

	</div>
	@include('includes.footer')
</body>
</html>