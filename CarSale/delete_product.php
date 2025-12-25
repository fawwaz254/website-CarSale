<?php
	session_start();
	if(!(isset($_SESSION['name'])&&isset($_SESSION['email'])))
  	{
    	header('Location: register.php');
  	}
	include "includes/dbconnect.php";
	$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : $_POST['product_id'];

	$query="DELETE FROM `carsale`.`products` WHERE `product_id` = '$product_id'";
	if (mysqli_query($connection,$query))
	{
		header('Location: admin_products.php?msg=11');
	}
	else
	{
		header('Location: admin_products.php?msg=22');
	}
?>
