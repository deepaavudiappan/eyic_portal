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
		<div class="alert alert-danger">
			Only the Student Representative can upload the Stage 2 - Implementation. The upload feature will be available soon.
		</div>
		<p>In Stage 2, the project team is required to implement the project proposal and create a working demonstration. You are required to upload the following:</p>
		<ol>
			<li>A video demonstrating the implemented solution to your proposed idea: You must upload your video demonstration on YouTube and the link must be submitted. For instructions on how to upload the video on YouTube, please <a href="#" onclick="displayInst()" class="btn btn-primary">click here</a>.</li>
			<li>Documented code for your implemented solution: A sample Coding Standard has been provided under the <strong>“Coding Standard”</strong> menu on the left side bar and should be used to document your project code.</li>
			<li>Updated project proposal (if during implementation, you have made changes) in the form of a Change Log: To download a template for creating the Change Log, please {{HTML::linkRoute('changeLog', 'click here', [], array('class' => 'btn btn-primary'))}}</li>
		</ol>
		<br/>
		<p>A maximum number of 15 teams selected from Stage 2 – Implementation will be invited to demonstrate their project at e-Yantra Symposium.</p>
		<br/>
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Reimbursement of travel expenses</h3>
			</div>
			<div class="panel-body">
				<ul>
					<li>STUDENT Members of the teams selected for demonstration at e-Yantra Symposium will be reimbursed second-class sleeper railway fare from the railway station nearest to their residence to Mumbai and back;</li>
					<li>Local travel from the nearest railway station from home to local railway station and from Mumbai railway station to IIT Bombay will also be reimbursed. Please note that only auto fare from the nearest railway station to and from IIT-Bombay will be reimbursed.</li>
					<li>TEACHER Team Member accompanying the team selected for demonstration at e-Yantra Symposium will be reimbursed a maximum limit of 2nd class AC 2-Tier fare to and fro from the Railway station closest to place of residence to Mumbai will be reimbursed.</li>
				</ul>
				<br>
				<p>ALL Team members will be reimbursed the travel costs on producing proof of travel i.e. train tickets or receipt of bus/auto.</p>
			</div>
		</div>
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
<div class="modal fade text-justify" id="taskVCLinkMdl" tabindex="-1" role="dialog" aria-labelledby="task2LinkLbl" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close ytStop" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Instructions for Creating Video</h4><br/>
			</div>

			<div class="modal-body">
				<strong>Note: Please ensure that the video uploaded is of good quality and conforms to the instructions given below.</strong>
				<ol>
					<li>The video should be a <strong>one-shot continuous video</strong>. It should <strong>not be edited</strong> in any manner. Teams uploading an edited video will be disqualified from the competition. e-Yantra reserves the rights to disqualify any team if foul play is suspected.</li>
					<li>The resolution of the video should be good enough for judging. You have to use a <strong>3.2 MP camera or higher</strong> to shoot the video.</li>
					<li>The videos should be in one of the following formats:  .avi, .mp4</li>
					<li><strong>Upload the video on YouTube</strong> with the title: <strong>eYIC-{Your Project Name}</strong> (For example: If your project name is "e-Yantra Project" then, save it as <strong>eYIC-e-Yantra Project</strong>)</li>
					<li>Please note that while uploading the video on YouTube select the privacy setting option as <strong>Unlisted</strong>. Refer the <strong>figure below</strong>
						<br/><br/>{{ HTML::image('img/video_int.png', 'Video Instructions', array('style' => 'max-height:100%;max-width:100%;')) }}</li><br/>
						<li>You need to submit the video link on the <strong>“Stage 2”</strong> tab of the portal on the left side bar.</li>
					</ol>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default ytStop" data-dismiss="modal">Close</button>

				</div>
			</div>
		</div>
	</div>
	@stop

	@section('scripts')
	<script type="text/javascript">
		$(document).ready( function() {
			$('#stage2').addClass('active');
		});
	</script>
	@stop
