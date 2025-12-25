<?php
session_start();

if (!isset($_SESSION['name']) || !isset($_SESSION['email'])) {
    header("Location: register.php");
    exit;
}

include "includes/dbconnect.php";

// Pastikan semua field terkirim
if (
    !isset($_POST['product_id']) ||
    !isset($_POST['product_name']) ||
    !isset($_POST['product_price']) ||
    !isset($_POST['product_description']) ||
    !isset($_POST['product_category']) ||
    !isset($_POST['fuel_type'])
) {
    header("Location: admin_products.php?msg=3");
    exit;
}

$product_id          = intval($_POST['product_id']);
$product_name        = trim($_POST['product_name']);
$product_price       = trim($_POST['product_price']);
$product_description = trim($_POST['product_description']);
$product_category    = trim($_POST['product_category']);
$fuel_type           = trim($_POST['fuel_type']);

// ======================================================
//  VALIDASI HARDENED BACKEND
// ======================================================

// Nama produk wajib
if ($product_name === "" || strlen($product_name) < 2) {
    header("Location: admin_products.php?msg=3");
    exit;
}

// Harga wajib angka positif
if (!is_numeric($product_price) || floatval($product_price) < 1) {
    header("Location: edit_product.php?product_id=" . $product_id . "&msg=price_min");
    exit;
}


// Deskripsi wajib
if ($product_description === "") {
    header("Location: admin_products.php?msg=3");
    exit;
}

// Deskripsi maksimal 50 kata / 300 karakter
$wordCount = str_word_count($product_description);
if ($wordCount > 50 || strlen($product_description) > 300) {
    header("Location: admin_products.php?msg=3");
    exit;
}

// Kategori wajib
if ($product_category === "" || $product_category === null) {
    header("Location: admin_products.php?msg=3");
    exit;
}

// Fuel wajib
$validFuel = ["Petrol", "Diesel", "Electric", "Hybrid"];
if (!in_array($fuel_type, $validFuel)) {
    header("Location: admin_products.php?msg=3");
    exit;
}

// ======================================================
//  VALIDASI GAMBAR (Opsional Tapi Aman)
// ======================================================

$imageQueryPart = "";

if (!empty($_FILES['image']['name'])) {
    $filename  = basename($_FILES['image']['name']);
    $temp_name = $_FILES['image']['tmp_name'];

    $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowedExt)) {
        header("Location: admin_products.php?msg=3");
        exit;
    }

    // Pindahkan file 
    if (move_uploaded_file($temp_name, "images/" . $filename)) {
        $imageQueryPart = ", product_image='" . mysqli_real_escape_string($connection, $filename) . "'";
    } else {
        // Upload gagal
        header("Location: admin_products.php?msg=3");
        exit;
    }
}

// ======================================================
//  UPDATE DATABASE (AMAN PAKAI REAL_ESCAPE_STRING)
// ======================================================

$product_name        = mysqli_real_escape_string($connection, $product_name);
$product_price       = mysqli_real_escape_string($connection, $product_price);
$product_description = mysqli_real_escape_string($connection, $product_description);
$product_category    = mysqli_real_escape_string($connection, $product_category);
$fuel_type           = mysqli_real_escape_string($connection, $fuel_type);

$query = "
    UPDATE products SET
        product_name='$product_name',
        product_price='$product_price',
        product_description='$product_description',
        product_category='$product_category',
        fuel_type='$fuel_type'
        $imageQueryPart
    WHERE product_id=$product_id
";

// ======================================================
//  EKSEKUSI QUERY
// ======================================================

if (mysqli_query($connection, $query)) {
    header("Location: admin_products.php?msg=4"); // SUCCESS
} else {
    header("Location: admin_products.php?msg=3"); // FAILED
}

exit;
?>
