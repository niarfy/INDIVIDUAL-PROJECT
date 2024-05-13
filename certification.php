<?php
include("config.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Individual Assignment My Study KPI</title>
        
        <!--To link the external stylesheet style.css that you have created--> 
        <link rel="stylesheet" href="css/style.css">
    
        <!--required to use the icon library from font-awesome.min.css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
<body>
    <!-- This is another CSS style for header image -->
    <div class="header">
        <h1>Certification</h1>
    </div>
    <?php include 'menu.php';?>

    <h2>Certification</h2>
    <div style="padding:0 10px;">
    <table border="1" width="100%" id="projectable">  
        <tr>
            <th width="5%">Faculty KPI</th>
            <th width="10%">&gt;=1</th>
            <th width="10%">&nbsp;</th>
        </tr>
        <tr>
            <th width="5%">Student Aims</th>
            <th width="10%">3</th>
            <th width="10%">&nbsp;</th>
        </tr>
        <?php 
            $sql = "SELECT * FROM certification"; 
            $result = mysqli_query($conn, $sql); 
             
            if (mysqli_num_rows($result) > 0) { 
                // output data of each row
				$numrow = 0; // Initialize numrow to 0
                $currentYear = date("Y");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    $displayYear = ($currentYear - date("Y")) + 1;
                    $semester = ($displayYear % 2 === 0) ? "Sem 2" : "Sem 1";
                    $year = "Year " . ceil($displayYear / 2);
                    
                    echo "<td>$semester $year</td>
                        <td>" . $row["kpi"] . "</td>";
            
                    // Edit link
                    echo '<td> <a href="certification_edit.php?id=' . $row["cert_id"] . '">Edit</a>&nbsp;|&nbsp;';
            
                    // Delete link
                    echo '<a href="certification_delete.php?id=' . $row["cert_id"] . '" onClick="return confirm(\'Delete?\');">Delete</a> </td>';
                    echo "</tr>" . "\n\t\t";
                    $currentYear++;
                }
            }else {
                echo '<tr><td colspan="6">0 results</td></tr>';
            }
            mysqli_close($conn);
            ?>
</table> 
</div>
    <div style="padding:0 10px;" id="certificationDiv">
	<h3 align="center">Add Certification KPI</h3>
	<p align="center">Required field with mark*</p>

    <!-- action="Certification_action.php" is the PHP file to process values from the form, and attribute enctype="multipart/form-data"  is to enable file upload.-->
	<form method="POST" action="certification_action.php" enctype="multipart/form-data" id="myForm">
		<table border="1" id="myTable">
			<tr>
				<td>MyKPI*</td>
				<td>:</td>
				<td>
					<textarea rows="4" name="kpi" cols="20" required></textarea>
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

    <button onclick="redirectTo('my_kpi.php')">Go Back to My KPI</button>
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
</html>
