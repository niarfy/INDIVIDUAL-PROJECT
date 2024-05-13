<?php
echo '<nav class="topnav" id="myTopnav">
<a href="about_me.php"';
if ($currentPage == 'about_me.php') {
echo ' class="active"';
}
echo '>About Me</a>
	<a href="profile.php"';
if ($currentPage == 'profile.php') {
    echo ' class="active"';
}
echo '>Profile</a>
    <a href="my_kpi.php"';
if ($currentPage == 'my_kpi.php') {
    echo ' class="active"';
}
echo '>KPI Indicator</a>
    <a href="my_activities.php"';
if ($currentPage == 'my_activities.php') {
    echo ' class="active"';
}
echo '>List of Activities</a>
    <a href="my_challenge.php"';
if ($currentPage == 'my_challenge.php') {
    echo ' class="active"';
}
echo '>Challenge and Future Plan</a>
	<a href="logout.php">Logout</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i></a>
</nav>';
?>


