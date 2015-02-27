@extends('layouts.master')
@section('styles')
@stop

@section('content')
@if($project->project_status == 3)
<div class="alert alert-success">
	Congratulations! Your project has been selected for Stage 2 - Implementation. For details regarding Stage 2, please visit “Stage 2” tab on the left side menu.
</div>
@elseif($project->project_status == 4)
<div class="alert alert-danger">
	We regret to inform you that your project was not selected for Stage 2 – Implementation. We received a lot of good project proposals but could not select all of them owing to our capacity constraints. We look forward to continued interactions with you in the future.
</div>
@elseif($project->project_status == 5)
<div class="alert alert-danger">
	We regret to inform you that your project was not selected for Stage 2 – Implementation since the project registration was not completed
</div>
@endif
<div class="alert alert-info">
	*Update Please update your name too*  You can now update your profile information by clicking on the "Update Profile" button at the bottom of this page.
</div>
<div class="alert alert-danger">
	Project Proposal can now be uploaded by the Student Representative by clicking on the "Project Proposal" tab on the left side bar.
</div>
<table class="table table-striped">
	<tr>
		<th colspan="2">
			<h3><span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{ $studentDetail->name }}</h3>
		</th>
	</tr>
	<tr>
		<td>College Name</td>
		<td><span class="glyphicon glyphicon-home" aria-hidden="true"></span> {{ $studentDetail->college }}</td>		
	</tr>
	<tr>
		<td>Name</td>
		<td><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> {{ $studentDetail->name }}</td>		
	</tr>
	<tr>
		<td>Email ID</td>
		<td><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> {{ $studentDetail->email_id }}</td>		
	</tr>
	<tr>
		<td>Contact</td>
		<td><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> {{ $studentDetail->contact_num }}</td>		
	</tr>
	<tr>
		<td>Address</td>
		<td><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> {{ $studentDetail->address }}</td>		
	</tr>
	<tr>
		<td>Branch</td>
		<td><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> {{ $studentDetail->branch }}</td>		
	</tr>	
	<tr>
		<td>Year</td>
		<td><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> {{ $studentDetail->year }}</td>		
	</tr>
	<tr>
		<td>Degree</td>
		<td><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> {{ $studentDetail->degree }}</td>		
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
				<div class="alert alert-danger hidden" id="msg_box"></div><table class="table table-striped">
					<tr>
						<td>Name:</td>
						<td><input type="text" id="name" name="name"/></td>
					</tr>
					<tr>
						<td>Contact Number:</td>
						<td><input type="text" id="contact_num" name="contact_num"/></td>
					</tr>
					<tr>
						<td>Address:</td>
						<td><input type="text" id="address" name="address"/></td>
					</tr>
					<tr>
						<td>Gender:</td>
						<td><select id="gender" name="gender"><option value="-1">--Select--</option><option value="Male">Male</option><option value="Female">Female</option></select></td>
					</tr>
					<tr>
						<td>Qualifying Degree:</td>
						<td><select id="degree" name="degree"><option value="-1">--Select--</option><option value="BCA">BCA</option><option value="B.E.">B.E.</option><option value="B.Tech">B.Tech</option><option value="B.Sc">B.Sc</option><option value="Diploma">Diploma</option><option value="MCA">MCA</option><option value="M.E.">M.E.</option><option value="M.Tech">M.Tech</option><option value="M.Sc">M.Sc</option></select></td>
					</tr>
					<tr>
						<td>Branch:</td>
						<td><select id="branch" name="branch"></select></td>
					</tr>
					<tr>
						<td>Current Degree Year:</td>
						<td><select id="year" name="year"><option value="-1">--Select--</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></td>
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
			url    	: "{{ URL::route('loadPrStudent'); }}",
			dataType: 'json'
		}).done(function(data) {
			if(!data.error){
				//Success
				$('#branch').append($('<option>').text("--Select--").attr('value', "-1"));
				for(var i = 0; i < data.depart.length; i++){
					$('#branch').append($('<option>').text(data.depart[i].name).attr('value', data.depart[i].name));
				}

				$('#name').val(data.profile[0].name);
				$('#contact_num').val(data.profile[0].contact_num);
				$('#address').val(data.profile[0].address);

				if(data.profile[0].branch)
					$('#branch').val(data.profile[0].branch);

				if(data.profile[0].year)
					$('#year').val(data.profile[0].year);
				
				if(data.profile[0].gender)
					$('#gender').val(data.profile[0].gender);

				if(data.profile[0].degree)
					$('#degree').val(data.profile[0].degree);

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
			url    	: "{{ URL::route('savePrStudent'); }}",
			data 	: { "name"			: 	$('#name').val(),
						"contact_num"	: 	$('#contact_num').val(),
						"address"		: 	$('#address').val(),
						"branch"		: 	$('#branch').val(),
						"year"			: 	$('#year').val(),
						"degree"		: 	$('#degree').val(),
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