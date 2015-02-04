@extends('layouts.login-master')
@section('styles')
@stop

@section('content')
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Workshop Schedule</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-justify">
				<strong>Day 1:</strong><br/>
				9:00 AM to 10:00 AM Registration + Tea
				<br/><br/>
				10:00 AM to 10:30 AM Inauguration -- Lighting of lamp; Overview of e-Yantra
				<br/><br/>
				10:30 AM to 11:00 AM Introduction to Fire Bird V robot<br/>
				11:00 AM to 01:00 PM Introduction to AVR Micro-controller and Programming environment<br/>
				01:00 PM to 02:00 PM Lunch Break
				<br/><br/>
				<strong>Hands on Session</strong><br/>
				02:00 PM to 03:00 PM Motion control using I/O ports<br/>
				03:00 PM to 04:00 PM Robot velocity control using pulse width modulation<br/>
				04:00 PM to 04:15 PM Tea break<br/>
				04:15 PM to 05:30 PM *Interrupt programming<br/>
				*Closed loop position control of robot using position encoders
				<br/>
				<br/>
				<strong>Day 2: </strong><br/>
				Hands on Session<br/>
				10:00 AM to10:45 AM	Introduction to LCD interfacing<br/>
				10:45 AM to11:30 AM	Display of Data Array of eight elements on LCD <br/>
				11:30 AM to 11:45 AM Tea Break<br/>
				11:45 AM to 01:00 PM *Analog sensor interfacing using Analog to Digital conversion<br/>
				*Interfacing with white line sensors<br/>
				*Interfacing with Infrared range finder sensor<br/>
				01:00 PM to 02:00 PM Lunch Break <br/>
				02:00 PM to 02:45 PM Robot programming for white line following<br/>
				02:45 PM to 03:30 PM Adaptive cruise control (Robots try to maintain safe distance using analog IR range finder while following white line)<br/>
				03:30 PM to 03:45 PM Tea break<br/>
				03:45 PM to 04:15 PM Adaptive cruise control (continued)<br/>
				<br/>
				<br/>
				<strong>Feedback Session</strong><br/>
				04:15 PM to 05:00 PM Quiz and feedback<br/>
				05:00 PM to 05.30 PM Concluding session<br/>
				<br/>
				<strong>Please note: Schedule subject to change depending on the material we cover.</strong><br/>
			</div>
		</div>
	</div>
</div>
@stop