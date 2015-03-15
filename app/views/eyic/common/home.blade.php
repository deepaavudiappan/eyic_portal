@extends('layouts.master')
@section('styles')
@stop

@section('content')

<div class="alert alert-danger">
	The option to upload Stage 2 Code will be made available from 11:59 AM 16th March till 11:59 PM 19th March
</div>
<div class="alert alert-danger">
	Stage 2 Content can be uploaded by the Student Representative by clicking on the <strong>"Stage 2"</strong> tab on the left side menu.
</div>
<div class="alert alert-info">
	You can now update your profile information by clicking on the "Update Profile" button at the bottom of this page.
</div>
<div class="alert alert-danger">
	<ul>
		@if($college->phase == '2012' || $college->phase == '2013')
		<li>Deadline for the coordinator to register the project: January 31st 2015</li>
		<li>Deadline for the project team to upload the project proposal as per the template: January 31st 2015</li>
		@else
		<li>Deadline for the coordinator to register the project: January 31st 2015</li>
		<li>Deadline for the project team to upload the project proposal as per the template: January 31st 2015</li>
		@endif
	</ul>
</div>

<div class="alert alert-danger">
	The project proposal template is now available under the tab <strong>"Project Proposal"</strong> on the left side menu.
</div>

@if($teacherDetail->coor_flag == 1 || $teacherDetail->coor_flag == 2)
<div class="alert alert-info">
	Dear Coordinator, welcome to e-Yantra Ideas Competition 2015 Portal.<br/><br/>
	<strong>Step 1:</strong> Please read the information under the tab <strong>"Coordinator Info"</strong> on the left side menu<br/>
	<strong>Step 2:</strong> After selecting up to 4 projects to represent your college, please register the projects by clicking on the <strong>"Register Project"</strong> tab on the left side menu<br/>
	<strong>Step 3:</strong> After registering the project, the mentor is contacted to complete the registration<br/>
	<br/>
	You can check the status of all the projects registered under your college at the <strong>"Register Project"</strong> tab on the left side menu.
</div>
@endif
@if($teacherDetail->eyic_flag == 1)
<div class="alert alert-danger">
	Please go to "Mentored projects" on the left side tab to complete your mentored project's registration by providing the details of the students associated to the project.
</div>
@endif
<table class="table table-striped">
	<tr>
		<th colspan="2">
			<h3><span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{ $teacherDetail->name }}</h3>
		</th>
	</tr>
	<tr>
		<td>COLLEGE NAME</td>
		<td><span class="glyphicon glyphicon-home" aria-hidden="true"></span> {{ $teacherDetail->college }}</td>		
	</tr>
	<tr>
		<td>E-MAIL ID</td>
		<td><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> {{ $teacherDetail->emailid }}</td>		
	</tr>
	<tr>
		<td>ALTERNATIVE E-MAIL ID 1</td>
		<td><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> {{ $teacherDetail->alt_email1 }}</td>		
	</tr>
	<tr>
		<td>ALTERNATIVE E-MAIL ID 2</td>
		<td><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> {{ $teacherDetail->alt_email2 }}</td>
	</tr>
	<tr>
		<td>CONTACT</td>
		<td><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> {{ $teacherDetail->contact_num }}</td>	
	</tr>
	<tr>
		<td>ALTERNATIVE CONTACT</td>
		<td><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> {{ $teacherDetail->alt_contact1 }}</td>	
	</tr>
	<tr>
		<td>DEPARTMENT</td>
		<td><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> {{ $teacherDetail->department }}</td>		
	</tr>
	<tr>
		<td>DESIGATION</td>
		<td><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span> {{ $teacherDetail->designation }}</td>
	</tr>
</table>
<div class="row text-center">
	<div class="col-md-2 col-md-offset-3">
		{{ HTML::linkRoute('changePwdLand', 'Change Password', [], ['class'	=> 'btn btn-primary']) }}
	</div>
	<div class="col-md-2 col-md-offset-1">
		<a href="javascript:void(0);" onclick="open_updt_modal();" class="btn btn-primary">Update Profile!</a>
	</div>
</div>

