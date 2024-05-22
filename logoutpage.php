<?php
session_start();
if (isset($_SESSION['username'])) {
    
} else {header("Location: index.php");
}
include('koneksi.php');
include('koneksi.php'); ?>
<div class="max-w-sm mx-auto bg-gradient-to-r from-purple-500 to-indigo-500 shadow-md rounded-md overflow-hidden">
    <div class="p-4">
        <h2 class="text-2xl font-semibold text-white mb-2">Informasi Akun</h2>
        <p class="text-white mb-2">Username: <?php echo $_SESSION['username']; ?></p>
        <p class="text-white mb-4">ID Akun: <?php echo $_SESSION['id_akun']; ?></p>
        <p class="text-white mb-4">Tanggal pembuatan Akun: <?php echo $_SESSION['akundibuat']; ?></p>
        <div class="flex justify-center items-center">
            <div class="">
            <form action="prosesLogout.php" method="post" class=" mb-2 ">
            <button type="submit" class="bg-white hover:bg-gray-200 text-gray-800 font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Logout
            </button>
        </form>
        <form action="ProsesDeledAkun.php" method="post">
        <button type="submit" class=" bg-merah  hover:bg-gray-200 text-gray-800 font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Hapus akun!!
            </button>
        </form></div>
        </div>
    </div>
</div>