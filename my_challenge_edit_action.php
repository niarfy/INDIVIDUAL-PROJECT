<?php
session_start();
include('config.php');

//variables
$action="";
$id="";
$sem = "";
$year = "";
$challenge =" ";
$remark = "";

//for upload
$target_dir = "uploads/";
$target_file = "";
$uploadOk = 0;
$imageFileType = "";
$uploadfileName = "";

//this block is called when button Submit is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //values for add or edit
    $id = $_POST["cid"];
    $sem = $_POST["sem"];
    $year = $_POST["year"];
    $challenge = trim($_POST["challenge"]);
    $plan = trim($_POST["plan"]);
    $remark = trim($_POST["remark"]);

    $filetmp = $_FILES["fileToUpload"];
    //file of the image/photo file
    $uploadfileName = $filetmp["name"];

    //Check if there is an image to be uploaded
    //IF no image
    if(isset($_FILES["fileToUpload"]) &&  $_FILES["fileToUpload"]["name"] == ""){
        $sql = "UPDATE challenge SET sem= $sem, year ='$year', challenge = '$challenge', 
            plan = '$plan', remark = '$remark' , img_path = '$uploadfileName' WHERE ch_id =" . $id . " AND userID = ". $_SESSION["UID"];

        $status = update_DBTable($conn, $sql);

        if ($status) {
            echo "Form data updated successfully!<br>";
            echo '<a href="my_challenge.php">Back</a>';             
        } else {
            echo '<a href="my_challenge.php">Back</a>';
        }   
    }
    // Check if there is an image to be uploaded
    else if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK) {
        // Variable to determine if image upload is OK
        $uploadOk = 1;
        $filetmp = $_FILES["fileToUpload"];

        // File of the image/photo file
        $uploadfileName = $filetmp["name"];
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "ERROR: Sorry, image file $uploadfileName already exists.<br>";
            $uploadOk = 0;
        }

        // Check file size <= 488.28KB or 500000 bytes
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "ERROR: Sorry, your file is too large. Try resizing your image.<br>";
            $uploadOk = 0;
        }

            // Allow only these file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "ERROR: Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
                $uploadOk = 0;
            }

            // If uploadOk, then try to add to the database first
            if ($uploadOk) {
                $sql = "UPDATE challenge SET sem= $sem, year ='$year', challenge = '$challenge',  
                plan = '$plan', remark = '$remark' , img_path = '$uploadfileName' WHERE ch_id =" . $id . " AND userID = ". $_SESSION["UID"];

                $status = update_DBTable($conn, $sql);

                if ($status) {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        //Image file successfully uploaded                    
                        
                        //Tell successfull record
                        echo "Form data updated successfully!<br>";
                        echo '<a href="my_challenge.php">Back</a>'; 
                    } 
                    else{
                        //There is an error while uploading image 
                        echo "Sorry, there was an error uploading your file.<br>";  
                        echo '<a href="javascript:history.back()">Back</a>';              
                    }
                } 
                else {
                    echo '<a href="javascript:history.back()">Back</a>';
                }
            }
            else{            
                echo '<a href="javascript:history.back()">Back</a>';
            }
        }    
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
