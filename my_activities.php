<?php
session_start();
include("config.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Individual Assignment My Study KPI</title>
        <!--To link the external stylesheet style.css that you have created--> 
        <link rel="stylesheet" href="css/style.css">
        <!--required to use the icon library from font-awesome.min.css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
<body>
	<!-- This is another CSS style for header image -->
    <div class="header">
        <h1>List of Activities</h1>
    </div>
    <?php
	$currentPage = 'my_activities.php';
    if(isset($_SESSION["UID"])){
        include 'logged_menu.php';
    }
    else {
        //include 'menu.php';
        header("location:about_me.php");
    }
    ?>
	
	<h2>List Of Activities</h2>
    <div style="padding:0 10px;"id="listAndButton">
		<div style="text-align: right; padding:10px;">
			<form action="my_activities_search.php" method="post">
				<input type="text" placeholder="Search.." name="search">
				<input type="submit" value="Search">
			</form> 
		</div>
		<table border="1" width="100%" id="projectable">  
			<tr>
				<th width="5%">No</th>
				<th width="10%">Sem & Year</th>
				<th width="30%">Name of Activities/Club/Association/Competition</th>
				<th width="15%">Remark</th>
				<th width="15%">Photo</th>
				<th width="10%">Action</th>
			</tr>
			<?php 
				$sql = "SELECT * FROM activities WHERE userID=". $_SESSION["UID"];
				$result = mysqli_query($conn, $sql); 
				
				if (mysqli_num_rows($result) > 0) { 
					// output data of each row
					$numrow=1;

					//two additional codes to show the Edit and Delete link on each record. 
					while($row = mysqli_fetch_assoc($result)) { 
						echo "<tr>"; 
						echo "<td>" . $numrow . "</td>
						<td>". $row["sem"] . " " . $row["year"]. "</td>
						<td>" . $row["activities"] . "</td>
						<td>" . $row["remark"] . "</td>
						<td>" . $row["img_path"] . "</td>";

						//edit link
						echo '<td> <a href="my_activities_edit.php?id=' . $row["act_id"] . '">Edit</a>&nbsp;|&nbsp;'; 
						
						//delete link
						echo '<a href="my_activities_delete.php?id=' . $row["act_id"] . '" onClick="return confirm(\'Delete?\');">Delete</a> </td>'; 
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

    <div style="padding:0 10px; display: none;" id="activitiesDiv">
	<h3 align="center">Add Activity</h3>
	<p align="center">Required field with mark*</p>

    <!-- action="my_activities_action.php" is the PHP file to process values from the form, and attribute enctype="multipart/form-data"  is to enable file upload.-->
	<form method="POST" action="my_activities_action.php" enctype="multipart/form-data" id="myForm">
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
				<td>Name of Activities/Club/Association/Competition*</td>
				<td>:</td>
				<td>
					<textarea rows="4" name="activities" cols="20" required></textarea>
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
				<td>
					Max size: 488.28KB<br>
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
			
	function toggleFormVisibility() {
		var listAndButton = document.getElementById("listAndButton");
		var activitiesDiv = document.getElementById("activitiesDiv");

		listAndButton.style.display = 'none';
		activitiesDiv.style.display = 'block';
	}
	function hideFormAfterSubmit() {
		var listAndButton = document.getElementById("listAndButton");
		var activitiesDiv = document.getElementById("activitiesDiv");

		listAndButton.style.display = 'block';
		activitiesDiv.style.display = 'none';
	}
	</script>
</body>
</html>
