@extends('layouts.login-master')
@section('styles')
@stop

@section('content')
@if (!(Session::has('success')) )
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Workshop Confirmation</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				{{ Form::open(array('route' => 'clgConfirm', 'method' => 'POST')) }}
				
				<label style="250px">Please select your college:</label>
				{{ Form::select('clg_id', $clgs, [], ['class' => 'form-control'] );}}<br/><br/>

				Greetings from e-Yantra!<br/>
				<br/>
				We are happy to receive the Letter of Intent (LoI) from your institution.<br/>
				<br/>
				As the first step in engaging with your teacher team, we have automatically registered your team for the 2-day workshop on "Introduction to Robotics". Details of the workshop are given below:<br/>
				<br/>
				Date: <strong>February 6th and 7th, 2015</strong><br/>
				Venue: <strong>IIIT Bangalore<br/>
				<span style="margin-left:50px;">No. 26/C, Electronic City, Hosur Road</span><br/>
				<span style="margin-left:50px;">Bangalore - 560100</span><br/></strong>
				Coordinator: <strong>Ms. Roshni DSouza</strong><br/>
				Contact number: <strong>+91-80-4140-7777, +91-9986668421</strong><br/>
				E-mail: <strong>roshni.dsouza@iiitb.ac.in</strong><br/>
				<br/>
				Please confirm attendance of your team of four teachers on or before <strong>January 26th 2015</strong>:<br/>
				<br/>
				<div class="alert alert-danger">
					Please note:<br/>
					<br/>
					<ol>
						<li>Upon receiving your confirmation, we will send an invitation to your college.</li>

						<li>Each workshop has a maximum capacity of 15 teams (15 slots). We are blocking one of these slots for your team. We request you to let us know if you have any problem in attending the workshop through a mail to: <a href="mailto:support@e-yantra.org">support@e-yantra.org</a></li>

						<li>You may substitute teachers in your team till the workshop date. Each team member attending the workshop will register at the workshop. These 4 teachers will participate in the e-Yantra Robotics Teacher Competition (eYRTC). No substitution is possible after the workshop, during eYRTC.</li>
					</ol>
				</div>
				<br/>
				{{ Form::submit('Confirm!' , array('class' => 'btn btn-primary', 'name' => 'loi_invite')) }}<br
				/><br/>
				{{ Form::close()}}
			</div>
		</div>
	</div>
</div>
@endif
@stop