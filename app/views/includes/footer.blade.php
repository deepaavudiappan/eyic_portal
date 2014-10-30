
<div class="row">
	<div class="col-sm-12" style="margin-top : 30px;">
		<!-- Footer ================================================== -->

		<div class="container">	
			<div class="well well-small text-center">
				<em>
					e-Yantra is a project sponsored by MHRD through the National Mission on Education through ICT (NMEICT)		
				</em>
			</div>

			<hr class="soften"/>
			<footer class="footer">
				<p>
					<span class="pull-right">
						<a class="btn btn-primary" href="https://twitter.com/eyantra_iitb" target="_blank">t</a> 
						<a class="btn btn-danger" href="https://plus.google.com/u/0/115192232830737300162/posts" target="_blank">g+</a> 
						<a class="btn btn-primary" href="https://www.facebook.com/eyantra" target="_blankk">f</a> 
					</span>

					<a href="{{ URL::to('homepage') }}">Home</a> - 
					<a href="http://portal.e-yantra.org/eyrc/about_eyrc">About Competition</a>
				</p>
				<hr class="soften"/>

				<p>&copy; Copyright e-Yantra <br/><br/></p>
				<p class="text-warning">This portal is best viewed by Mozilla Firefox® 10.x or higher, Google Chrome 18 or higher.</p>
			</footer>
		</div><!-- /container -->	</div>
	</div>

	<!-- Scripts are placed here -->
	<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
	<script src="{{ URL::asset('js/jquery-1.11.1.min.js') }}"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
	<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
	<!--<script src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">-->
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-41067758-2', 'auto');
		ga('send', 'pageview');

	</script>
	@yield('scripts')