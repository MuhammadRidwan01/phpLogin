<?php
session_start();
include('koneksi.php');
$id_akun = $_SESSION['id_akun'];
$username = $_SESSION['username'];
// menghapus akun di tabel User
$query_akun = "DELETE FROM user WHERE `user`.`id` = '$id_akun'";
$result_akun = mysqli_query($koneksi, $query_akun);

if ($result_akun) {
    // menghapus akun di tabel ridwan
    $query_ridwan = "DELETE FROM ridwan WHERE `ridwan`.`id_akun` = '$id_akun'";
    $result_ridwan = mysqli_query($koneksi, $query_ridwan);

    if ($result_ridwan) {
        // Memindahkan halaman ke:
        session_destroy();
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $query_ridwan . "<br>" . mysqli_error($koneksi);
    }
} else {
    echo "Error: " . $query_akun . "<br>" . mysqli_error($koneksi);
}

// Menutup koneksi
mysqli_close($koneksi);
?>
