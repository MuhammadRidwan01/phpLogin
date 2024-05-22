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
    $id = $_POST["id"];

    // Query untuk hapus user
    $query = "DELETE FROM `user` WHERE `id` = '$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {

         $query = "DELETE FROM `ridwan` WHERE `id_akun` = $id";
    $result = mysqli_query($koneksi, $query);
        if ($result) {
            // User berhasil dihapus
            $_SESSION['eror_msg'] = [
                'type' => 'notif',
                'msg' => 'User berhasil dihapus!'];
                header("Location: admin.php");
        exit();        
    } 
}
else {
        // Gagal hapus user
        $_SESSION['eror_msg'] = [
    'type' => 'error',
    'msg' => 'gagal menghapus '. $username .'!',
];
        echo "Gagal menghapus user.";
    }
}

mysqli_close($koneksi);
?>