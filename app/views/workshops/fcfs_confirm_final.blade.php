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
			<div class="col-md-8 col-md-offset-2 text-justify">
				{{ Form::open(array('route' => 'clgConfirmFCFS', 'method' => 'POST')) }}
				
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
								9:00 AM to 10:00 AM Registration + Tea<br/>
								10:00 AM to 10:30 AM Inauguration -- Lighting of lamp; Overview of e-Yantra<br/>
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
								<strong>Hands on Session</strong><br/>
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
				e-Yantra is organizing a 2-day workshop on "Introduction to Robotics" for the colleges participating in the e-Yantra Lab setup Initiative (eLSI).<br/>
				<br/>
				To encourage more colleges from your region to participate in this Nation-building initiative, we welcome one team of 4 teachers from your college to participate in the workshop. Selection for participation is on a First Come First Serve (FCFS) basis to fill the capacity of 15 college teams.<br/>
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
				@elseif ($clgs->region == 'Kakinada')
				Date: <strong>2<sup>nd</sup> and 3<sup>rd</sup> March, 2015</strong>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="open_sch();">(Click here to view schedule)</a><br/>
				Venue: <strong>Kakinada Institute of Engineering and Technology (KIET), Yanam Road,<br/>
				<span style="margin-left:50px;">Korangi, Tallarevu Mandal, E.G. Dist. Pin: 533461</span></strong><br/>
				Coordinator: <strong>Prof. Ratna Raju Bonasu</strong><br/>
				Contact number: <strong>+91-9392078835, 9296956735</strong><br/>
				E-mail: <strong>ratna_rit@yahoo.co.in</strong><br/>
				<br/>
				Please confirm attendance of your team of four teachers on or before <strong>15th February, 2015</strong>:<br/>
				<br/>
				@elseif ($clgs->region == 'Sivakasi')
				Date: <strong>16<sup>th</sup> and 17<sup>th</sup> March, 2015</strong>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="open_sch();">(Click here to view schedule)</a><br/>
				Venue: <strong>Computing Facilities Lab, ECE Dept,<br/>
				<span style="margin-left:50px;">Mepco Schlenk Engg. College, Sivakasi</span></strong><br/>
				Coordinator: <strong>Prof. R. Shantha Selvakumari</strong><br/>
				Contact number: <strong>+91-94866-36774, 04562-235400</strong><br/>
				E-mail: <strong>rshantha@mepcoeng.ac.in</strong><br/>
				<br/>
				Please confirm attendance of your team of four teachers on or before <strong>12th March, 2015</strong>:<br/>
				<br/>
				@elseif ($clgs->region == 'Puducherry')
				Date: <strong>19<sup>th</sup> and 20<sup>th</sup> March, 2015</strong>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="open_sch();">(Click here to view schedule)</a><br/>
				Venue: <strong>Department of ECE, Pondicherry Engineering College</strong><br/>
				Coordinator: <strong>Prof. Sivaradje Gopalakrishnan</strong><br/>
				Contact number: <strong>+91-98940-88077</strong><br/>
				E-mail: <strong>shivaradje@pec.edu</strong><br/>
				<br/>
				Please confirm attendance of your team of four teachers on or before <strong>12th March, 2015</strong>:<br/>
				<br/>
				@elseif ($clgs->region == 'Indore')
				Date: <strong> April 17<sup>th</sup> and 18<sup>th</sup>, 2015 (Friday & Saturday)</strong>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="open_sch();">(Click here to view schedule)</a><br/>
				Venue: <strong> Indore Institute of Science and Technology<br/>
				<span style="margin-left:50px;">Rau - Pithampur Road, Opposite IIM, Indore – 453331 (M.P.)</strong><br/>
				Coordinator: <strong>Prof Keshav Patidart</strong><br/>
				Contact number: <strong>9926530687</strong><br/>
				E-mail: <strong>Keshav.patidar@indoreinstitute.com</strong><br/>
				<br/>
				Please confirm attendance of your team of four teachers on or before <strong>31st March, 2015</strong>:<br/>
				<br/>
				@elseif ($clgs->region == 'Mathura')
				Date: <strong> April 24<sup>th</sup> and 25<sup>th</sup>, 2015 (Friday & Saturday)</strong>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="open_sch();">(Click here to view schedule)</a><br/>
				Venue: <strong>G L Bajaj Group of Institutions, National Highway # 2, Mathura-Delhi Road,<br/>
				<span style="margin-left:50px;"> PO-Akbarpur, Mathura – 281406 (UP)</strong><br/>
				Coordinator: <strong>Dr Meenu Gupta</strong><br/>
				Contact number: <strong>9997018688</strong><br/>
				E-mail: <strong>dr.meenu2@gmail.com</strong><br/>
				<br/>
				Please confirm attendance of your team of four teachers on or before <strong>10th April, 2015</strong>:<br/>
				<br/>
				@endif
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
				<div class="alert alert-info">Please fill in the details to register your team of four teachers on or before <strong>@if($clgs->region == 'Bangalore')January 26th 2015 @elseif ($clgs->region == 'Bhopal') February 3rd @endif</strong>. Please make sure that <strong>if selected</strong>, all the members of your team will attend the workshop.</div><br/>
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
				<div class="row">
					<div class="col-md-12 text-center">
						{{ Form::submit('Register!' , array('class' => 'btn btn-primary', 'name' => 'loi_invite')) }}
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