<!--landing page-->
<?php
session_start();
?>
<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Individual Assignment My Study KPI</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div class="header">
		<h1>About Me</h1>
	</div>

	<?php 
	$currentPage = 'about_me.php';
    if(isset($_SESSION["UID"])){
		include 'logged_menu.php';
    }
    else {
        include 'menu.php';
    }
    ?>
	<!-- Login Button Redirecting to Login Page -->
    <div class="login-container">
        <button class="login-button" onclick="window.location.href='login.php'">Login/Register</button>
    </div>
</div>

	<div class="row">
		<div class="col-news">
			<div id="newsDiv">
				<!-- Profile Picture -->
				<div class="imgcontainer">
					<img src="img/fani.png" alt="Profile Picture" class="avatar">
				</div>

				<h2>HELLO! MY NAME IS </h2>
				<h1>Nur Irfani Ammtullah, BI21110341</h1>
				<h2>Software Engineering</h2>
				<p>I am from Kampung Lohan Ulu, Ranau, Sabah, Malaysia. I am from intake batch 2020 and my mentor's name is Dr Chin Pei Yee. I am passionate about creating delightful online experiences. With a focus on front-end technologies, I specialize in HTML, CSS, and JavaScript to bring ideas to life on the web.</p>
				<h2>My Study Motto</h2>
				<p>An investment in knowledge pays the best interest.</p>
				<br><br>
				<table border="0" width="60%">
					<tr>
						<td>Contact Info</td>
						<th>0178694774</th>
						<th>nur_irfani_bi21@iluv.ums.edu.my</th>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<br><br>
	<footer>
		<br><small><i>Copyright &copy; Nur Irfani Ammtullah</i></small>
	</footer>
</body>
</html>
