<?php
include('koneksi.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['id_akun'] = $row['id'];
        $_SESSION['akundibuat'] = $row['pembuatanakun'];
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $row['role'];

        if ($row['role'] == 'admin') {
            header("Location: admin.php");
            exit();
        } elseif ($row['role'] == 'user') {
            header("Location: dashboard.php");
            exit();
        }
    } else {
        $_SESSION['eror_msg'] = "Username atau password salah";
        header("Location: index.php");
        exit();
    }
}

mysqli_close($koneksi);
?>
