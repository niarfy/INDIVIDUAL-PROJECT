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
    <h1>Certification</h1> 
</div> 
 
<?php include 'menu.php';?> 
 
<h2>Certification</h2> 
 
<?php 
    $id = "";  
    $kpi = ""; 
 
    if(isset($_GET["id"]) && $_GET["id"] != ""){ 
        $sql = "SELECT * FROM certification WHERE cert_id=" . $_GET["id"]; 
        //echo $sql . "<br>"; 
        $result = mysqli_query($conn, $sql); 
             
        if (mysqli_num_rows($result) > 0) { 
            $row = mysqli_fetch_assoc($result); 
            $id = $row["cert_id"];  
            $kpi = $row["kpi"]; 
        }         
    } 
    mysqli_close($conn); 
?> 
 
<div style="padding:0 10px;" id="certificationDiv"> 
    <h3 align="center">Edit Certification</h3> 
    <p align="center">Required field with mark*</p> 

    <!--action file where the form will be submitted is to certification_edit_action.php.  -->
    <form method="POST" action="certification_edit_action.php" id="myForm" enctype="multipart/form-data"> 
        
    <!--hidden value: id to be submitted to action page-->
        <!--This line creates a text field that is hidden (not displayed in the browser) and holds a 
            value of the record id that is submitted to this PHP to be edited. In the next lab, this 
            id may be changed to use session (for security reasons).
        -->
        <input type="text" id="cid" name="cid" value="<?=$_GET['id']?>" hidden> 
        <table border="1" id="myTable">             
            <tr> 
                <td>MyKPI*</td> 
                <td>:</td> 
                <td>
                <textarea rows="4" name="kpi" cols="20"><?php  echo $kpi;?></textarea> 
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
