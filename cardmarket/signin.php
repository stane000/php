<?php 
	print '
	<div id="signin">';
	
	if ($_POST['_action_'] == FALSE) {
		print '
		<form action="" name="myForm" id="myForm" method="POST" class="form-control"> 
			<div class="container">
				<div class="row">
					<input type="hidden" id="_action_" name="_action_" value="TRUE">
					<div class="imgcontainer">
						<img src="img/avatar.png" alt="Avatar" style="hight: 300px; width: 300px; border-radius: 50%;">
					</div>
				</div>
				<div class="row" style="padding-left: 400px;">
						<input type="hidden" id="_action_" name="_action_" value="TRUE">
					
						<label for="username">Username:*</label>
						<input type="text" id="username" name="username" value="" pattern=".{5,10}" required autofocus>
				</div>
				<div class="row" style="padding-left: 400px;">								
						<label for="password">Password:*</label>
						<input type="password" id="password" name="password" value="" pattern=".{4,}" required>
				</div>
				<div class="row" style="padding-left: 400px;">					
						<input type="submit" value="Login" style="width: 460px">
				</div>
				<div class="row">	
						<div style="background-color:#f1f1f1; margin-top: 50px" id="myElementID">
							<button type="button" class="cancelbtn" onclick="myFunction()">Cancel</button>
							<span class="psw">Forgot <a href="#">password?</a></span>
						</div>
			    </div>
			</div>
		</form>
		<script>
			function myFunction() {
				var element = document.getElementById("myElementID");
				element.parentNode.removeChild(element);
			}
		</script>';
	}
	else if ($_POST['_action_'] == TRUE) {
		
		$query  = "SELECT * FROM users";
		$query .= " WHERE username='" .  $_POST['username'] . "' AND archive='N'";
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		if (password_verify($_POST['password'], $row['password'])) {
			#password_verify https://secure.php.net/manual/en/function.password-verify.php
			$_SESSION['user']['valid'] = 'true';
			$_SESSION['user']['id'] = $row['id'];
			# 1 - administrator; 2 - editor; 3 - user
			$_SESSION['user']['roles'] = $row['roles'];
			$_SESSION['user']['firstname'] = $row['firstname'];
			$_SESSION['user']['lastname'] = $row['lastname'];
			$_SESSION['user']['username'] = $row['username'];
			$_SESSION['user']['email'] = $row['email'];
			$_SESSION['user']['country'] = $row['country'];
			$_SESSION['user']['money'] = $row['money'];
			$_SESSION['user']['picture'] = $row['picture'];
			# Redirect to admin website
			if($row['roles'] == 'admin'){
				$_SESSION['message'] = '<p>Dobrodošli, ' . $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname'] . '</p>';
				header("Location: index.php?menu=7");
			}
			else{
				header("Location: index.php?menu=9");
			}
		}
		
		# Bad username or password
		else {
			unset($_SESSION['user']);
			$_SESSION['message'] = '<p>You entered wrong email or password!</p>';
			header("Location: index.php?menu=6");
		}
	}
	print '
	</div>';
?>