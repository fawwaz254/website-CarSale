<?php

// ===========================
// Helper Functions
// ===========================
function post_request($url, $postData)
{
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postData,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => true,
        CURLOPT_FOLLOWLOCATION => false,
    ]);

    $response = curl_exec($curl);
    $info = curl_getinfo($curl);
    curl_close($curl);

    return [$info['http_code'], $response];
}

function get_request($url)
{
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => true,
        CURLOPT_FOLLOWLOCATION => false,
    ]);

    $response = curl_exec($curl);
    $info = curl_getinfo($curl);
    curl_close($curl);

    return [$info['http_code'], $response];
}


// ===========================
// Base Path
// ===========================
$BASE = "http://localhost/Web%20CarSale/CarSale";
$IMAGE = __DIR__ . "/test.jpg";

if (!file_exists($IMAGE)) {
    die("ERROR: test.jpg tidak ditemukan di folder ini!\n");
}


// ===============================================================
// 1. LOGIN TESTING (Admin, User, Password Salah, Email Tidak Ada)
// ===============================================================
echo "\n==================== LOGIN TESTING ====================\n";

// LOGIN ADMIN
echo "\n--- LOGIN ADMIN ---\n";
list($status, $resp) = post_request("$BASE/login_user.php", [
    "user_email" => "admin@carsale.com",
    "user_password" => "1234"
]);
echo "Status: $status\n$resp\n";

// LOGIN USER BIASA (HARUS ADA USER DI DATABASE)
echo "\n--- LOGIN USER ---\n";
list($status, $resp) = post_request("$BASE/login_user.php", [
    "user_email" => "user@example.com",       // GANTI sesuai database kamu
    "user_password" => "password_user_kamu"   // GANTI sesuai password asli
]);
echo "Status: $status\n$resp\n";

// PASSWORD SALAH
echo "\n--- LOGIN PASSWORD SALAH ---\n";
list($status, $resp) = post_request("$BASE/login_user.php", [
    "user_email" => "admin@carsale.com",
    "user_password" => "salah"
]);
echo "Status: $status\n$resp\n";

// EMAIL TIDAK ADA
echo "\n--- LOGIN EMAIL TIDAK ADA ---\n";
list($status, $resp) = post_request("$BASE/login_user.php", [
    "user_email" => "tidakada@example.com",
    "user_password" => "apaaja"
]);
echo "Status: $status\n$resp\n";

// ===============================================================
// 3. REGISTER TESTING (SESUAI IMPLEMENTASI ASLI)
// ===============================================================
echo "\n==================== REGISTER TESTING ====================\n";

// REGISTER BERHASIL
echo "\n--- REGISTER BERHASIL ---\n";
list($status, $resp) = post_request("$BASE/register_user.php", [
    "user_name"             => "Test User",
    "user_email"            => "testuser_" . time() . "@gmail.com",
    "user_password"         => "password123",
    "user_confirm_password" => "password123"
]);
echo "Status: $status\n$resp\n";

// REGISTER EMAIL SUDAH TERDAFTAR
echo "\n--- REGISTER EMAIL SUDAH TERDAFTAR ---\n";
list($status, $resp) = post_request("$BASE/register_user.php", [
    "user_name"             => "Duplicate User",
    "user_email"            => "admin@gmail.com", // SESUAI DATA DB
    "user_password"         => "password123",
    "user_confirm_password" => "password123"
]);
echo "Status: $status\n$resp\n";

// REGISTER PASSWORD TIDAK SAMA
echo "\n--- REGISTER PASSWORD TIDAK SAMA ---\n";
list($status, $resp) = post_request("$BASE/register_user.php", [
    "user_name"             => "Test User",
    "user_email"            => "mismatch_" . time() . "@gmail.com",
    "user_password"         => "password123",
    "user_confirm_password" => "password456"
]);
echo "Status: $status\n$resp\n";

// REGISTER EMAIL TIDAK VALID
echo "\n--- REGISTER EMAIL TIDAK VALID ---\n";
list($status, $resp) = post_request("$BASE/register_user.php", [
    "user_name"             => "Test User",
    "user_email"            => "test@yahoo.com",
    "user_password"         => "password123",
    "user_confirm_password" => "password123"
]);
echo "Status: $status\n$resp\n";

// REGISTER PASSWORD KURANG DARI 8 KARAKTER
echo "\n--- REGISTER PASSWORD TERLALU PENDEK ---\n";
list($status, $resp) = post_request("$BASE/register_user.php", [
    "user_name"             => "Test User",
    "user_email"            => "shortpass_" . time() . "@gmail.com",
    "user_password"         => "123",
    "user_confirm_password" => "123"
]);
echo "Status: $status\n$resp\n";

// ===============================================================
// 2. CRUD PRODUCT TESTING (Add, Update, Delete)
// ===============================================================
echo "\n==================== CRUD PRODUCT TESTING ====================\n";

// ADD PRODUCT
echo "\n--- ADD PRODUCT ---\n";
list($status, $resp) = post_request("$BASE/upload_product.php", [
    "product_name" => "Testing Product",
    "product_price" => "150000",
    "product_description" => "This is a test product",
    "product_category" => "Electric",
    "fuel_type" => "Battery",
    "image" => new CURLFile($IMAGE)
]);
echo "Status: $status\n$resp\n";

// UPDATE PRODUCT (Pastikan id=1 ada)
echo "\n--- UPDATE PRODUCT ---\n";
list($status, $resp) = post_request("$BASE/update_product.php", [
    "product_id" => 1,
    "product_name" => "Updated Product",
    "product_price" => "200000",
    "product_description" => "Updated description",
    "product_category" => "Hybrid",
    "fuel_type" => "Hybrid"
]);
echo "Status: $status\n$resp\n";

// DELETE PRODUCT
echo "\n--- DELETE PRODUCT ---\n";
list($status, $resp) = get_request("$BASE/delete_product.php?id=1");
echo "Status: $status\n$resp\n";

?>
