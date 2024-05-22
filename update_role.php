<?php
include('koneksi.php');
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $id = $_POST["id"];
    $new_role = $_POST["new_role"];

    // Query untuk update role
    $query = "UPDATE `user` SET `role` = '$new_role' WHERE `id` = '$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Role berhasil diubah
// buat notifikasi
$_SESSION['eror_msg'] = [
    'type' => 'notif',
    'msg' => 'Role '. $username .' berhasil diubah! menjadi '. $new_role. '!',
];
        header("Location: admin.php");
        exit();
    } else {
        // Gagal mengubah role
        // Set error message
$_SESSION['eror_msg'] = [
    'type' => 'error',
    'msg' => 'gagal merubah role '. $username .'!',
];
        header("Location: admin.php");
        exit();
    }
}

mysqli_close($koneksi);
?>
