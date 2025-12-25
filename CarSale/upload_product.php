<?php
	session_start();
	if(!(isset($_SESSION['name'])&&isset($_SESSION['email'])))
  	{
    	header('Location: register.php');
  	}
	include "includes/dbconnect.php";

	// Validations
	if (!isset($_POST['product_name']) || empty(trim($_POST['product_name'])) ||
	    !isset($_POST['product_price']) || empty(trim($_POST['product_price'])) ||
	    !isset($_POST['product_description']) || empty(trim($_POST['product_description'])) ||
	    !isset($_POST['product_category']) || empty(trim($_POST['product_category'])) ||
	    !isset($_POST['fuel_type']) || empty(trim($_POST['fuel_type']))) {
	    header('Location: admin_products.php?msg=3');
	    exit();
	}

	$product_price = trim($_POST['product_price']);
	if (!is_numeric($product_price) || $product_price <= 0) {
	    header('Location: admin_products.php?msg=3');
	    exit();
	}

	$product_description = trim($_POST['product_description']);
	if (str_word_count($product_description) > 50 || strlen($product_description) > 300) {
	    header('Location: admin_products.php?msg=3');
	    exit();
	}

	if (!isset($_FILES['image']) || $_FILES['image']['error'] != UPLOAD_ERR_OK) {
	    header('Location: admin_products.php?msg=3');
	    exit();
	}

	$mime = mime_content_type($_FILES['image']['tmp_name']);
	if (!str_starts_with($mime, 'image/')) {
	    header('Location: admin_products.php?msg=3');
	    exit();
	}

	if ($_FILES['image']['size'] > 5 * 1024 * 1024) { // 5MB
	    header('Location: admin_products.php?msg=3');
	    exit();
	}

	// Sanitize inputs
	$product_name = mysqli_real_escape_string($connection, trim($_POST['product_name']));
	$product_price = mysqli_real_escape_string($connection, $product_price);
	$product_description = mysqli_real_escape_string($connection, $product_description);
	$product_category = mysqli_real_escape_string($connection, trim($_POST['product_category']));
	$fuel_type = mysqli_real_escape_string($connection, trim($_POST['fuel_type']));

	$filename=$_FILES['image']['name'];
	$temp_name=$_FILES['image']['tmp_name'];
	if(move_uploaded_file($temp_name, "images/".$filename))
	{
		$query="INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_description`, `product_image`, `product_category`, `fuel_type`) VALUES (NULL, '$product_name', '$product_price', '$product_description', '$filename', '$product_category', '$fuel_type')";
		if(mysqli_query($connection,$query))
		{
			header('Location: admin_products.php?msg=1');
		}
	}
	else
	{
		header('Location: admin_products.php?msg=2');
	}


?>
