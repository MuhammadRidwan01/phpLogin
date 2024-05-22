<?php
$server = "localhost";
$username = "reactlogin";
$password = "123467";
$db = "loginbackend";

$koneksi = mysqli_connect($server, $username, $password, $db);

if (!$koneksi) {
    die("Koneksi ke database GAGAL!: " . mysqli_connect_error());
}
// else {
//     echo "Koneksi ke database BERHASIL!";
// }
?>