<div class="modal fade" id="updt_prfl" tabindex="-1" role="dialog" aria-labelledby="updt_prflLbl" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Update Profile</h4>
			</div>

			<div class="modal-body">
				<div class="alert alert-danger hidden" id="msg_box"></div>
				<table class="table table-striped">
					<tr>
						<td>Alternate Email 1:</td>
						<td><input type="text" id="alt_email1" name="alt_email1"/></td>
					</tr>
					<tr>
						<td>Alternate Email 2:</td>
						<td><input type="text" id="alt_email2" name="alt_email2"/></td>
					</tr>
					<tr>
						<td>Contact Number:</td>
						<td><input type="text" id="cnt_num" name="cnt_num"/></td>
					</tr>
					<tr>
						<td>Alternate Contact Number:</td>
						<td><input type="text" id="alt_cnt_num" name="alt_cnt_num"/></td>
					</tr>
					<tr>
						<td>Select Department:</td>
						<td><select id="department" name="department"></select></td>
					</tr>
					<tr>
						<td>Select Designation:</td>
						<td><select id="desig" name="desig"></select></td>
					</tr>
					<tr>
						<td>Select Gender:</td>
						<td><select id="gender" name="gender"><option value="-1">--Select--</option><option value="Male">Male</option><option value="Female">Female</option></select></td>
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onclick="sve_updte_info()">Update!</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
@stop

@section('notice')

<div class="panel panel-default">
	<div class="panel-heading">Notice 1</div>
	<div class="panel-body">
		Please put notice 1 here
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">Notice 2</div>
	<div class="panel-body">
		Please put notice 2 here
	</div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
	$(document).ready( function() {
		$('#profileLk').addClass('active');
	});

	function open_updt_modal(){

		$.ajax({
			type 	: "POST",
			url    	: "{{ URL::route('loadPrTeacher'); }}",
			dataType: 'json'
		}).done(function(data) {
			if(!data.error){
				//Success
				$('#department').append($('<option>').text("--Select--").attr('value', "-1"));
				$('#desig').append($('<option>').text("--Select--").attr('value', "-1"));
				for(var i = 0; i < data.depart.length; i++){
					$('#department').append($('<option>').text(data.depart[i].name).attr('value', data.depart[i].name));
				}

				for(var j = 0; j < data.desig.length; j++){
					$('#desig').append($('<option>').text(data.desig[j].name).attr('value', data.desig[j].name));
				}

				$('#alt_email1').val(data.profile[0].alt_email1);
				$('#alt_email2').val(data.profile[0].alt_email2);
				$('#cnt_num').val(data.profile[0].contact_num);
				$('#alt_cnt_num').val(data.profile[0].alt_contact1);
				if(data.profile[0].department)
					$('#department').val(data.profile[0].department);
				if(data.profile[0].designation)
					$('#desig').val(data.profile[0].designation);
				if(data.profile[0].gender)
					$('#gender').val(data.profile[0].gender);

				$('#updt_prfl').modal('show');
			}
			else{
				//Error
				alert(data.error);
			}
		}).fail(function(){
			alert("Unable to process the request.");
		});

		return true;
	}

	function sve_updte_info(){
		$.ajax({
			type 	: "POST",
			url    	: "{{ URL::route('savePrTeacher'); }}",
			data 	: { "alt_email1"	: 	$('#alt_email1').val(),
						"alt_email2"	: 	$('#alt_email2').val(),
						"alt_cnt_num"	: 	$('#alt_cnt_num').val(),
						"cnt_num"		: 	$('#cnt_num').val(),
						"department"	: 	$('#department').val(),
						"desig"			: 	$('#desig').val(),
						"gender"		: 	$('#gender').val()},
			dataType: 'json'
		}).done(function(data) {
			if(!data.error){
				$('#msg_box').addClass('hidden');
				alert("Successfully Updated!");
				location.reload();
			}
			else{
				//alert(data.error);
				$('#msg_box').html(data.error);
				$('#msg_box').removeClass('hidden');
			}
		}).fail(function(){
			//alert("Unable to process the request.");
			$('#msg_box').html("Unable to process the request.");
			$('#msg_box').removeClass('hidden');
		});
	}
</script>
@stop
