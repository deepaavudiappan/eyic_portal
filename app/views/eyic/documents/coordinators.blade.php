@extends('layouts.master')
@section('styles')
@stop

@section('content')

<div class="panel panel-info">
	<div class="panel-heading">
		<h2 class="panel-title" align="center" >e-Yantra Ideas Competition</h2>
	</div>
	<div class="panel-body">
		<h3>Document for Coordinators:</h3>
		<h3>What is eYIC ?</h3>
		<p>eYIC stands for e-Yantra Ideas Competition, an initiative to encourage innovative projects from robotics labs set up through the e-Yantra Lab Setup Initiative (eLSI), in colleges across the country.</p>
		<h3>What are the aims of eYIC ?</h3>
		<ul>
  			<li>To ensure sustained use of the robotics labs set up through the e-Yantra Lab Setup Initiative (eLSI).</li>
  			<li>To encourage <b>innovative ideas</b> from students in eLSI colleges across the country.</li>
  			<li>To provide a platform for teams to showcase their projects.</li>
			<li>To nurture BE projects in Embedded Systems and Robotics at the eLSI colleges.</li>
		</ul>
		<p>e-Yantra Ideas Competition (eYIC- 2015) will be held as part of e-Yantra Symposium (eYS-2015).</p>
		<h3>Role of a Coordinator:</h3>
		<ul>
  			<li><b>As the first step, e-Yantra sends an e-mail to the colleges to nominate two Coordinators</b> (Local faculty designated by the college), one as a primary coordinator and other as secondary coordinator.</li>
  			<li>The coordinators will be sent an introductory email with their credentials to access the eYIC portal.</li>
  			<li>e-Yantra will send posters and details of the competition. Coordinators fill in the details in the poster and publicize the competition; Posters are distributed to various departments for displaying in the departmental notice boards.</li>
			<li>Teams of 3 or 4 student members mentored by one teacher submit their project proposals to the coordinator.</li>
			<ul>
				<li>All the students from a team should be from the same year but can be from different branches.</li>
				<li>One mentor can guide many projects but one student can be part of one project only.</li>
			</ul>
			<li>Out of all the submitted project proposals, coordinator selects up to four projects from the field of <b>embedded systems and robotics. These projects have to be implemented using the components from the Embedded systems and Robotics lab set up in the college through the e-Yantra Lab Setup Initiative (eLSI).</b></li>
			<ul>
				<li>This selection is an internal process; It is the responsibility of the college (coordinators) to select up to 4 projects.</li>
				<li>e-Yantra will provide a template and evaluation matrix which will be used by e-Yantra for evaluating the submitted project proposals. Coordinators may use these for their internal evaluation.</li>
			</ul>
			<li>Coordinators may take help of other faculty to evaluate ideas.</li>
			<ul>
				<li>Idea should be original and not be taken from anywhere.</li>
			</ul>
			<li>After selecting the projects, coordinator fills <b>Project Name</b> and the <b>Mentor’s e-mail Id</b> for each selected project (up to a maximum of four projects) by logging on to the portal.</li>
		</ul>
		<h3>eYIC Portal Link : <a href="http://elsiportal.e-yantra.org/addCoor">http://elsiportal.e-yantra.org/addCoor</a></h3>				
	</div>
</div>

@stop

@section('scripts')
<script type="text/javascript">
	$(document).ready( function() {
		$('#coorDocLk').addClass('active');
	});
</script>
@stop
