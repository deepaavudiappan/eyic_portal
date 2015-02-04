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
				<table class="table table-striped">
					<tr colspan="2"><strong>Day 1:</strong></tr>
					<tr><td>9:00 AM to 10:00 AM</td><td>Registration + Tea</td></tr>
					<tr><td>10:00 AM to 10:30 AM</td><td> Inauguration -- Lighting of lamp; Overview of e-Yantra</td></tr>
					<tr><td>10:30 AM to 11:00</td><td>AM Introduction to Fire Bird V robot</td></tr>
					<tr><td>11:00 AM to 01:00 PM</td><td>Introduction to AVR Micro-controller and Programming environment</td></tr>
					<tr><td>01:00 PM to 02:00 PM</td><td>Lunch Break</td></tr>
					<tr></tr>
					<tr colspan="2"><td><strong>Hands on Session</strong></td></tr>
					<tr><td>02:00 PM to 03:00 PM</td><td>Motion control using I/O ports</td></tr>
					<tr><td>03:00 PM to 04:00 PM</td><td>Robot velocity control using pulse width modulation</td></tr>
					<tr><td>04:00 PM to 04:15 PM</td><td>Tea break</td></tr>
					<tr><td>04:15 PM to 05:30 PM</td><td>*Interrupt programming</td></tr>
					<tr><td></td><td>*Closed loop position control of robot using position encoders</td></tr>
					<tr></tr><tr></tr>
					<tr colspan="2"><td><strong>Day 2: </strong></td></tr>
					<tr colspan="2"><td>Hands on Session</td></tr>
					<tr><td>10:00 AM to10:45 AM</td><td>Introduction to LCD interfacing</td></tr>
					<tr><td>10:45 AM to 11:30 AM</td><td>Display of Data Array of eight elements on LCD</td></tr>
					<tr><td>11:30 AM to 11:45 AM</td><td>Tea Break</td></tr>
					<tr><td>11:45 AM to 01:00 PM</td><td>*Analog sensor interfacing using Analog to Digital conversion</td></tr>
					<tr colspan="2"><td>*Interfacing with white line sensors</td></tr>
					<tr colspan="2"><td>*Interfacing with Infrared range finder sensor</td></tr>
					<tr><td>01:00 PM to 02:00 PM</td><td>Lunch Break</td></tr>
					<tr><td>02:00 PM to 02:45 PM</td><td>Robot programming for white line following</td></tr>
					<tr><td>02:45 PM to 03:30 PM</td><td>Adaptive cruise control (Robots try to maintain safe distance using analog IR range finder while following white line)</td></tr>
					<tr><td>03:30 PM to 03:45 PM</td><td>Tea break</td></tr>
					<tr><td>03:45 PM to 04:15 PM</td><td>Adaptive cruise control (continued)</td></tr>
					<tr></tr>
					<tr colspan="2"><td><strong>Feedback Session</strong></td></tr>
					<tr><td>04:15 PM to 05:00 PM</td><td>Quiz and feedback</td></tr>
					<tr><td>05:00 PM to 05.30 PM</td><td>Concluding session</td></tr>
					<tr></tr>
					<tr colspan="2"><td><strong>Please note: Schedule subject to change depending on the material we cover.</strong></td></tr>
				</table>
			</div>
		</div>
	</div>
</div>
@stop