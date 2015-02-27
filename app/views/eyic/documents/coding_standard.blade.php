@extends('layouts.master')
@section('styles')
<style>
.mb-style-5 {
    width: 390px;
}
 
.mb-style-5 blockquote {
    text-align: center;
    background: #333;
    width: 350px;
    height: 350px;
    padding: 60px;
    padding-top:50px;
    border-radius: 50%;
    box-shadow: 
        inset 0 0 0 10px #333, 
        inset 0 0 0 12px rgba(255,255,255,0.6), 
        80px 0 0 rgba(255,255,255,0.3),
        -80px 0 0 rgba(255,255,255,0.3),
        50px 0 0 rgba(60,185,145,0.2),
        -50px 0 0 rgba(185,60,60,0.2);
}
.mb-style-5 blockquote p {
    color: #fff;
    font-size: 20px;
    font-weight: 400;
    padding-top: 0px;
    text-transform: uppercase;
    text-shadow: 0 0 1px #fff, 0 1px 1px #000;
    font-family: 'Annie Use Your Telescope', cursive;
}
.mb-style-5 blockquote p span {
    display: block;
    position: relative;
    padding-top: 28px;
    margin-top: 28px;
    border-top: 1px solid rgba(255,255,255,0.3);
}
.mb-style-5 blockquote p span:before {
    position: absolute;
    width: 50px;
    height: 50px;
    background: #ddd;
    content: "\275d";
    font-size: 40px;
    color: #333;
    top: 0px;
    left: 50%;
    margin: -25px 0 0 -25px;
    border-radius: 50%;
}
.mb-style-5 .mb-attribution {
    text-align: center;
    font-family: 'Annie Use Your Telescope', cursive;
    padding: 20px;
    font-size: 16px;
}
.mb-style-5 cite a:hover{
    color: #000;
}
</style>
@stop

@section('content')
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Coding Standard eYIC-2015</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12 text-center">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 text-justify"><br/>
				<ul>
					<li>The following documentation and comment styles are to be used for the code submitted by the teams.</li>
					<li>Replace all the <strong>&lt;Description&gt;</strong> tags from the comments below to add appropriate content for your application.</li>
				</ul><br/>
				<ol>
					<li><strong>File Level Comments</strong><br/>
						<p>Each user’s code file should start with File Level comments in the format as follows:</p>
						
						<pre class="prettyprint lang-c">
/*
*
* Project Name: 	&lt;Project Name&gt;
* Author List: 		&lt;Name of the team members who worked on this function 
*			(Comma separated eg. Name1, Name2)&gt;
* Filename: 		&lt;Filename&gt;
* Functions: 		&lt;Comma separated list of Functions defined in this file&gt;
* Global Variables:	&lt;List of all the global variables defined in this file, None if no global 
*			variables&gt;
*
*/
						</pre>
					</li>
					<li><strong>Function Level Comments</strong><br/>
						<p>Each function should have the following comment section before it:</p>
						<pre class="prettyprint lang-c">
