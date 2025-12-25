<?php
session_start();
if(!(isset($_SESSION['name'])&&isset($_SESSION['email']))) {
    header('Location: register.php');
}
include "includes/dbconnect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_id = $_POST['request_id'];
    $status = $_POST['status'];

    $query = "UPDATE requests SET status = '$status', updated_at = NOW() WHERE id = '$request_id'";
    if (mysqli_query($connection, $query)) {
        header('Location: admin_requests.php?msg=update_success');
    } else {
        header('Location: admin_requests.php?msg=update_failed');
    }
} else {
    header('Location: admin_requests.php');
}
?>
