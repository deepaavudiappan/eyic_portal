<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mentor</title>
</head>
<body>
	<h2>Add Project Details</h2><br/>
	<p>Project Name: </p><br/>
	<p>Mentor Name: </p><br/>
	<p>Mentor Email: </p><br/>
	{{ Form::open(array('route' => 'addprojectdetail', 'method' => 'POST')) }}
	<p>Student Coordinator (First Student Details) Email: <input type="text" name="std1_email" id="std1_email"/></p><br/>
	<p>2nd Student Email: <input type="text" name="std2_email" id="std2_email"/></p><br/>
	<p>3nd Student Email: <input type="text" name="std3_email" id="std3_email"/></p><br/>
	<p>4nd Student Email: <input type="text" name="std4_email" id="std4_email"/></p><br/>
	{{ Form::submit('Submit' , array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
</body>
</html>
