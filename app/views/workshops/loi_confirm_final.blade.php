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
			<div class="col-md-8 col-md-offset-2 text-justify">
				{{ Form::open(array('route' => 'clgConfirm', 'method' => 'POST')) }}
				
				<label>College Name: {{ $clgs->college_name;}}</label>
				<input id = "clg_id" name = "clg_id" type = "hidden" value = "{{$clgs->id;}}"/><br/><br/>
				<div class="modal fade" id="sch" tabindex="-1" role="dialog" aria-labelledby="task1UpldLbl" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close ytStop" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title" id="task1UpldLblH">Workshop Schedule</h4>
							</div>

							<div class="modal-body">
								<strong>Day 1:</strong><br/>
								9:00 AM to 10:00 AM Registration + Tea
								<br/><br/>
								10:00 AM to 10:30 AM Inauguration -- Lighting of lamp; Overview of e-Yantra
								<br/><br/>
								10:30 AM to 11:00 AM Introduction to Fire Bird V robot<br/>
								11:00 AM to 01:00 PM	Introduction to AVR Micro-controller and Programming environment<br/>
								01:00 PM to 02:00 PM	Lunch Break
								<br/><br/>
								<strong>Hands on Session</strong><br/>
								02:00 PM to 03:00 PM	Motion control using I/O ports<br/>
								03:00 PM to 04:00 PM   	Robot velocity control using pulse width modulation<br/>
								04:00 PM to 04:15 PM	Tea break<br/>
								04:15 PM to 05:30 PM	*Interrupt programming<br/>
								*Closed loop position control of robot using position encoders
								<br/>
								<br/>
								<strong>Day 2: </strong><br/>
								Hands on Session<br/>
								10:00 AM to10:45 AM	Introduction to LCD interfacing<br/>
								10:45 AM to11:30 AM	Display of Data Array of eight elements on LCD <br/>
								11:30 AM to 11:45 AM	Tea Break<br/>
								11:45 AM to 01:00 PM	*Analog sensor interfacing using Analog to Digital conversion<br/>
								*Interfacing with white line sensors<br/>
								*Interfacing with Infrared range finder sensor<br/>
								01:00 PM to 02:00 PM	Lunch Break <br/>
								02:00 PM to 02:45 PM	Robot programming for white line following<br/>
								02:45 PM to 03:30 PM	Adaptive cruise control (Robots try to maintain safe distance using analog IR range finder while following white line)<br/>
								03:30 PM to 03:45 PM	Tea break<br/>
								03:45 PM to 04:15 PM	Adaptive cruise control (continued)<br/>
								<br/>
								<br/>
								<strong>Feedback Session</strong><br/>
								04:15 PM to 05:00 PM	Quiz and feedback<br/>
								05:00 PM to 05.30 PM	Concluding session<br/>
								<br/>
								<strong>Please note: Schedule subject to change depending on the material we cover.</strong><br/>
							</div>
							<div class="modal-footer"> 
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
				Greetings from e-Yantra!<br/>
				<br/>
				We are happy to receive the Letter of Intent (LoI) from your institution.<br/>
				<br/>
				As the first step in engaging with your teacher team, we have automatically registered your team for the 2-day workshop on "Introduction to Robotics". Details of the workshop are given below:<br/>
				<br/>

				@if($clgs->region == 'Bangalore')
				Date: <strong>February 6th and 7th, 2015</strong>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="open_sch();">(Click here to view schedule)</a><br/>
				Venue: <strong>IIIT Bangalore<br/>
				<span style="margin-left:50px;">No. 26/C, Electronic City, Hosur Road</span><br/>
				<span style="margin-left:50px;">Bangalore - 560100</span><br/></strong>
				Coordinator: <strong>Ms. Roshni DSouza</strong><br/>
				Contact number: <strong>+91-80-4140-7777, +91-9986668421</strong><br/>
				E-mail: <strong>roshni.dsouza@iiitb.ac.in</strong><br/>
				<br/>
				Please confirm attendance of your team of four teachers on or before <strong>January 26th 2015</strong>:<br/>
				<br/>
				@elseif ($clgs->region == 'Bhopal')
				Date: <strong>February 13th and 14th, 2015</strong>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="open_sch();">(Click here to view schedule)</a><br/>
				Venue: <strong>NRI Institute of Information Science & Technology,<br/>
				<span style="margin-left:50px;">1, Sajjan Singh Nagar, Opposite Patel Nagar,</span><br/>
				<span style="margin-left:50px;">Raisen Road, Bhopal, Madhya Pradesh 462023</span><br/></strong>
				Coordinator: <strong>Dr. Amita Mahor</strong><br/>
				Contact number: <strong>0755-2684058, +91-94250-19572</strong><br/>
				E-mail: <strong>mitu2008mahor@gmail.com</strong><br/>
				<br/>
				Please confirm attendance of your team of four teachers on or before <strong>February 3rd 2015</strong>:<br/>
				<br/>
				@elseif ($clgs->region == 'Gujarat')
				Date: <strong>20<sup>th</sup> and 21<sup>st</sup> February, 2015</strong>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="open_sch();">(Click here to view schedule)</a><br/>
				Venue: <strong>Seminar Hall, First Floor,<br/>
				<span style="margin-left:50px;">Institute of Infrastructure, Technology, Research and Management (IITRAM)</span><br/>
				<span style="margin-left:50px;">Khokhra Circle, Maninagar (East), Ahmedabad -380026</span><br/></strong>
				Coordinator: <strong>Dr. Ketan P Badgujar</strong><br/>
				Contact number: <strong>079-67775408, 8153941900</strong><br/>
				E-mail: <strong>ketan@iitram.ac.in</strong><br/>
				<br/>
				Please confirm attendance of your team of four teachers on or before <strong>5th February, 2015</strong>:<br/>
				<br/>
				@elseif ($clgs->region == 'Punjab')
				Date: <strong>20<sup>th</sup> and 21<sup>st</sup> February, 2015</strong>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="open_sch();">(Click here to view schedule)</a><br/>
				Venue: <strong>Thapar University Patiala,<br/>
				<span style="margin-left:50px;">P.O Box 32, Patiala, Pin -147004</span></strong><br/>
				Coordinator: <strong>Dr. Sanjay Sharma</strong><br/>
				Contact number: <strong>0175-2393083/2393136, 07696400690</strong><br/>
				E-mail: <strong>sanjay.sharma@thapar.edu</strong><br/>
				<br/>
				Please confirm attendance of your team of four teachers on or before <strong>7th February, 2015</strong>:<br/>
				<br/>
				@elseif ($clgs->region == 'Guntur')
				Date: <strong>26<sup>th</sup> and 27<sup>th</sup> February, 2015</strong>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="open_sch();">(Click here to view schedule)</a><br/>
				Venue: <strong>Vignan University, Vadlamudi, Guntur - 522213, A.P.</strong><br/>
				Coordinator: <strong>S. Krishna Chaitanya</strong><br/>
				Contact number: <strong>0863- 234 4700, +91-9440485456</strong><br/>
				E-mail: <strong>chaitanyabright@gmail.com</strong><br/>
				<br/>
				Please confirm attendance of your team of four teachers on or before <strong>12th February, 2015</strong>:<br/>
				<br/>
				@endif
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
				<div class="row">
					<div class="col-md-12 text-center">
						{{ Form::submit('Confirm!' , array('class' => 'btn btn-primary', 'name' => 'loi_invite')) }}
					</div>
				</div>
				{{ Form::close()}}
			</div>
		</div>
	</div>
</div>
@endif
@stop
@section('scripts')
<script type="text/javascript">
	function open_sch(){
		$('#sch').modal('show');
		return true;
	}
</script>
@stop