<?php
session_start();
include("config.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,  initial-scale=1.0">
    <title>Individual Assignment My Study KPI</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>
</head>
<body>
    <div class="header">
        <h1>Profile</h1>
    </div>
    
    <?php
    $currentPage = 'profile.php'; 
    if(isset($_SESSION["UID"])){
        include 'logged_menu.php';
    }
    else {
        include 'menu.php';
    }
    ?>

    <?php
    $loggedInUserID = $_SESSION["UID"];
    //query the user and profile table for this user
    $sql = "SELECT user.*, profile.* FROM user
        INNER JOIN profile ON user.userID = profile.userID
        WHERE user.userID = $loggedInUserID";

    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $matricNo = $row["matricNo"];
        $userEmail = $row["userEmail"];
        $username = $row["username"];
        $program = $row["program"];
        $intake = $row["intake"];
        $phone = $row["phone"];
        $mentor = $row["mentor"];
        $state = $row["state"];
        $address = $row["address"];
        $motto = $row["motto"];
    }
    ?>

    <div class="row">
        <div class="col-left">
        <img class="image" src="<?=$row['profile_photo']?>" alt="Profile Photo">
           
        </div>
        <div class="col-right"> 
            <div style="text-align: right; padding-bottom:5px;">
                <a href="profile_edit.php">Edit</a>
            </div>
            <table border="1" width="100%" style="border-collapse: collapse;">
                <tr>
                    <td width="164">Name</td>
                    <td><?=$username?></td>
                </tr>
                <tr>
                    <td width="164">Matric No.</td>
                    <td><?=$matricNo?></td>
                </tr>
                <tr>
                    <td width="164">Email</td>
                    <td><?=$userEmail?></td>
                </tr>
                <tr>
                    <td width="164">Program</td>
                    <td><?=$program?></td>
                </tr>
                <tr>
                    <td width="164">Intake Batch</td>
                    <td><?=$intake?></td>
                </tr>
                <tr>
                    <td width="164">Phone No</td>
                    <td><?=$phone?></td>
                </tr>
                <tr>
                    <td width="164">Mentor Name</td>
                    <td><?=$mentor?></td>
                </tr>
                <tr>
                    <td width="164">State Origin</td>
                    <td><?=$state?></td>
                </tr>
                <tr>
                    <td width="164">Home Address</td>
                    <td><?=$address?></td>
                </tr>
            </table>
            <p>My Study Motto</p>
            <table border="1" width="100%" style="border-collapse: collapse">
                <tr>
                    <td width = "164">
                        <?php
                        if($motto==""){
                            echo "&nbsp;";
                        }
                        else{
                            echo $motto;
                        }

                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <footer>
        <p>Copyright (c) 2023 - Nur Irfani Ammtullah</p>
    </footer>
</body>
</html>


