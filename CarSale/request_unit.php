<?php
session_start();
if(!(isset($_SESSION['name'])&&isset($_SESSION['email']))) {
    header('Location: register.php');
}
include "includes/dbconnect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $user_message = mysqli_real_escape_string($connection, $_POST['user_message']);
    $user_phone = mysqli_real_escape_string($connection, $_POST['user_phone']);
    $status = 'pending';

$query = "INSERT INTO requests (user_id, product_id, user_message, user_phone, status) VALUES ('$user_id', '$product_id', '$user_message', '$user_phone', '$status')";
    if (mysqli_query($connection, $query)) {
        header("Location: product_description.php?product_id=$product_id&msg=request_success");
    } else {
        header("Location: product_description.php?product_id=$product_id&msg=request_failed");
    }
} else {
    header('Location: products.php');
}
?>
