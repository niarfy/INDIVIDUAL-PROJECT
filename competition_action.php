<?php
include('config.php');

// Variables
$action = "";
$id = "";
$faculty = "";
$university = "";
$national = "";
$international = "";

// This block is called when the Submit button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Values for add or edit
    $faculty = trim($_POST["faculty"]);
    $university = trim($_POST["university"]);
    $national = trim($_POST["national"]);
    $international = trim($_POST["international"]);

    // SQL query for inserting data into the database
    $sql = "INSERT INTO competition (faculty, university, national, international)
            VALUES ('" . $faculty . "', '" . $university . "', '" . $national . "', '" . $international . "')";

    // Insert data into the database table
    $status = insertTo_DBTable($conn, $sql);

    if ($status) {
        echo "Form data saved successfully!<br>";
        echo '<a href="competition.php">Back</a>';
    } else {
        echo '<a href="competition.php">Back</a>';
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
