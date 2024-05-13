<?php
session_start();
include('config.php');

if (isset($_GET["id"]) && $_GET["id"] != "") {
    $id = $_GET["id"];

    // Fetch the image file path before deleting the record
    $sqlSelect = "SELECT img_path FROM activities WHERE act_id = " . $id;
    $result = mysqli_query($conn, $sqlSelect);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $imageFileName = $row['img_path'];

        // Delete the image file if it exists
        if ($imageFileName) {
            $imagePath = 'uploads/' . $imageFileName;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    }
    $sql = "DELETE FROM activities WHERE act_id =" . $id . " AND userID=" . $_SESSION["UID"];
    //echo $sql . "<br>";
    
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully<br>";
        echo '<a href="my_activities.php">Back</a>';
     } else {
        echo "Error deleting record: " . mysqli_error($conn) . "<br>";
        echo '<a href="my_activities.php">Back</a>';
    }
}
mysqli_close($conn);
?>