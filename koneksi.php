<?php
$servername = "localhost"; // Ganti dengan nama server database Anda jika berbeda
$username = "root"; // Ganti dengan nama pengguna database Anda
$password = ""; // Ganti dengan kata sandi database Anda
$dbname = "db_pesan"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $jumlah_tiket = $_POST['jumlah_tiket'];

    // Sertakan file koneksi database
    include 'db_connect.php';

    // Insert data pengguna jika belum ada
    $sql_check_user = "SELECT id FROM users WHERE email = '$email'";
    $result = $conn->query($sql_check_user);

    if ($result->num_rows == 0) {
        // Pengguna belum ada, insert pengguna baru
        $sql_insert_user = "INSERT INTO users (nama, email) VALUES ('$nama', '$email')";
        if ($conn->query($sql_insert_user) === TRUE) {
            $user_id = $conn->insert_id;
        } else {
            echo "Error: " . $sql_insert_user . "<br>" . $conn->error;
            exit();
        }
    } else {
        // Pengguna sudah ada, dapatkan user_id
        $row = $result->fetch_assoc();
        $user_id = $row['id'];
    }

    // Asumsikan jadwal_id dan booking_date untuk contoh ini
    $schedule_id = 1; // Ganti dengan id jadwal yang sesuai
    $booking_date = date("Y-m-d H:i:s");

    // Insert data pemesanan
    $sql_insert_booking = "INSERT INTO bookings (user_id, schedule_id, jumlah_tiket, booking_date) VALUES ('$user_id', '$schedule_id', '$jumlah_tiket', '$booking_date')";

    if ($conn->query($sql_insert_booking) === TRUE) {
        echo "Pemesanan berhasil. Kami akan menghubungi Anda melalui email.";
    } else {
        echo "Error: " . $sql_insert_booking . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
