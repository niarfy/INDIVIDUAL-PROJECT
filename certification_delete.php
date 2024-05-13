<?php
include('config.php');

if (isset($_GET["id"]) && $_GET["id"] != "") {
    $id = $_GET["id"];

        // Delete the record
        $deleteQuery = "DELETE FROM certification WHERE cert_id=" . $id;

        if (mysqli_query($conn, $deleteQuery)) {
            echo "Record deleted successfully<br>";

            // Check if there is an associated image file and delete it
            if (!empty($imagePath) && file_exists("uploads/" . $imagePath)) {
                unlink("uploads/" . $imagePath);
                echo "Image file deleted successfully<br>";
            }

            echo '<a href="certification.php">Back</a>';
        } else {
            echo "Error deleting record: " . mysqli_error($conn) . "<br>";
            echo '<a href="certification.php">Back</a>';
        }
    } else {
        echo "Error fetching image file path: " . mysqli_error($conn) . "<br>";
        echo '<a href="certification.php">Back</a>';
    }

mysqli_close($conn);
?>
