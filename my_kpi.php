<?php
session_start();
include("config.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Individual Assignment My Study KPI</title>
                
        <!--To link the external stylesheet style.css that you have created--> 
        <link rel="stylesheet" href="css/style.css">

        <!--required to use the icon library from font-awesome.min.css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   
    </head>
<body>
    <!-- This is another CSS style for header image -->
    <div class="header">
        <h1>My KPI Indicator</h1>
    </div>
    <?php
	$currentPage = 'my_kpi.php';
    if(isset($_SESSION["UID"])){
        include 'logged_menu.php';
    }
    else {
        //include 'menu.php';
        header("location:about_me.php");
    }
    ?>
    <div style="padding:0 10px;"id="listAndButton">
		<div style="text-align: right; padding:10px;">
    <div class="button-container">
    <button class = "custome-button" onclick="redirectTo('student_activity.php')">Student Activity</button>
    <button class = "custome-button" onclick="redirectTo('competition.php')">Competition</button>
    <button class = "custome-button" onclick="redirectTo('certification.php')">Certification</button>
    </div>
    <p></p>
	<footer>
		<br><small><i>Copyright &copy; Nur Irfani Ammtullah</i></small>
	</footer>
    <!--use the associated font-awesome.min.css when (a) the sandwich icon is shown and (b) clicked in a small screen display-->
    <script>
                function myFunction() {
                var x = document.getElementById("myTopnav");
                            if (x.className === "topnav") {
                                x.className += " responsive";
                            } else {
                                x.className = "topnav";
                            }
                }
                function redirectTo(page) {
            window.location.href = page;
        }
        </script>
</body>
</php>
