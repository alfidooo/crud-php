<?php
include "config.php";
// Mulai session
session_start();

// Hapus semua variabel session
session_unset();

// Hancurkan session
session_destroy();

// Redirect ke halaman login atau beranda
header("Location: login.php"); // Ganti 'login.php' dengan halaman yang diinginkan
exit;
?>