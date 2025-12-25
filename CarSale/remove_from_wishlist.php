<?php
session_start();
if(!(isset($_SESSION['name'])&&isset($_SESSION['email']))) {
    header('Location: register.php');
}
include "includes/dbconnect.php";

if(isset($_GET['wishlist_id'])) {
    $wishlist_id = mysqli_real_escape_string($connection, $_GET['wishlist_id']);
    $user_id = $_SESSION['user_id'];

    // Ensure the wishlist item belongs to the user
    $query = "DELETE FROM wishlist WHERE wishlist_id = '$wishlist_id' AND user_id = '$user_id'";
    if(mysqli_query($connection, $query)) {
        header('Location: view_wishlist.php?msg=removed');
    } else {
        header('Location: view_wishlist.php?msg=error');
    }
} else {
    header('Location: view_wishlist.php');
}
?>
