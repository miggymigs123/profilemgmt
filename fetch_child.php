<?php
$connection = mysqli_connect("localhost", "root", "", "CRUDE");

if (isset($_POST['child_id'])) {
    $child_id = $_POST['child_id'];
    $query = "SELECT * FROM ChildInfo WHERE ChildID = '$child_id'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $child_data = mysqli_fetch_assoc($result);
        echo json_encode($child_data);
    } else {
        echo json_encode(["status" => "error", "message" => "No record found."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid ID."]);
}

mysqli_close($connection);
?>