<!--landing page-->
<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,  initial-scale=1.0">
	<title> Individual Assignment My Study KPI</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script>
	//JS to show responsive menu
	function myFunction() {
		var x = document.getElementById("myTopnav");
		if (x.className === "topnav") {
			x.className += " responsive";
		} else {
			x.className = "topnav";
		}
	}
	//JS to show div Registration id=registerDiv
	function showRegister(){
		var x = document.getElementById("registerDiv");
		x.style.display = 'block';

		var x = document.getElementById("newsDiv");
		x.style.display = 'none';

		var firstField = document.getElementById('matricNo');
		firstField.focus();
	}

	//JS to cancel registration by hiding div (display=none)
	function cancelRegister(){
		var x = document.getElementById("registerDiv");
		x.style.display = 'none';

		var x = document.getElementById("newsDiv");
		x.style.display = 'block';
	}
	</script>
</head>
<body>
    <div class="header">
        <h1>Login</h1>
    </div>
	
	<?php 
	$currentPage = 'login.php';
    if(isset($_SESSION["UID"])){
		include 'logged_menu.php';
    }
    else {
        include 'menu.php';
    }
    ?>
	<div class="row">
		<div class="col-login">
			<?php
			if(isset($_SESSION["UID"])){
            ?>
			<div class="imgcontainer">
				<img src="img/photo.png" alt="Avatar" class="avatar">
            </div>
			
			<?php
			echo '<p align="center">Welcome: '  . $_SESSION["userName"] . "<p>";
			}
			else {
				?>
				<form action="login_action.php" method="post" id="login">
					<div class="imgcontainer">
						<img src="img/photo.png" alt="Avatar" class="avatar">
                	</div>
					
					<div class="container">
						<label for="uname"><b>Username</b></label>
						<input type="text" placeholder="Username" name="userName" required>
						<label for="psw"><b>Password</b></label>
						<input type="password" placeholder="Enter Password" name="userPwd" required>
						<button type="submit" style="cursor: pointer;">Login</button>
						<label>
							<br>
							<input type="checkbox" checked="checked" name="remember"> Remember me
                    	</label>
                	</div>
					<div class="container">
						<div class="background-container">
							<span class="psw">
								<a onClick="showRegister()" style="cursor: pointer;"> Register</a> |
								<a style="cursor: pointer;">Forgot password?</a>
							</span>
						</div>
                	</div>
            	</form>
				<?php
			}
			?>
        </div>
		<div class="col-news">
			<div id="registerDiv">
				<h2>| User Registration </h2>
				<form action="register_action.php" method="post">
                	<label for="matricNo">Matric No</label>
                	<input type="text" name="matricNo" id="matricNo" required>

                	<label for="userEmail">User Email:</label>
                	<input type="email" id="userEmail" name="userEmail" required><br><br>

                	<label for="userPwd">Password:</label>
                	<input type="password" id="userPwd" name="userPwd" required maxlength="8"><br><br>

                	<label for="userPwd">Confirm Password:</label>
					<input type="password" id="confirmPwd" name="confirmPwd" required><br><br>

                	<input type="submit" value="Register" style="cursor: pointer;">

                	<button type="reset" value="Reset" style="cursor: pointer;">Reset</button>
                	<button type="reset" value="Cancel" onClick="cancelRegister()" style="cursor: pointer;">Cancel</button>
            	</form>
        	</div>
		</div>
	</div>
	<br><br>
	<footer>
		<br><small><i>Copyright &copy; Nur Irfani Ammtullah</i></small>
	</footer>
	
</body>
</html>
