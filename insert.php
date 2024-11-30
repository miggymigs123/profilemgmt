<?php
session_start();
$connection = mysqli_connect("Localhost","root","","CRUDE");

if(isset ($_POST['savedata']))
{


$ChildFirstName = $_POST['ChildFirstName'];
$ChildLastName = $_POST['ChildLastName'];
$ChildLastName = $_POST['ChildLastName'];
$Address = $_POST['Address'];
$Birthdate = $_POST['Birthdate'];
$Gender = $_POST['Gender'];
$ParentGuardianName = $_POST['ParentName'];
$ParentGuardianPhoneNumber = $_POST['ContactNumber'];
$MedicalNotes = $_POST['MedicalNotes'];

$insert_query = "INSERT INTO ChildInfo(ChildFirstName, ChildLastName, Address, Birthdate, Sex, ParentName, ParentContactNumber, MedicalNotes)  values ('$ChildFirstName', '$ChildLastName','$Address','$Birthdate ',' $Gender', '$ParentGuardianName','$ParentGuardianPhoneNumber','$MedicalNotes')";
  $insert_query_run = mysqli_query($connection, $insert_query);
  

  if($insert_query_run)
  {
    $_SESSION['status'] ="Data Inserted Successfully!!";
     header('location: profilemgmt.php');
  }
  else
 {
     $_SESSION['status'] ="Data Inserted Uncessful!!";
      header('location: profilemgmt.php');
 }


  }

  



?>