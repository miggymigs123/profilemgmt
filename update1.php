<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "CRUDE");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $childId = $_POST['child_id'];
    $childFirstName = $_POST['child_first_name'];
    $childLastName = $_POST['child_last_name'];
    $address = $_POST['address'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $parentName = $_POST['parent_name'];
    $contact = $_POST['contact'];
    $medical = $_POST['medical'];

    $update_query = "UPDATE ChildInfo SET 
        ChildFirstName = '$childFirstName', 
        ChildLastName = '$childLastName', 
        Address = '$address', 
        Birthdate = '$birthdate', 
        Sex = '$gender', 
        ParentName = '$parentName', 
        ParentContactNumber = '$contact', 
        MedicalNotes = '$medical' 
    WHERE ChildID = '$childId'";

    if (mysqli_query($connection, $update_query)) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Failed to update record."));
    }

    mysqli_close($connection);
}
?>