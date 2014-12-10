@extends('layouts.master')
@section('styles')
@stop

@section('content')

<div class="panel panel-info">
	<div class="panel-heading">
		<h2 class="panel-title" align="center" >e-Yantra Ideas Competition</h2>
	</div>
	<div class="panel-body">
		<h3>Document for Mentors and Student Representative:</h3>
		<h4>What is eYIC ?</h4>
		eYIC stands for e-Yantra Ideas Competition, an initiative to encourage innovative projects from robotics labs set up through the e-Yantra Lab Setup Initiative (eLSI), in colleges across the country.
		<h4>What are the aims of eYIC ?</h4>
		<ul>
  			<li>To ensure sustained use of the robotics labs set up through the e-Yantra Lab Setup Initiative (eLSI).</li>
  			<li>To encourage <b>innovative ideas</b> from students in eLSI colleges across the country.</li>
  			<li>To provide a platform for teams to showcase their projects.</li>
			<li>To nurture BE projects in Embedded Systems and Robotics at the eLSI colleges.</li>
		</ul>
		e-Yantra Ideas Competition (eYIC- 2015) will be held as part of e-Yantra Symposium (eYS-2015).
		<h4>Mentor’s Role:</h4>
		<ul>
  			<li>Teams comprising of 3 or 4 students and one teacher designated a <b>Mentor</b> submit their project proposals to the <b>Coordinator</b> (A local faculty designated by the college) by an internal deadline defined by the Coordinator.</li>
			<ul>
  				<li>All the students from a team should be from the same year but can be from different branches.</li>
  				<li>One mentor can guide many projects but one student can be part of one project only.</li>
			</ul>
  			<li>Out of all the submitted project proposals, coordinator selects up to four projects from the field of <b>embedded systems and robotics. These projects have to be implemented using the components from the Embedded systems and Robotics lab set up in the college through the e-Yantra Lab Setup Initiative (eLSI).</b></li>
  			<li>Coordinator will select the best four project ideas from the proposals received from the teams and register the Mentors. Note that the Coordinator can nominate up to 4 Mentors (for the 4 selected projects) by registering their e-mail ids.</li>
			<li>Each nominated mentor will get a confirmation email of successful registration.</li>
			<li>Mentor will fill details of the project in brief and nominate one of the students from the team as <b>Student Representative</b> to coordinate with e-Yantra.</li>
		</ul>
		<h4>Student Representative’s Role:</h4>
		<ul>
  			<li>A student representative of a particular team is nominated by the mentor.</li>
  			<li>Student representative will then fill the details of each team member.</li>
  			<li>He/She will be co-ordinating between e-Yantra and the team.</li>
			<li>All competition details and future communications regarding the competition will be mailed to the student representative and the Mentor.</li>
		</ul>				
	</div>
</div>

@stop

@section('scripts')
<script type="text/javascript">
	$(document).ready( function() {
		$('#template').addClass('active');
	});
</script>
@stop
