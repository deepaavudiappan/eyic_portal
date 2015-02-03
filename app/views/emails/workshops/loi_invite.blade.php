<div style="width:700px;text-align:center;background-color:#E5E5E6;padding-left:50px;padding-right:50px;padding-top:20px;font-family: Verdana, Geneva, sans-serif;font-size:14px;">
	<div style="width:700px;test-align:center;background-color:#ffffff;background-image: url('bg.jpg');">
		<div style="border-bottom:1px solid #D1D1D3;">
			{{ HTML::image('img/emails/header.jpg', 'Header', array('style' => 'width:700px;')) }}
		</div>
		<br/>
		<div style="text-align:justify;padding:13px;">
			<div>
				<div style="width:330px;float:left;padding:5px;">
					{{ HTML::image('img/emails/image.jpg', 'Image', array('style' => 'width:320px;'))}}
				</div>
				<div style="width:330px;float:left;margin-bottom:20px;">
					Dear Sir/Madam,<br/>
					<br/>
					Greetings from e-Yantra!<br/>
					<br/>
					We have received the Letter of Intent (LoI) from your college.<br/>
					<br/>
					We are happy to let you know that your teacher team is automatically registered for the 2-day workshop on "Introduction to Robotics" as the first step of engagement with e-Yantra for your teacher teams through the e-Yantra Lab Setup Initiative (eLSI).<br/>
					<br/>
					The dates and venue is given below:<br/>
					<br/>
					Date: <strong>{{$date;}}</strong><br/>
					Venue: <strong>{{$venue;}}</strong><br/>
					Coordinator: <strong>{{$nc_coor;}}</strong><br/>
					Contact number: <strong>{{$contact_num;}}</strong><br/>
					e-mail: <strong>{{$email;}}</strong><br/>
					<br/>
					For workshop schedule click here: <br/>
					<br/>
				</div>
			</div>
			<div style="float:left">
				Here are the modalities of the workshop:<br/>
				<br/>
				<hr/>
				<ol>
					<li>No fee will be collected from any participant. Tea/Lunch will be provided on both the days of workshop.</li>
					<li>All traveling and staying expenses of the team members attending the workshops are borne by their respective colleges.</li>
					<li>Each participating college team member registers at the venue on the first day of workshop. Any change in the team members is allowed till the day of the workshop. No changes will be allowed after registration at the workshop.</li>
					<li>Teachers will be given a participation certificate from e-Yantra upon successful participation on both days of the workshop.</li>
					<li>Each Teacher team successfully participating on both days of the workshop will receive a robotic kit at the end of the workshop. These teams will participate in the e-Yantra Robotics Teacher Competition (eYRTC).</li>
					<li>No substitution of team member will be allowed during eYRTC.</li>
				</ol>
				<hr/>
				<br/>
				We look forward to meeting you and your team at the workshop.<br/>
				<br/>
				Feel free to contact us at support@e-yantra.org in case of any query.<br/>
				<br/>
				All the best!!<br/>
				e-Yantra Team
			</div>
		</div>
		<br/>
		<div style="border-top:1px solid #D1D1D3;clear:both;">
			{{ HTML::image('img/emails/footer.jpg', 'Footer', array('style' => 'width:700px;')) }}
		</div>
	</div>
</div>