@extends('layouts.master')
@section('styles')
@stop

@section('content')

<div class="panel panel-info">
	<div class="panel-heading">
		<h2 class="panel-title" align="center" >Plagiarism</h2>
	</div>
	<div class="panel-body text-justify">
		<p>Plagiarism means copying another person's work, language, thought or original ideas and passing them off as one's own. According to WordNet dictionary, plagiarism is defined as:</p>
		<ol>
			<li>A piece of writing that has been copied from someone else and is presented as being your own work.</li>
			<li><b>Act of plagiarizing:</b> Taking someone's words or ideas as if they were your own.</li>
		</ol>
		<p>In Academia, plagiarism is considered highly unethical and unprofessional. Not 	giving due credit to the original author is considered as theft of their work or ideas. 	The consequences of plagiarism can be extreme. Plagiarism can ruin entire careers 	and can land you in legal trouble as well.</p>

		<h3>Further Reading:</h3>
		<ul>
  			<li>The wikipedia page on plagiarism.</li>
			<a href="http://en.wikipedia.org/wiki/Plagiarism">http://en.wikipedia.org/wiki/Plagiarism</a>
			<li>A easy to understand source on Plagiarism.</li>
			<a href="http://www.plagiarism.org/">http://www.plagiarism.org/</a>
		</ul>			
	</div>
</div>

@stop

@section('scripts')
<script type="text/javascript">
	$(document).ready( function() {
		$('#plagDocLk').addClass('active');
	});
</script>
@stop
