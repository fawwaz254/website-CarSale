<?php
session_start();
if (isset($_SESSION['name']) && isset($_SESSION['email'])) {
    header('Location: products.php');
    exit();
}

if (!(isset($_POST['user_email']) && isset($_POST['user_password']))) {
    header('Location: index.php');
    exit();
}

include "includes/dbconnect.php";

$email = trim($_POST['user_email']);
$password = $_POST['user_password'];

// Validasi sisi server
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: index.php?msg=Format email tidak valid');
    exit();
}

if (empty($password)) {
    header('Location: index.php?msg=Kata sandi tidak boleh kosong');
    exit();
}

// Gunakan prepared statement untuk query
$stmt = $connection->prepare("SELECT * FROM `users` WHERE `email` = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    // Verifikasi password yang di-hash atau plain untuk admin
    $password_valid = false;
    if ($row['email'] == "admin@carsale.com" && $password == "1234") {
        $password_valid = true;
    } elseif (password_verify($password, $row['password'])) {
        $password_valid = true;
    }

    if ($password_valid) {
        $_SESSION['name'] = $row['name'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['user_id'] = $row['user_id'];

        // Cek admin
        if ($row['email'] == "admin@carsale.com") {
            header('Location: admin.php');
        } else {
            header('Location: products.php');
        }
        exit();
    } else {
        header('Location: index.php?msg=Kata sandi salah');
        exit();
    }
} else {
    header('Location: index.php?msg=Email tidak ditemukan');
    exit();
}
?>
