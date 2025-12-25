<?php
session_start();
if (!(isset($_POST['user_name']) && isset($_POST['user_email']) && isset($_POST['user_password']) && isset($_POST['user_confirm_password']))) {
    header('Location: register.php?msg=' . urlencode('Form tidak lengkap'));
    exit();
}

include "includes/dbconnect.php";

$name = trim($_POST['user_name']);
$email = trim($_POST['user_email']);
$password = $_POST['user_password'];
$confirm_password = $_POST['user_confirm_password'];

// Validasi sisi server
if (empty($name)) {
    header('Location: register.php?msg=' . urlencode('Nama tidak boleh kosong'));
    exit();
}

if (!preg_match('/^[^\s@]+@gmail\.com$/', $email)) {
    header('Location: register.php?msg=' . urlencode('Format email tidak valid'));
    exit();
}

if (strlen($password) < 8) {
    header('Location: register.php?msg=' . urlencode('Kata sandi harus minimal 8 karakter'));
    exit();
}

if ($password !== $confirm_password) {
    header('Location: register.php?msg=' . urlencode('Konfirmasi kata sandi tidak cocok'));
    exit();
}

// Cek apakah email sudah terdaftar
$stmt = $connection->prepare("SELECT * FROM `users` WHERE `email` = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result1 = $stmt->get_result();

if ($result1->num_rows == 0) {
    // Hash password sebelum disimpan
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data ke database menggunakan prepared statement
    $stmt = $connection->prepare("INSERT INTO `users` (`name`, `email`, `password`) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashed_password);

    if ($stmt->execute()) {
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;

        // Ambil user_id
        $stmt = $connection->prepare("SELECT `user_id` FROM `users` WHERE `email` = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result1 = $stmt->get_result();
        $row1 = $result1->fetch_assoc();
        $_SESSION['user_id'] = $row1['user_id'];

        header('Location: products.php');
        exit();
    } else {
        header('Location: register.php?msg=' . urlencode('Terjadi kesalahan saat menyimpan data'));
        exit();
    }
} elseif ($result1->num_rows == 1) {
    header('Location: register.php?msg=' . urlencode('Email Pengguna Sudah Digunakan!'));
    exit();
} else {
    header('Location: register.php?msg=' . urlencode('Terjadi kesalahan tidak terduga'));
    exit();
}