/*
*
* Function Name: 	&lt;Function Name&gt;
* Input: 		&lt;Inputs (or Parameters) list with description if any&gt;
* Output: 		&lt;Return value with description if any&gt;
* Logic: 		&lt;Description of the function performed and the logic used in the function&gt;
* Example Call:		&lt;Example of how to call this function&gt;
*
*/
						</pre>
					</li>
					<li><strong>Variable Comments</strong><br/>
						<p>In general the variable/function names should be descriptive enough to give a good idea of what the variable is used for.,For example, variable names like 'black_line_threshold_value', 'left_motor_turn_right' are preferrable and makes your code readable. Variable names like 'a', 'b and 'temp' are not acceptable variable names.<br/><br/>
							In some cases, variable names might require some description for which the following format can be used:</p>
							<code class="prettyprint lang-c">
								// Variable Name: Description of the variable and the range of expected values of the variable
							</code>
						</li>
						<br/>
						<li><strong>Implementation Comments</strong><br/>
							<p>In your implementation/actual code, you should have comments in tricky, non-obvious, interesting, or important parts of the code.<br/><br/>
								The comments can be of the format as below:</p>
								<code class="prettyprint lang-c">
									// Describe what the code below is doing
								</code><br/>
							</li>
						</ol><br/>
						<strong>An Illustrative Example:</strong>
						<p>We provide sample comments in a rudimentary program that outputs the Fibonacci Series (For more information on Fibonacci Series visit: <a href="http://en.wikipedia.org/wiki/Fibonacci_number">http://en.wikipedia.org/wiki/Fibonacci_number</a>). Please note that this is not the complete and perfect example of generating Fibonacci Numbers but acts as a simple way to illustrate the coding style and comments explained above.</p>
						<br/>
						<pre class="prettyprint lang-c">
/*<br/> 
* Project Name: 	e-Yantra Project
* Author List: 		Amiraj Dhawan, e-Yantra Team
* Filename: 		fibonacci.c
* Functions: 		print_fibonacci_series(int) , main()
* Global Variables:	NONE
*
*/

#include&lt;stdio.h&gt;

/*
* Function Name:	print_fibonacci_series
* Input:		num_elements -> integer which stores the number of elements of the fibonacci
*			series to be printed
* Output:		prints the first num_elements of the fibonacci series
* Logic:		The next element of the Fibonacci series is given by 
*			next = current_element + prev_element. The code loops for num_elements and 
*			prints out the next element
* Example Call:		print_fibonacci_series(10);
*
*/
void print_fibonacci_series(int num_elements){
	int first = 0, second = 1, next;
	printf("First %d terms of Fibonacci series are :-\n", num_elements);

	//counter: will iterate from 0 to (num_elements - 1)
	for ( int counter = 0 ; counter < num_elements ; counter++ ) {
		if ( counter <= 1 )
			next = counter;
		else {

			//The next element is equal to the sum of the current element (second variable)
			//and the previous element (first variable)
			next = first + second;

			//first element becomes the second element and second element becomes the next 
			//element for the next loop iteration
			first = second;
			second = next;
		}
		printf("%d\n", next);
	}
}

/*
* Function Name:	main
* Input:		None
* Output:		int to inform the caller that the program exited correctly or incorrectly 
*			(C code standard)
* Logic:		Ask the user to input the number of elements required from the Fibonacci Series
*			and call the function  print_fibonacci_series
* Example Call:		Called automatically by the Operating Syste
*
*/
int main() {
	int num_elements;

	//Ask the user to input the number of elements required
	printf("Enter the number of terms\n");

	scanf("%d",&num_elements);

	//Call the function to print the first num_elements of the Fibonacci Series
	print_fibonacci_series(num_elements);

	return 0;
}
		</pre>
	</div>
</div>
<hr/>
<pre class="prettyprint lang-c">
/*
*	Following a coding style might look to be tedious at first but is one of the most important 
*	thing to be done while developing any piece of code. This ensures that it is readable so
*	that others can understand what your code is doing. Even you yourself may find it useful
*	after some time!
*/</pre>
 <br/>
 <hr/>
<div class="row text-center">
	<div class="col-md-6 col-md-offset-3">
		<div class="mb-style-5">
			<blockquote>
				<p>Any fool can write code that a computer can understand. <span>Good programmers write code that humans can understand.</span></p>
			</blockquote>
			<div class="mb-attribution">
				<p class="mb-author"><a href="http://en.wikipedia.org/wiki/Martin_Fowler">Martin Fowler</a></p>
				<cite><a href="http://en.wikipedia.org/wiki/Martin_Fowler">Wikipedia - Martin Fowler</a></cite>
			</div>
		</div>
	</div>
</div>
<div class="row text-center">
	<div class="col-md-6 col-md-offset-3">
		<div class="mb-style-5">
			<blockquote>
				<p>Programs must be written for people to read, <span>and only incidentally for machines to execute.</span></p>
			</blockquote>
			<div class="mb-attribution">
				<p class="mb-author"><a href="http://en.wikipedia.org/wiki/Hal_Abelson">Hal Abelson</a> &amp; <a href="http://en.wikipedia.org/wiki/Gerald_Jay_Sussman">Gerald Jay Sussman</a></p>
				<cite><a href="http://en.wikipedia.org/wiki/Hal_Abelson">Wikipedia - Hal Abelson</a></cite><br/>
				<cite><a href="http://en.wikipedia.org/wiki/Gerald_Jay_Sussman">Wikipedia - Gerald Jay Sussman</a></cite>
			</div>
		</div>
	</div>
</div>
<div class="row text-center">
	<div class="col-md-6 col-md-offset-3">
		<div class="mb-style-5">
			<blockquote>
				<p>Always code as if the guy who ends up maintaining your code will be <span>a violent psychopath who knows where you live.</span></p>
			</blockquote>
			<div class="mb-attribution">
				<p class="mb-author"><a href="https://rickosborne.org/">Rick Osborne</a></p>
				<cite><a href="https://rickosborne.org/">Website - Rick Osborne</a></cite>
			</div>
		</div>
	</div>

</div>
	@stop

	@section('scripts')
	<script type="text/javascript">
		$(document).ready( function() {
			$('#cdstndrdLk').addClass('active');
		});
	</script>
	<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
	@stop
