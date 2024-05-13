<?php
include('config.php');

//variables
$action="";
$id = ""; 
$cgpa = ""; 
$faculty = ""; 
$university =" ";
$national = ""; 
$international = ""; 

//this block is called when button Submit is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //values for add or edit
    $id = $_POST["cid"];
    $cgpa = trim($_POST["cgpa"]);
    $faculty = trim($_POST["faculty"]);
    $university = trim($_POST["university"]);
    $national = trim($_POST["national"]);
    $international = trim($_POST["international"]);

    
            // No new image uploaded, update other form data without changing the image
            $sql = "UPDATE student_activity SET cgpa= '$cgpa', faculty ='$faculty', university= '$university', national='$national', international='$international' WHERE st_act_id = " . $id;

            $status = update_DBTable($conn, $sql);

            if ($status) {
                echo "Form data updated successfully!<br>";
                echo '<a href="student_activity.php">Back</a>';
            } else {
                echo '<a href="javascript:history.back()">Back</a>';
            }
        
    } else {
        echo "Error fetching previous image file path: " . mysqli_error($conn) . "<br>";
        echo '<a href="javascript:history.back()">Back</a>';
    }


//close db connection
mysqli_close($conn);

//Function to insert data into the database table
function update_DBTable($conn, $sql)
{
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . $sql . " : " . mysqli_error($conn) . "<br>";
        return false;
    }
}
?>
