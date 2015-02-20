@extends('layouts.master')
@section('styles')
@stop

@section('content')
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Send Lab Setup equipment list -> LOI Colleges</h3>
	</div>
	<div class="panel-body">
		{{ HTML::linkRoute('adminHome', 'back to home', [], array('class'	=>	'btn btn-primary', 'role' => 'button')); }}<br/><br/>

		{{ Form::open(array('route' => 'snd_rqs_loiclg', 'method' => 'POST')) }}
		{{ Form::select('regions', $regions,[], ['id' => 'regions','class' => 'form-control'] );}}<br/><br/>
		<label style="width:250px;">From e-mail ID:</label><input type="text" name="from_email" />
		<br/><br/>
		<div class="row">
			<div class="col-md-6">
				{{ Form::submit('Send equipment list->LOI Colleges' , array('class' => 'btn btn-primary', 'name' => 'rqs_loiclg')) }}<br/><br/>				
			</div>			
		</div>
		{{ Form::close()}}
		
		<hr/>
		<p id="title"></p>
		<div id="here_table"></div>
	</div>
</div>
@stop

@section('scripts')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready( function() {
		$('#template').addClass('active');
	});
	
	$("#regions").on('change', function() {	  	  
	  	$.ajax({
            	type: "GET",
            	url: "{{URL::route('testAjax');}}",
                data: {"region"	: 	$('#regions').val()},
                contentType: "json; charset=utf-8",
                dataType: "json",
                success: function (data) {
						$( "#here_table" ).empty();
                 		
                 		$("#title").text('Region::'+$('#regions').val()).addClass('alert alert-info text-center');
                 		var table = $('<table></table>').addClass('table table-striped table-bordered');
                 		var thead = '<thead>'+
									    '<tr>'+
										    '<td>'+'#'+'</td>'+
										    '<td>'+'College Name'+'</td>'+
										    '<td>'+'LOI'+'</td>'+
										    '<td>'+'WS CNF'+'</td>'+
									    '</tr>'+
									'</thead>';
						table.append(thead);
						for(var i = 0; i < data.clg_dtls.length; i++){					    	
															    	
						    	var row = $('<tr></tr>');
						    	var cell = $('<td></td>').text(i+1);
						    	row.append(cell);
						    	var cell2 = $('<td></td>').text(data.clg_dtls[i].college_name);
						    	row.append(cell2);
						    	var cell3 = $('<td></td>').text(data.clg_dtls[i].LOI);
						    	row.append(cell3);
						    	var cell4 = $('<td></td>').text(data.clg_dtls[i].workshop_cnfrm);
						    	row.append(cell4);
						    	
						    	table.append(row);
						}
						
						$('#here_table').append(table);						               		
                 		                		                        
              	}
       		});	  
  	});
</script>
@stop