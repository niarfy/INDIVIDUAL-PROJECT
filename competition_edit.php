<?php 
include("config.php"); 
?> 
<!DOCTYPE html> 
<html> 
 
<head> 
<title>Individual Assignment My Study KPI</title> 
    <link rel="stylesheet" href="css/style.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">    
</head> 
<body> 
<div class="header"> 
    <h1>Competition</h1> 
</div> 
 
<?php include 'menu.php';?> 
 
<h2>Competition KPI</h2> 
 
<?php 
    $id = ""; 
    $faculty = ""; 
    $university =" ";
    $national = ""; 
    $international = ""; 
 
    if(isset($_GET["id"]) && $_GET["id"] != ""){ 
        $sql = "SELECT * FROM competition WHERE comp_id=" . $_GET["id"]; 
        //echo $sql . "<br>"; 
        $result = mysqli_query($conn, $sql); 
             
        if (mysqli_num_rows($result) > 0) { 
            $row = mysqli_fetch_assoc($result); 
            $id = $row["comp_id"];  
            $faculty = $row["faculty"]; 
            $university = $row["university"]; 
            $national = $row["national"]; 
            $international = $row["international"]; 
        }         
    } 
    mysqli_close($conn); 
?> 
 
<div style="padding:0 10px;" id="competitionDiv"> 
    <h3 align="center">Edit Competition</h3> 
    <p align="center">Required field with mark*</p> 

    <!--action file where the form will be submitted is to competition_edit_action.php.  -->
    <form method="POST" action="competition_edit_action.php" id="myForm" enctype="multipart/form-data"> 
        
    <!--hidden value: id to be submitted to action page-->
        <!--This line creates a text field that is hidden (not displayed in the browser) and holds a 
            value of the record id that is submitted to this PHP to be edited. In the next lab, this 
            id may be changed to use session (for security reasons).
        -->
        <input type="text" id="cid" name="cid" value="<?=$_GET['id']?>" hidden> 
        <table border="1" id="myTable">             
            <tr> 
                <td>Faculty Level*</td> 
                <td>:</td> 
                <td> 
                    <textarea rows="4" name="faculty" cols="20" required><?php echo $faculty;?></textarea> 
                </td> 
            </tr> 
            <tr> 
                <td>University Level*</td> 
                <td>:</td> 
                <td> 
                    <textarea rows="4" name="university" cols="20" required><?php echo $university;?></textarea> 
                </td> 
            </tr> 
            <tr> 
                <td>National Level*</td> 
                <td>:</td> 
                <td>
                <textarea rows="4" name="national" cols="20"><?php  echo $national;?></textarea> 
                </td> 
            </tr> 
            <tr> 
                <td>International Level*</td> 
                <td>:</td> 
                <td>
                <textarea rows="4" name="international" cols="20"><?php  echo $international;?></textarea> 
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
</script> 
</body> 
</html>     
