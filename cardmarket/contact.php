<?php 
	print '
	<div id="contact" >
	<div class="container" style="padding: 1em;">
		<div class="row" style="padding: 1em;">
			<h1>Contact Form</h1>
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5561.963795828768!2d15.966299056569468!3d45.811620925641584!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4765d6e35f464d23%3A0xa5b0e42692bd4e9d!2sCarta%20Magica!5e0!3m2!1shr!2shr!4v1634808890539!5m2!1shr!2shr" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
		</div>
		<br>
		<div class="row" style="border: 2px solid black; padding: 3em; margin-left: 20px; margin-right: 20px;">
				<form action="http://work2.eburza.hr/pwa/responzive-page/send-contact.php" id="contact_form" name="contact_form" method="POST">
					<label for="fname">First Name *</label>
					<input type="text" id="fname" name="firstname" placeholder="Your name.." required>

					<label for="lname">Last Name *</label>
					<input type="text" id="lname" name="lastname" placeholder="Your last name.." required>
					
					<label for="lname">Your E-mail *</label>
					<input type="email" id="email" name="email" placeholder="Your e-mail.." required>

					<label for="country">Country</label>
					<select id="country" name="country">
					<option value="">Please select</option>
					<option value="BE">Belgium</option>
					<option value="HR" selected>Croatia</option>
					<option value="LU">Luxembourg</option>
					<option value="HU">Hungary</option>
					</select>
					<label for="subject">Subject</label>
					<textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

					<input type="submit" value="Submit">
				</form>
			</div>
		</div>
		<br>
		<br>
	</div>
</div>';
?>