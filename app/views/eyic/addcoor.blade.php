@extends('layouts.login-master')
@section('styles')
@stop

@section('content')
<div class="row" style="top-margin: 50px">
	<div class="col-md-5 col-md-offset-1">
		
		@if ($errors->has())
		<div class="alert alert-danger">
		@foreach ($errors->all() as $error)
		{{ $error; }}
		@endforeach
		</div>
		@endif

		@if(isset($flag))
		@else
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Register for eYantra Ideas Competition (eYIC) Pilot</h3>
			</div>
			<div class="panel-body">
				{{ Form::open(array('route' => 'addCoorSave', 'method' => 'POST')) }}
				<label class="control-label" for="lbl_clg_select">Select your College:</label> 
				{{ Form::select('college', $clgs,[], ['class' => 'form-control'] );}}<br/>
				<div class="alert alert-info">If your college is not in the list please contact us on support@e-yantra.org or call us at xxx.</div>
				<div class="form-group @if ($errors->has('pcoor_name')) has-error @endif">
					<label class="control-label" for="lbl_pcoor_name">Primary Coordinator Name:</label>
					<input type="text" id="pcoor_name" class="form-control" name="pcoor_name" placeholder="" value="{{ Input::old('pcoor_name') }}"/>
					@if ($errors->has('pcoor_name')) <p class="help-block">{{ $errors->first('pcoor_name') }} </p>@endif
				</div>
				<div class="form-group @if ($errors->has('pcoor_email')) has-error @endif">
					<label class="control-label" for="lbl_pcoor_email">Primary Coordinator Email:</label>
					<input type="text" id="pcoor_email" class="form-control" name="pcoor_email" placeholder="example@example.com" value="{{ Input::old('pcoor_email') }}"/>
					@if ($errors->has('pcoor_email')) <p class="help-block">{{ $errors->first('pcoor_email') }} </p>@endif
				</div>
				<div class="form-group @if ($errors->has('scoor_name')) has-error @endif">
					<label for="lbl_scoor_name">Secondary Coordinator Name:</label>
					<input type="text" id="scoor_name" class="form-control" name="scoor_name" placeholder="" value="{{ Input::old('scoor_name') }}"/>
					@if ($errors->has('scoor_name')) <p class="help-block">{{ $errors->first('scoor_name') }} </p>@endif
				</div>
				<div class="form-group @if ($errors->has('scoor_email')) has-error @endif">
					<label for="lbl_scoor_email">Secondary Coordinator Email:</label>
					<input type="text" id="scoor_email" class="form-control" name="scoor_email" placeholder="example@example.com" value="{{ Input::old('scoor_email') }}"/>
					@if ($errors->has('scoor_email')) <p class="help-block">{{ $errors->first('scoor_email') }} </p>@endif
				</div>
				<div class="row">
					<div class="col-md-12 text-center">
						{{ Form::submit('Register' , array('class' => 'btn btn-primary')) }}
					</div>
				</div>
				{{ Form::close() }}
			</div>
		</div>
		@endif
	</div>
	<div class="col-md-6 text-justify">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">1. What is eYIC?</h3>
			</div>
			<div class="panel-body">
				<p>eYIC is e-Yantra Ideas competition, an initiative to encourage innovative projects from your robotics labs set up through the e-Yantra Lab Setup Initiative (eLSI), exclusively for the eLSI colleges.</p>
			</div>
		</div>

		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">2. What are the aims of eYIC?</h3>
			</div>
			<div class="panel-body">
				<ul>
					<li>To enable students to attain benefit of the eLSI labs that have been setup in your college, e-Yantra has taken initiative called e-Yantra Ideas Competition (eYIC).</li>
					<li>To encourage innovative ideas from students in eLSI colleges across the country.</li>
					<li>To provide a platform for talented teams to showcase their projects.</li>
					<li>To nurture BE projects in embedded systems and robotics at the eLSI colleges.</li>
					<li>To ensure sustained use of the robotics labs set up through the e-Yantra Lab Setup Initiative (eLSI).</li>
				</ul>
			</div>
		</div>

		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">3. What is the structure of eYIC?</h3>
			</div>
			<div class="panel-body">
				<p>e-Yantra Ideas Competition (eYIC- 2015) will be held as part of e-Yantra Symposium (eYS-2015).</p>
				<strong>Stage 1:</strong><br/>
				<p>It would require the teams to submit a proposal – an idea -- for a project. The qualified teams from Stage 1 would be then required to implement the same project and submit a working demonstration of the proposed idea through a video link.</p>
				<strong>Stage 2:</strong><br/>
				<p>Teams selected after Stage 2 will get a chance to showcase their projects in e-Yantra Symposium (eYS-2015) at IIT-B. These projects will be judged and exciting prizes and certificates will be awarded to the winning ideas!</p><br/>
				<p>Projected Date for eYS-2015: Second week of April 2015.</p>
			</div>
		</div>

		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">4. What are the guidelines for eYIC?</h3>
			</div>
			<div class="panel-body">
				<ul>
					<li>Since this would be a pilot phase we would be restricting the number of teams selected to a small number. A maximum of four teams per eLSI college is allowed to participate. College lab in-charge will select four teams from their college who will be registered for the competition.</li>
					<li>Teams would consist of 3 or 4 student members mentored by one teacher. All the students should be from the same year but can be from different branch.</li>
					<li>The project must be from the domain of embedded systems and robotics.</li>
					<li>Teams are required to use any processing board available in the eLSI labs. (Firebird V, Raspberry Pi, BeagleBoard & Arduino,etc)</li>
				</ul>
			</div>
		</div>
	</div>
</div>
@stop