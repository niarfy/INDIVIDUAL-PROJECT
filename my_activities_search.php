<?php
session_start();
include("config.php");
?>
<!DOCTYPE html>
<html>

<head>
<title>Individual Assignment My Study KPI</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   
</head>
<body>
<div class="header">
    <h1>List of Activities</h1>
</div>

<?php
$currentPage = 'my_activities.php'; 
    $search = "";
    if(isset($_SESSION["UID"])){
        include 'logged_menu.php';
    }
    else {
        //include 'menu.php';
        header("location:about_me.php");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $search = $_POST["search"]; 
    }
?>

<h2>Search Result:&nbsp;<?=$search?></h2>

<div style="padding:0 10px;">
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
            <th width="10%">Photo</th>
            <th width="10%">Action</th>
        </tr>
        <?php
            if ($search!="") {
                $search = $_POST["search"]; 
                
                // Split the search string into individual words
                $keywords = explode(" ", $search);

                // Prepare the SQL query with multiple LIKE conditions
                $sql = "SELECT * FROM activities WHERE (";

                // Build the conditions dynamically for single keyword
                $conditions = [];
                foreach ($keywords as $about_me => $keyword) {
                    $conditions[] = "activities LIKE '%$keyword%'";
                }                
                
                // Combine
                $sql .= implode(" OR ", $conditions);

                // Select only with this userID
                $sql .= " OR activities LIKE '%$search%') AND userID=" . $_SESSION["UID"]; 
                
                $result = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    $numrow=1;
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $numrow . "</td><td>". $row["sem"] . " " . $row["year"]. "</td><td>" . $row["activities"] .
                            "</td><td>" . $row["remark"] . "</td><td>" . $row["img_path"] . "</td>";
                        echo '<td> <a href="my_activities_edit.php?id=' . $row["act_id"] . '">Edit</a>&nbsp;|&nbsp;';
                        echo '<a href="my_activities_delete.php?id=' . $row["act_id"] . '" onClick="return confirm(\'Delete?\');">Delete</a> </td>';
                        echo "</tr>" . "\n\t\t";
                        $numrow++;
                    }
                } else {
                    echo '<tr><td colspan="7">0 results</td></tr>';
                } 
                
                mysqli_close($conn);
            }
            else{
                echo "Search query is empty<br>";
            }
        ?>
    </table>
    <?php
        if(isset($_SESSION["UID"])){
    ?>
        <div style="text-align: right; padding-top:10px;">
            <input type="button" value="Add New" onclick="show_AddEntry()">
        </div>
    
    <?php
    }
    ?>
</div>

<div style="padding:0 10px; display: none;" id="activitiesDiv">
    <h3 align="center">Add activities</h3>
    <p align="center">Required field with mark*</p>

    <form method="POST" action="my_activities_action.php" enctype="multipart/form-data" id="myForm">
        <table border="1" id="myTable">
            <tr>
                <td>Semester*</td>
                <td width="1px">:</td>
                <td>
                    <select size="1" id="sem" name="sem" required>                        
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
    <p>Copyright (c) 2023 - Nur Irfani Ammtullah</p>
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
    var x = document.getElementById("activitiesDiv");
    x.style.display = 'block';
    var firstField = document.getElementById('sem');
    firstField.focus();
}
</script>
</body>
</html>
