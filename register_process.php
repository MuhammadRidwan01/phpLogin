<?php
include('koneksi.php');

$username = $_POST['username'];
$password = $_POST['password'];
$nama_lengkap = $_POST['nama_lengkap'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tanggal_lahir = $_POST['tanggal_lahir'];

// Menyimpan akun
$query_akun = "INSERT INTO `user` (`id`, `pembuatanakun`, `username`, `password`) VALUES (NULL, CURRENT_TIMESTAMP, '$username', '$password')";
$result_akun = mysqli_query($koneksi, $query_akun);

if ($result_akun) {
    // Mengambil id akun
    $id_akun = mysqli_insert_id($koneksi);

    // ID akun ke dalam tabel ridwan
    $query_ridwan = "INSERT INTO `ridwan` (id_akun, nama_lengkap, alamat, jenis_kelamin, tangal_lahir) VALUES ('$id_akun', '$nama_lengkap', '$alamat', '$jenis_kelamin', '$tanggal_lahir')";
    $result_ridwan = mysqli_query($koneksi, $query_ridwan);

    if ($result_ridwan) {
        // Memindahkan halaman ke:
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
