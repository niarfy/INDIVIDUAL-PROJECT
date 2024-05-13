<?php
include('config.php');

//variables
$action="";
$id = ""; 
$kpi = ""; 

//this block is called when button Submit is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //values for add or edit
    $id = $_POST["cid"];
    $kpi = trim($_POST["kpi"]);

    
            // No new image uploaded, update other form data without changing the image
            $sql = "UPDATE certification SET  kpi='$kpi' WHERE cert_id = " . $id;

            $status = update_DBTable($conn, $sql);

            if ($status) {
                echo "Form data updated successfully!<br>";
                echo '<a href="certification.php">Back</a>';
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
