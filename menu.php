<!--a.	id="myTopnav" is the attribute that specifies a unique id for the <nav> element-->
<?php
echo '<nav class="topnav" id="myTopnav">
		<a href="about_me.php"  class="active">About me</a> 
        <a href="my_kpi.php">KPI Indicator</a> 
        <a href="my_activities.php">List of Activities</a> 
		<a href="my_challenge.php">Challenge and Future Plan</a>
		
		<a href="javascript:void(0);" class="icon" onclick="myFunction()">
		<i class="fa fa-bars"></i></a>
	</nav>';
?>