<?php 
	print '
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
	<h1>Registration Form</h1>
	<div id="register">';
	
	if ($_POST['_action_'] == FALSE) {
		print '
		<div class="card bg-light">
			<article class="card-body mx-auto" style="max-width: 800px;">
				<h4 class="card-title mt-3 text-center">Create Account</h4>
				<p class="text-center">Get started with your free account</p>
				<p style="padding-left: 200px;>
					<a href="" class="btn btn-block btn-twitter"> <i class="fab fa-twitter"></i>   Login via Twitter</a>
					<a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>   Login via facebook</a>
				</p>
				<form action="" id="registration_form" name="registration_form" method="POST">
					<div style="padding-left: 200px;">
						<input type="hidden" id="_action_" name="_action_" value="TRUE">
						<div class="form-group input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"> <i class="fa fa-user"></i> </span>
							</div>
							<input type="text" id="fname" name="fullname" size="600" placeholder="Your Full name.." required autofocus> 
						</div> <!-- form-group// -->
						<div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"> <i class="fa fa-user"></i> </span>
						</div>
						<input type="text" id="username" name="username" pattern=".{5,10}" placeholder="Username.." required><br>
						</div> <!-- form-group// -->
						<div class="form-group input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
							</div>
							<input type="email" id="email" name="email" placeholder="Your e-mail.." required>
						</div> <!-- form-group// -->
						<div class="form-group input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"> <i class="fa fa-building"></i> </span>
							</div>
							<select name="country" id="country">
									<option value="">molimo odaberite</option>';
									#Select all countries from database webprog, table countries
									$query  = "SELECT * FROM countries";
									$result = @mysqli_query($MySQL, $query);
									while($row = @mysqli_fetch_array($result)) {
										print '<option value="' . $row['country_code'] . '">' . $row['country_name'] . '</option>';
									}
						print '
							</select>
						</div> <!-- form-group end.// -->
						<div class="form-group input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
							</div>
							<input name="password" id="password" type="password" onkeyup="check();" />
						</div> <!-- form-group// -->
						<div class="form-group input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
							</div>
							<input type="password" name="confirm_password" id="confirm_password" placeholder="repeat password"  onkeyup="check();" /> <span id="message" style="padding-left: 50px; padding-top: 20px""></span>
						<script>
						var check = function() {
							if (document.getElementById("password").value ==
							document.getElementById("confirm_password").value) {
							document.getElementById("message").style.color = "green";
							document.getElementById("message").innerHTML = " <-password matching";
							} else {
							document.getElementById("message").style.color = "red";
							document.getElementById("message").innerHTML = " <-password not matching";
							}
						}
						</script>
					</div>
					</div> <!-- form-group// -->
				
					<div style="padding-left: 200px; padding-right: 240px">
						<button class="btn btn-primary" type="Submit"" value="Submit">Create Account</button>
					</div>
				
					</div> <!-- form-group// -->      
					<p class="text-center">Have an account? <a  href="index.php?menu=6"">Log In</a> </p>                                                                
				</form>
			</article>
	    </div> <!-- card.// -->';



	}
	else if ($_POST['_action_'] == TRUE) {
		
		$query  = "SELECT * FROM users";
		$query .= " WHERE email='" .  $_POST['email'] . "'";
		$query .= " OR username='" .  $_POST['username'] . "'";
		$result = @mysqli_query($MySQL, $query);
		$firstname = explode(" ",$_POST["fullname"])[0];
		$lastname = explode(" ",$_POST["fullname"])[1];
		$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		if ($row == NULL) {
			# password_hash https://secure.php.net/manual/en/function.password-hash.php
			# password_hash() creates a new password hash using a strong one-way hashing algorithm
			$pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
			
			$query  = "INSERT INTO users (firstname, lastname, email, username, password, country)";
			$query .= " VALUES ('" . $firstname. "', '" . $lastname . "', '" . $_POST['email'] . "', '" . $_POST['username'] . "', '" . $pass_hash . "', '" . $_POST['country'] . "')";
			$result = @mysqli_query($MySQL, $query);
			print $firstname;
			# ucfirst() — Make a string's first character uppercase
			# strtolower() - Make a string lowercase
			echo '<p>' . ucfirst(strtolower($firstname)) . ' ' .  ucfirst(strtolower($lastname)) . ', thank you for registration </p>
			<hr>';
		}
		else {
			echo '<p>User with this email or username already exist!</p>';
		}
	}
	print '
	</div>';
?>