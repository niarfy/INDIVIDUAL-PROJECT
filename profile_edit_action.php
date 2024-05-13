<?PHP
session_start();
include('config.php');

//check if logged-in
if(!isset($_SESSION["UID"])){
    header("location:about_me.php"); 
}

//this block is called when button Submit is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loggedInUserID = $_SESSION["UID"];//add this
    $username = $_POST["username"];
    $program = $_POST["program"];
    $intake = $_POST["intake"];
    $phone = $_POST["phone"];
    $mentor = $_POST["mentor"];
    $state = $_POST["state"];
    $address = $_POST["address"];
    $motto = $_POST["motto"];

    // Handle file upload
    $target_dir = "uploads/"; // Change this to your desired upload directory
    $target_file = $target_dir . basename($_FILES["profile_photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["profile_photo"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
            // Handle error if the uploaded file is not an image
        }
    }

    // Check file size
    if ($_FILES["profile_photo"]["size"] > 500000) {
        $uploadOk = 0;
        // Handle error if the uploaded file is too large
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        $uploadOk = 0;
        // Handle error if the file format is not allowed
    }

    if ($uploadOk == 1) {
       if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $target_file)) {
           echo "File has been uploaded successfully. ";
           // Update the database with the file path
           $sql = "UPDATE profile SET profile_photo = '$target_file' WHERE userID = $loggedInUserID";
           if (mysqli_query($conn, $sql)) {
               echo "Database updated successfully. ";
           } else {
               echo "Error updating database: " . mysqli_error($conn);
           }
       } else {
           echo "Error moving the file. ";
       }
   } else {
       echo "File upload failed. ";
   }

   // SQL to update the profile table
   $sql = "UPDATE profile 
           SET username = '$username', 
               program = '$program',
               intake = '$intake',
               phone = '$phone',
               mentor = '$mentor',
               state = '$state',
               address = '$address',
               motto = '$motto' 
           WHERE userID = $loggedInUserID";
    echo $sql . "<br>";

    if (mysqli_query($conn, $sql)) {
        echo "Form data updated successfully!<br>";
        echo '<a href="profile.php">Back</a>'; 
    } else {
        echo "Error: " . $sql . " : " . mysqli_error($conn) . "<br>";
        echo '<a href="javascript:history.back()">Back</a>';
    }
}
//close db connection
mysqli_close($conn);
?>
