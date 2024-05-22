<?php
session_start();
// middle ware kw LOL
// jika tidak ada username di session
if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin') {
} 
else { // jika tidak di penuhi Maka redirect ke :
    header("Location: index.php");
}

include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = "admin"; // Set role sebagai admin

    // Query untuk menambahkan admin baru
    $query = "INSERT INTO `user` (`username`, `password`, `role`) VALUES ('$username', '$password', '$role')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Admin berhasil ditambahkan
        header("Location: admin.php"); // Redirect ke halaman daftar admin
        exit();
    } else {
        // Gagal menambahkan admin
        echo "Gagal menambahkan admin.";
    }
}

mysqli_close($koneksi);
?>
