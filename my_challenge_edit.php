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
<body onLoad="show_AddEntry()">
<div class="header"> 
    <h1>My Challenge</h1> 
</div> 
 
<?php
$currentPage = 'my_challenge.php'; 
    if(isset($_SESSION["UID"])){
        include 'logged_menu.php';
    }
    else {
        //include 'menu.php';
        header("location:about_me.php");
    }
?>
 
<h2>List of Challenge and Plan</h2> 
 
<?php 
    $id = ""; 
    $sem = ""; 
    $year = ""; 
    $challenge =" ";
    $plan = ""; 
    $remark = ""; 
    $img = ""; 
 
    if(isset($_GET["id"]) && $_GET["id"] != ""){ 
        $id = $_GET["id"];
        $userID = $_SESSION["UID"];
        $sql = "SELECT * FROM challenge WHERE ch_id= $id AND userID = $userID";
        //echo $sql . "<br>"; 
        $result = mysqli_query($conn, $sql); 
             
        if (mysqli_num_rows($result) > 0) { 
            $row = mysqli_fetch_assoc($result); 
            $id = $row["ch_id"]; 
            $sem = $row["sem"]; 
            $year = $row["year"]; 
            $challenge = $row["challenge"]; 
            $plan = $row["plan"]; 
            $remark = $row["remark"]; 
            $img = $row["img_path"]; 
        }         
    } 
    mysqli_close($conn); 
?> 
 
<div style="padding:0 10px;" id="challengeDiv"> 
    <h3 align="center">Edit Challenge and Plan</h3> 
    <p align="center">Required field with mark*</p> 

    <!--action file where the form will be submitted is to my_challenge_edit_action.php.  -->
    <form method="POST" action="my_challenge_edit_action.php" id="myForm" enctype="multipart/form-data"> 
        
    <!--hidden value: id to be submitted to action page-->
        <!--This line creates a text field that is hidden (not displayed in the browser) and holds a 
            value of the record id that is submitted to this PHP to be edited. In the next lab, this 
            id may be changed to use session (for security reasons).
        -->
        <input type="hidden" id="cid" name="cid" value="<?=$_GET['id']?>">
        <table border="1" id="myTable">             
            <tr> 
                <td>Semester*</td> 
                <td width="1px">:</td> 
                <td> 
                    <select size="1" name="sem" id="sem" required>                         
                    <option value="">&nbsp;</option> 
                    <?php 
                    if($sem=="1") 
                        echo '<option value="1" selected>1</option>'; 
                    else 
                        echo '<option value="1">1</option>';
                    if($sem=="2") 
                        echo '<option value="2" selected>2</option>'; 
                    else 
                        echo '<option value="2">2</option>'; 
                    ?> 
                    </select> 
                </td> 
            </tr> 
            <tr> 
                <td>Year*</td> 
                <td>:</td> 
                <td> 
                    <?php 
                    if($year!=""){ 
                        echo '<input type="text" name="year" size="5" value="' . $year . '" required>'; 
                    } 
                    else { 
                    ?> 
                        <input type="text" name="year" size="5" required> 
                    <?php 
                    } 
                    ?>                 
                </td> 
            </tr> 
            <tr> 
                <td>Challenge*</td> 
                <td>:</td> 
                <td> 
                    <textarea rows="4" name="challenge" cols="20" required><?php echo $challenge;?></textarea> 
                </td> 
            </tr> 
            <tr> 
                <td>Plan*</td> 
                <td>:</td> 
                <td> 
                    <textarea rows="4" name="plan" cols="20" required><?php echo $plan;?></textarea> 
                </td> 
            </tr> 
            <tr> 
                <td>Remark</td> 
                <td>:</td> 
                <td>
                <textarea rows="4" name="remark" cols="20"><?php  echo $remark;?></textarea> 
                </td> 
            </tr> 
            <tr> 
                <td>Photo</td> 
                <td>:</td> 
                <td> 
                    <input type="text" disabled value="<?=$img;?>"> 
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
                <input type="reset" value="Reset" name="B2" onclick="resetForm()"> 
                <input type="button" value="Clear" name="B3" onclick="clearForm()"> 
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
 
//reset form after modification to a php echo to fields 
function resetForm() { 
    document.getElementById("myForm").reset(); 
} 
 
//this clear form to empty the form for new data 
function clearForm() { 
    var form = document.getElementById("myForm"); 
    if (form) { 
        var inputs = form.getElementsByTagName("input"); 
        var textareas = form.getElementsByTagName("textarea"); 
 
        //clear select 
        form.getElementsByTagName("select")[0].selectedIndex=0;         
         
        //clear all inputs 
        for (var i = 0; i < inputs.length; i++) { 
            if (inputs[i].type !== "button" && inputs[i].type !== "submit" && inputs[i].type !== "reset") { 
                 inputs[i].value = ""; 
            } 
        } 
 
        //clear all textareas 
        for (var i = 0; i < textareas.length; i++) { 
            textareas[i].value = ""; 
        } 
    } else { 
        console.error("Form not found"); 
    } 
} 

function show_AddEntry() {  
    var x = document.getElementById("challengeDiv");
    x.style.display = 'block';
    var firstField = document.getElementById('sem');
    firstField.focus();
}
</script>
</body>
</html>
   
