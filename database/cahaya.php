<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data_cahaya";

// Periksa apakah $_GET["ldr_value"] sudah diatur atau belum
if (isset($_GET["ldr_value"])) {
    // Ambil nilai ldr_value
    $ldr_value = $_GET["ldr_value"];

    // Buat koneksi ke database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Gunakan prepared statement untuk mencegah SQL Injection
    $sql = "INSERT INTO data_cahaya (ldr_value) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ldr_value);

    if ($stmt->execute()) {
        echo "DATA LDR VALUE BERHASIL DITAMBAH";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();
    exit();
} else {
    echo "LDR Value tidak ditemukan dalam parameter.";
}
