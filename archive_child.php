<?php
require 'pedia3xv2_DB.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $childId = $_POST['child_id'];

    $update_query = "UPDATE ChildInfo SET Status = 'archived' WHERE ChildID = '$childId'";

    if (mysqli_query($connection, $update_query)) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Failed to archive record."));
    }

    mysqli_close($connection);
}
?>