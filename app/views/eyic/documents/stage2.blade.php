@extends('layouts.master')
@section('styles')
@stop

@section('content')

<div class="panel panel-info">
	<div class="panel-heading">
		<h2 class="panel-title text-center">Stage 2 - Implementation</h2>
	</div>
	<div class="panel-body text-justify">
		<div class="alert alert-danger">
			The last date to submit Stage 2 - Implementation is: Midnight, March 15th, 2015
		</div>
		<p>In Stage 2, the project team is required to implement the project proposal and create a working demonstration. You are required to upload the following:</p>
		<ol>
			<li>A video demonstrating the implemented solution to your proposed idea: You must upload your video demonstration on YouTube and the link must be submitted. For instructions on how to upload the video on YouTube, please click here.</li>
			<li>Documented code for your implemented solution: A sample Coding Standard has been provided under the “Coding Standard” menu on the left side bar and should be used to document your project code.</li>
			<li>Updated project proposal (if during implementation, you have made changes) in the form of a Change Log: For instructions for creating the Change Log, please click here.</li>
		</ol>
		<br/><br/>
		<p>A maximum number of 15 teams selected from Stage 2 – Implementation will be invited to demonstrate their project at e-Yantra Symposium.</p>
		<br/><br/>
		<p>Reimbursement of travel expenses:</p>
		<ul>
			<li>STUDENT Members of the teams selected for demonstration at e-Yantra Symposium will be reimbursed second-class sleeper railway fare from the railway station nearest to their residence to Mumbai and back;</li>
			<li>Local travel from the nearest railway station from home to local railway station and from Mumbai railway station to IIT Bombay will also be reimbursed. Please note that only auto fare from the nearest railway station to and from IIT-Bombay will be reimbursed.</li>
			<li>TEACHER Team Member accompanying the team selected for demonstration at e-Yantra Symposium will be reimbursed a maximum limit of 2nd class AC 2-Tier fare to and fro from the Railway station closest to place of residence to Mumbai will be reimbursed.</li>
		</ul>
		<br>
		<p>ALL Team members will be reimbursed the travel costs on producing proof of travel i.e. train tickets or receipt of bus/auto.</p>
		<br/>
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Accommodation</h3>
			</div>
			<div class="panel-body">
			<p>Accommodation will be provided to the selected project teams on sharing basis.<br/><br/>
			Please note that STUDENT team members ONLY after verification will be allowed to stay in the hostel.<br/><br/>
			Please note that Mumbai-based teams will not be provided Hostel Accommodation.
			</p>
			</div>
		</div>
		<br/>
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Honorarium</h3>
			</div>
			<div class="panel-body">
			<p>An honorarium of Rs 2,000/- to each team member of the selected teams will be given.</p>
			</div>
		</div>
		<br/>
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Prizes</h3>
			</div>
			<div class="panel-body">
			<p>Attractive Cash Prizes - 3 best projects will be considered for the prize</p>
			</div>
		</div>
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
