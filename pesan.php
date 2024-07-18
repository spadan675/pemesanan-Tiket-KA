<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tiket_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO pemesanan (nama, email, jumlah_tiket) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $nama, $email, $jumlah_tiket);

// Set parameters and execute
$nama = $_POST['nama'];
$email = $_POST['email'];
$jumlah_tiket = $_POST['jumlah_tiket'];

if ($stmt->execute()) {
    echo "Pemesanan berhasil!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
