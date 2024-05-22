<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

include('koneksi.php');

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve data from the form
    $id_akun = mysqli_real_escape_string($koneksi, $_POST['id_akun']);
    $nomorhp = mysqli_real_escape_string($koneksi, $_POST['nomorhp']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $semester = mysqli_real_escape_string($koneksi, $_POST['semester']);
    $ipk = mysqli_real_escape_string($koneksi, $_POST['ipk']);
    $beasiswa = mysqli_real_escape_string($koneksi, $_POST['beasiswa']);
    $berkas = $_FILES['berkas'];
    $username = $_SESSION['username'];

    // File upload handling
    if ($berkas['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($berkas['name']);
        
        if (move_uploaded_file($berkas['tmp_name'], $target_file)) {
            // Prepare and execute the query to insert data
            $query = "INSERT INTO `daftar_beasiswa` (`id_beasiswa`, `id_akun`, `nomorhp`, `email`, `semester`, `ipk`, `beasiswa`, `berkas`) 
                      VALUES (NULL, '$id_akun', '$nomorhp', '$email', '$semester', '$ipk', '$beasiswa', '$target_file')";
            $result = mysqli_query($koneksi, $query);

            // Check the result of the query
            if ($result) {
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
            }
        } else {
            $error_berkas = "Failed to upload file.";
        }
    } else {
        $error_berkas = "File upload error.";
    }

    // Optional: Echoing the form data for debugging purposes
    // echo $id_akun;
}

mysqli_close($koneksi);
?>
