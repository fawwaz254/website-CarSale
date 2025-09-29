<?php
	session_start();
	if(!(isset($_SESSION['name'])&&isset($_SESSION['email'])))
	{
    	header('Location: register.php');
	}
	include "includes/dbconnect.php";

	$product_id = $_POST['product_id'];
	$user_id = $_SESSION['user_id'];
	$review_heading = $_POST['review_heading'];
	$review_text = $_POST['review_text'];
	$rating = $_POST['rating'];

	$query = "INSERT INTO reviews (product_id, user_id, review_heading, review_text, rating) VALUES ('$product_id', '$user_id', '$review_heading', '$review_text', '$rating')";
	$result = mysqli_query($connection, $query);

	if($result)
	{
		header('Location: product_description.php?product_id=' . $product_id . '&msg=1');
	}
	else
	{
		header('Location: product_description.php?product_id=' . $product_id . '&msg=2');
	}
?>
