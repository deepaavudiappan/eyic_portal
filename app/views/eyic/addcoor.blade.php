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
				<h3 class="panel-title">Register for eYantra Ideas Competition (eYIC-2015)</h3>
			</div>
			<div class="panel-body">
				{{ Form::open(array('route' => 'addCoorSave', 'method' => 'POST')) }}
				<label class="control-label" for="lbl_clg_select">Select your College:</label> 
				{{ Form::select('college', $clgs,[], ['class' => 'form-control'] );}}<br/>
				<div class="alert alert-info">If your college is not in the list please contact us on support@e-yantra.org or call us at 022-2572-0184.</div>
				<div class="alert alert-info">
					<strong>The coordinator is responsible for the following tasks:</strong><br/>
					<ul>
						<li>Publicizing eYIC-2015 in the college</li>
						<li>Call for projects in embedded systems and robotics from all the departments</li>
						<li>Finalize upto 4 projects based on an evaluation template that e-Yantra will provide</li>
						<li>Register these projects on the online portal</li>
					</ul>
					<br/>
					Subsequently, the coordinator will be CC’ed on all communications that e-Yantra has with the participating teams.
				</div>
				<div class="form-group @if ($errors->has('pcoor_name')) has-error @endif">
					<label class="control-label" for="lbl_pcoor_name">Primary Coordinator Name:</label>
					<input type="text" id="pcoor_name" class="form-control" name="pcoor_name" placeholder="" value="{{ Input::old('pcoor_name') }}"/>
					@if ($errors->has('pcoor_name')) <p class="help-block">{{ $errors->first('pcoor_name') }} </p>@endif
				</div>
				<div class="form-group @if ($errors->has('pcoor_email')) has-error @endif">
					<label class="control-label" for="lbl_pcoor_email">Primary Coordinator e-mail:</label>
					<input type="text" id="pcoor_email" class="form-control" name="pcoor_email" placeholder="example@example.com" value="{{ Input::old('pcoor_email') }}"/>
					@if ($errors->has('pcoor_email')) <p class="help-block">{{ $errors->first('pcoor_email') }} </p>@endif
				</div>
				<div class="form-group @if ($errors->has('scoor_name')) has-error @endif">
					<label for="lbl_scoor_name">Secondary Coordinator Name:</label>
					<input type="text" id="scoor_name" class="form-control" name="scoor_name" placeholder="" value="{{ Input::old('scoor_name') }}"/>
					@if ($errors->has('scoor_name')) <p class="help-block">{{ $errors->first('scoor_name') }} </p>@endif
				</div>
				<div class="form-group @if ($errors->has('scoor_email')) has-error @endif">
					<label for="lbl_scoor_email">Secondary Coordinator e-mail:</label>
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
				<p>eYIC stands for e-Yantra Ideas Competition, an initiative to encourage innovative projects from robotics labs set up through the e-Yantra Lab Setup Initiative (eLSI), in colleges across the country.</p>
			</div>
		</div>

		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">2. What are the aims of eYIC?</h3>
			</div>
			<div class="panel-body">
				<ul>
					<li>To ensure sustained use of the robotics labs set up through the e-Yantra Lab Setup Initiative (eLSI).</li>
					<li>To encourage<strong> innovative ideas</strong> from students in eLSI colleges across the country.</li>
					<li>To provide a platform for teams to showcase their projects.</li>
					<li>To nurture BE projects in Embedded Systems and Robotics at the eLSI colleges.</li>
					
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
				<ul>
				<li> Team submits a proposal – an idea -- for a project as per given template.</li>
				<li> Proposals are evaluated and teams are selected for Stage-2.</li>
				</ul>
				<strong>Stage 2:</strong><br/>
				<ul>
				<li>Selected Teams implement their proposed idea.</li>
				<li>Each team submits a video of the working demonstration of the idea through a video link.</li>
				<li>Selected teams will be invited to showcase their ideas in an exhibition during the e-Yantra Symposium (eYS-2015).</li>
				<li>All Selected teams will get cash prizes.</li>
				</ul>
				<strong>Stage 3:</strong><br/>
				<ul>
				<li>Exhibited projects will be judged by a panel of judges.</li>
				<li>Winning entries will be awarded exciting prizes and certificates.</li>
				</ul>
				<p><strong>Proposed Date for eYS-2015: Second week of April 2015.</strong></p>
			</div>
		</div>

		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">4. What are the guidelines for eYIC?</h3>
			</div>
			<div class="panel-body">
				<ul>
					<li>Since this is a pilot phase we are restricting the number of teams selected. A maximum of four teams per eLSI college is allowed to participate. A faculty co-ordinator will select four teams from their college who will be registered for the competition.</li>
					<li>Teams should consist of 3 or 4 student members mentored by one teacher. All the students should be from the same year but can be from different branches.</li>
					<li>The project must be from the domain of embedded systems and robotics.</li>
					<li>Teams are required to use any processing board available in the eLSI labs. (Firebird V, Raspberry Pi, BeagleBoard and Arduino). More details will be provided along with the proposal template.</li>
				</ul>
			</div>
		</div>
	</div>
</div>
@stop