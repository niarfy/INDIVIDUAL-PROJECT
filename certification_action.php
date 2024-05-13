<?php
include('config.php');

// Variables
$action = "";
$id = "";
$kpi = "";

// This block is called when the Submit button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Values for add or edit
    $kpi = trim($_POST["kpi"]);
    // SQL query for inserting data into the database
    $sql = "INSERT INTO certification (kpi)
            VALUES ('" . $kpi . "')";

    // Insert data into the database table
    $status = insertTo_DBTable($conn, $sql);

    if ($status) {
        echo "Form data saved successfully!<br>";
        echo '<a href="certification.php">Back</a>';
    } else {
        echo '<a href="certification.php">Back</a>';
    }
}

// Close the database connection
mysqli_close($conn);

// Function to insert data into the database table
function insertTo_DBTable($conn, $sql)
{
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . $sql . " : " . mysqli_error($conn) . "<br>";
        return false;
    }
}
?>
