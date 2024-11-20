<?php
    // membuat koneksi kedatabase
    $server = "localhost"; // bisa juga pake 127.0.0.1
    $username = "root";
    $password = "";
    $dbname = "blog";

    // urutannya server, username, password, nama database
    $conn = mysqli_connect($server, $username, $password, $dbname);
    // cek apakah sudah terhubung ke database atau belum
    // if (!$conn) {
    //     echo "Koneksi Gagal!";
    // }
    // echo "berhasil terhubung";
    session_start();
?>