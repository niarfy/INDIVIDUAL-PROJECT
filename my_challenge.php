<?php
session_start();
include("config.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Individual Assignment My Study KPI</title> 
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
</head>	
<body>
    <div class="header">
        <h1>Challenge and Plan</h1>
    </div>
    <?php
	$currentPage = 'my_challenge.php';
    if(isset($_SESSION["UID"])){
        include 'logged_menu.php';
    }
    else {
        //include 'menu.php';
        header("location:about_me.php");
    }
    ?>
	
	<h2>Challenge and Future Plan</h2>
	<div style="padding:0 10px;"id="listAndButton">
	<div style="text-align: right; padding:10px;">
        <form action="my_challenge_search.php" method="post">
            <input type="text" placeholder="Search.." name="search">
            <input type="submit" value="Search">
        </form> 
    </div>
	<table border="1" width="100%" id="projectable">
		<tr>
            <th width="5%">No</th>
            <th width="10%">Sem & Year</th>
            <th width="30%">Challenge</th>
            <th width="30%">Plan</th>
            <th width="15%">Remark</th>
            <th width="15%">Photo</th>
            <th width="10%">Action</th>
        </tr>
        <?php 
		$sql = "SELECT * FROM challenge WHERE userID=". $_SESSION["UID"];
		$result = mysqli_query($conn, $sql); 
             
		if (mysqli_num_rows($result) > 0) { 
			// output data of each row
			$numrow=1;
			//two additional codes to show the Edit and Delete link on each record. 
			while($row = mysqli_fetch_assoc($result)) { 
					echo "<tr>"; 
					echo "<td>" . $numrow . "</td>
					<td>". $row["sem"] . " " . $row["year"]. "</td>
					<td>" . $row["challenge"] . "</td>
					<td>" . $row["plan"] . "</td>
					<td>" . $row["remark"] . "</td>
					<td>" . $row["img_path"] . "</td>";

					//edit link
					echo '<td> <a href="my_challenge_edit.php?id=' . $row["ch_id"] . '">Edit</a>&nbsp;|&nbsp;'; 
					
					//delete link
					echo '<a href="my_challenge_delete.php?id=' . $row["ch_id"] . '" onClick="return confirm(\'Delete?\');">Delete</a> </td>'; 
					echo "</tr>" . "\n\t\t"; 
					$numrow++; 
			} 
        } else {
			echo '<tr><td colspan="6">0 results</td></tr>'; 
        }
		mysqli_close($conn);
		?>
	</table>
	<?php
	
	if(isset($_SESSION["UID"])){
		?>
		<div style="text-align: right; padding-top:10px;">
		<input type="button" value="Add New" onclick="toggleFormVisibility()"><!--change here-->
		</div>
		<?php
    }
    ?>
</div>

<div style="padding:0 10px; display: none;" id="challengeDiv">
<h3 align="center">Add Challenge and Plan</h3>
<p align="center">Required field with mark*</p>

<!-- action="my_challenge_action.php" is the PHP file to process values from the form, and attribute enctype="multipart/form-data"  is to enable file upload.-->
<form method="POST" action="my_challenge_action.php" enctype="multipart/form-data" id="myForm">
	<table border="1" id="myTable">
        <tr>
			<td>Semester*</td>
			<td width="1px">:</td>
			<td>
				<select size="1" name="sem" required>                        
					<option value="">&nbsp;</option>
					<option value="1">1</option>;                           
					<option value="2">2</option>;                        
				</select>
			</td>
		</tr>
		<tr>
			<td>Year*</td>
			<td>:</td>
			<td>
				<input type="text" name="year" size="5" required>                                    
			</td>
		</tr>
		<tr>
			<td>Challenge*</td>
			<td>:</td>
			<td>
				<textarea rows="4" name="challenge" cols="20" required></textarea>
			</td>
		</tr>
		<tr>
			<td>Plan*</td>
			<td>:</td>
			<td>
				<textarea rows="4" name="plan" cols="20" required></textarea>
			</td>
		</tr>
		<tr>
			<td>Remark</td>
			<td>:</td>
			<td>
				<textarea rows="4" name="remark" cols="20"></textarea>
			</td>
		</tr>
		<tr>
			<td>Upload photo</td>
			<td>:</td>
			<td>Max size: 488.28KB<br>
				<input type="file" name="fileToUpload" id="fileToUpload" accept=".jpg, .jpeg, .png">
			</td>
		</tr>
		<tr>
			<td colspan="3" align="right"> 
			<input type="submit" value="Submit" name="B1">                
			<input type="reset" value="Reset" name="B2">
			</td>
		</tr>
	</table>
</form>
</div>
<p></p>
<footer>
		<br><small><i>Copyright &copy; Nur Irfani Ammtullah</i></small>
	</footer>
	
	<script>
	//for responsive sandwich menu
	function myFunction() {
		var x = document.getElementById("myTopnav");
		if (x.className === "topnav") {
			x.className += " responsive";
		} else {
			x.className = "topnav";
		}
	}

	function show_AddEntry() {  
		var x = document.getElementById("challengeDiv");
		x.style.display = 'block';
		var firstField = document.getElementById('sem');
		firstField.focus();
	}

	//add everything
	function toggleFormVisibility() {
		var x = document.getElementById("challengeDiv");
		x.style.display = (x.style.display === 'none') ? 'block' : 'none';
	}
	function toggleFormVisibility() {
		var listAndButton = document.getElementById("listAndButton");
		var challengeDiv = document.getElementById("challengeDiv");

		listAndButton.style.display = 'none';
		challengeDiv.style.display = 'block';
	}
	function hideFormAfterSubmit() {
		var listAndButton = document.getElementById("listAndButton");
		var challengeDiv = document.getElementById("challengeDiv");

		listAndButton.style.display = 'block';
		challengeDiv.style.display = 'none';
	}
	</script>
</body>
</html>

