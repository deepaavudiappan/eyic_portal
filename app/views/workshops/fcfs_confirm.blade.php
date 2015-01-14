@extends('layouts.login-master')
@section('styles')
@stop

@section('content')
@if (!(Session::has('success')) )
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Workshop Registration</h3>
	</div>
	<div class="panel-body">
		<div class="row text-justify">
			<div class="col-md-6 col-md-offset-3">
				{{ Form::open(array('route' => 'clgConfirmFCFS', 'method' => 'POST')) }}
				
				<label style="250px">Please select your college:</label>
				{{ Form::select('clg_id', $clgs, [], ['class' => 'form-control'] );}}<br/><br/>

				Greetings from e-Yantra!<br/>
				<br/>
				e-Yantra is organizing a 2-day workshop on "Introduction to Robotics" for the colleges participating in the e-Yantra Lab setup Initiative (eLSI).<br/>
				<br/>
				To encourage more colleges from your region to participate in this Nation-building initiative, we welcome one team of 4 teachers from your college to participate in the workshop. Selection for participation is on a First Come First Serve (FCFS) basis to fill the capacity of 15 college teams.<br/>
				<br/>
				Date: <strong>February 6th and 7th, 2015</strong><br/>
				Venue: <strong>IIIT Bangalore<br/>
				<span style="margin-left:50px;">No. 26/C, Electronic City, Hosur Road</span><br/>
				<span style="margin-left:50px;">Bangalore - 560100</span><br/></strong>
				Coordinator: <strong>Ms. Roshni DSouza</strong><br/>
				Contact number: <strong>+91-80-4140-7777, +91-9986668421</strong><br/>
				e-mail: <strong>roshni.dsouza@iiitb.ac.in</strong><br/>
				<br/>
				<div class="alert alert-danger">
					<strong>Please note:<br/></strong>
					<br/>
					<ol>
						<li>Formal invitations will be sent to teams from colleges who are <strong>selected</strong> for participation.</li>
						<li>No fee will be collected from any participant. Tea/Lunch will be provided on both the days of workshop.</li>
						<li>All traveling and staying expenses of the team members attending the workshops are borne by their respective colleges.</li>
						<li>Each participating college team member registers at the venue on the first day of workshop. Any change in the team members is allowed till the day of the workshop.</li>
						<li>Teachers will be given a participation certificate from e-Yantra upon successful participation on both days of the workshop.</li>
						<li>Each Teacher team from colleges who are participating in the e-Yantra Lab Setup Initiative (eLSI) by giving the Letter of Intent (LoI) will receive a robotic kit at the end of the workshop. These teams will participate in the e-Yantra Robotics Teacher Competition (eYRTC).</li>
						<li>Colleges who have not given the LoI will not be given the robotic kit and are not eligible for participating in eYRTC.</li>
					</ol>
				</div>
				<div class="alert alert-danger">
					<strong>For colleges who wish to participate in eLSI:</strong><br/>
					Colleges which want to participate in this Nation-building initiative must: (i) nominate a team of 4 teachers– with one member identified as team leader, and (ii) print the attached Letter of Intent (LoI) on letter head, sign, and stamp. The scanned copy may be sent by e-mail at <strong>support@e-yantra.org</strong> and a hard-copy mailed to:<br/>
					<br/>
					e-Yantra project,<br/>
					ERTS lab, First Floor, KReSIT building<br/>
					IIT Bombay<br/>
					Powai, Mumbai - 400 076<br/>
					<br/>
					{{ HTML::linkRoute('downloadLoi', 'Download LOI Template', [], array('class'	=>	'btn btn-primary', 'role' => 'button')); }}<br/>
				</div>
				<br/>
				<div class="alert alert-info">Please fill in the details to register your team of four teachers on or before <strong>January 26th 2015</strong>. Please make sure that <strong>if selected</strong>, all the members of your team will attend the workshop.</div><br/>
				<div class="form-group @if ($errors->has('tl_name')) has-error @endif">
					<label class="control-label" for="lbl_tl_name">Team Leader Name:</label>
					<input type="text" id="tl_name" class="form-control" name="tl_name" placeholder="" value="{{ Input::old('tl_name') }}"/>
					@if ($errors->has('tl_name')) <p class="help-block">{{ $errors->first('tl_name') }} </p>@endif
				</div>
				<div class="form-group @if ($errors->has('tl_email')) has-error @endif">
					<label class="control-label" for="lbl_tl_email">Team Leader's e-mail:</label>
					<input type="text" id="tl_email" class="form-control" name="tl_email" placeholder="example@example.com" value="{{ Input::old('tl_email') }}"/>
					@if ($errors->has('tl_email')) <p class="help-block">{{ $errors->first('tl_email') }} </p>@endif
				</div>
				<div class="form-group @if ($errors->has('tl_cont')) has-error @endif">
					<label class="control-label" for="lbl_tl_cont">Team Leader's Contact Number:</label>
					<input type="text" id="tl_cont" class="form-control" name="tl_cont" value="{{ Input::old('tl_cont') }}"/>
					@if ($errors->has('tl_cont')) <p class="help-block">{{ $errors->first('tl_cont') }} </p>@endif
				</div>
				<div class="form-group @if ($errors->has('tm1_name')) has-error @endif">
					<label class="control-label" for="lbl_tm1_name">Team Member Name:</label>
					<input type="text" id="tm1_name" class="form-control" name="tm1_name" value="{{ Input::old('tm1_name') }}"/>
					@if ($errors->has('tm1_name')) <p class="help-block">{{ $errors->first('tm1_name') }} </p>@endif
				</div>
				<div class="form-group @if ($errors->has('tm2_name')) has-error @endif">
					<label class="control-label" for="lbl_tm2_name">Team Member Name:</label>
					<input type="text" id="tm2_name" class="form-control" name="tm2_name" value="{{ Input::old('tm2_name') }}"/>
					@if ($errors->has('tm2_name')) <p class="help-block">{{ $errors->first('tm2_name') }} </p>@endif
				</div>
				<div class="form-group @if ($errors->has('tm3_name')) has-error @endif">
					<label class="control-label" for="lbl_tm3_name">Team Member Name:</label>
					<input type="text" id="tm3_name" class="form-control" name="tm3_name" value="{{ Input::old('tm3_name') }}"/>
					@if ($errors->has('tm3_name')) <p class="help-block">{{ $errors->first('tm3_name') }} </p>@endif
				</div>
				<br/>
				{{ Form::submit('Register!' , array('class' => 'btn btn-primary', 'name' => 'loi_invite')) }}<br
				/><br/>
				{{ Form::close()}}
			</div>
		</div>
	</div>
</div>
@endif
@stop