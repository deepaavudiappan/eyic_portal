@extends('layouts.master')
@section('styles')
@stop

@section('content')
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">College Status</h3>
	</div>
	<div class="panel-body">
		{{ HTML::linkRoute('adminHome', 'back to home', [], array('class'	=>	'btn btn-primary', 'role' => 'button')); }}<br/><br/>

		{{ Form::open(array('route' => 'snd_rqs_loiclg', 'method' => 'POST')) }}
		{{ Form::select('regions', $regions,[], ['id' => 'regions','class' => 'form-control'] );}}<br/><br/>
		{{ Form::close()}}
		<hr/>
		<p id="title"></p>		
		<div id="here_table"></div>
	</div>
</div>
@stop

@section('scripts')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="{{ URL::asset('js/jquery.sortElements.js') }}"></script>
<script type="text/javascript">
	$(document).ready( function() {
		$('#template').addClass('active');
	});
	
	$("#regions").on('change', function() {	  	  
	  	$.ajax({
            	type: "GET",
            	url: "{{URL::route('get_clg_list');}}",
                data: {"region"	: 	$('#regions').val()},
                contentType: "json; charset=utf-8",
                dataType: "json",
                success: function (data) {
						$( "#here_table" ).empty();
                 		
                 		$("#title").text('Region::'+$('#regions').val()).addClass('alert alert-info text-center');
                 		var table = $('<table></table>').addClass('table table-striped table-bordered');
                 		var thead = '<thead>'+
									    '<tr class="text-center">'+
										    '<th id="srid">'+'#'+'</th>'+
										    '<th id="clg_name">'+'College Name'+'</th>'+
										    '<th id="loi_header">'+'LOI'+'</th>'+
										    '<th id="wscnf_header">'+'WS CNF'+'</th>'+
									    '</tr>'+
									'</thead>';
						table.append(thead);
						for(var i = 0; i < data.clg_dtls.length; i++){					    	
								var row = $('<tr></tr>');
						    		var cell = $('<td></td>').text(i+1);
						    		row.append(cell);
						    						    		
						    		var cell2 = $('<td></td>').text(data.clg_dtls[i].college_name);
						    		row.append(cell2);
						    		
						    		if(data.clg_dtls[i].LOI == 1)
						    			var cell3 = $('<td></td>').text(data.clg_dtls[i].LOI).addClass('text-success');
						    		else if(data.clg_dtls[i].LOI == 0)
						    			var cell3 = $('<td></td>').text(data.clg_dtls[i].LOI).addClass('text-danger');;	
						    		
						    		row.append(cell3);
						    		
							    	var cell4 = $('<td></td>').text(data.clg_dtls[i].workshop_cnfrm);
							    	row.append(cell4);
						    	
						    	table.append(row);
						}
						
						$('#here_table').append(table);
						
						var table = $('table');
    
					    $('#loi_header, #wscnf_header, #clg_name, #srid')
					        .wrapInner('<span title="sort this column"/>')
					        .each(function(){
					            
					            var th = $(this),
					                thIndex = th.index(),
					                inverse = false;
					            
					            th.click(function(){
					                
					                table.find('td').filter(function(){					                    
					                    return $(this).index() === thIndex;					                    
					                }).sortElements(function(a, b){					                    
					                    a = $(a).text();
				                        b = $(b).text();				                        
				                        return (
				                            isNaN(a) || isNaN(b) ?
				                                a > b : +a > +b
				                            ) ?
				                                inverse ? -1 : 1 :
				                                inverse ? 1 : -1;
				                      }, function(){
					                  // parentNode is the element we want to move
					                  	return this.parentNode; 
					                  });
					                  inverse = !inverse;
					             });
					        });						               		
                }//end of data success
       		});	  
  	});	
</script>
@stop