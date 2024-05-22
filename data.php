<?php
session_start();
if (isset($_SESSION['username'])) {
    
} else {header("Location: index.php");}
include('koneksi.php');

// Mengambil data dari tabel
$query = "SELECT * FROM `ridwan` WHERE id_akun='" . $_SESSION['id_akun'] . "'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) > 0) {
    // Output data dari setiap baris
    while($row = mysqli_fetch_assoc($result)) {
         echo '<pre>'; print_r($row); echo '</pre>';
        ?>
        <!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <style type="text/tailwindcss">
        @layer utilities {
            .content-auto {
                content-visibility: auto;
            }
        }
    </style>
    <!-- tailwindConfig -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
                        sky: '#0099ff',
                        'merah': '#be123c',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <section class="text-center">
    <table class="table-auto w-full text-lg">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-2xl">Nama Lengkap</th>
                <th class="px-4 py-2 text-2xl">Alamat</th>
                <th class="px-4 py-2 text-2xl">Jenis Kelamin</th>
                <th class="px-4 py-2 text-2xl">Tanggal Lahir</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-b border-gray-200">
                <td class="px-4 py-2"><?php echo $row["Nama_lengkap"]; ?></td>
                <td class="px-4 py-2"><?php echo $row["alamat"]; ?></td>
                <td class="px-4 py-2"><?php echo $row["jenis_kelamin"]; ?></td>
                <td class="px-4 py-2"><?php echo $row["tangal_lahir"]; ?></td>
            </tr>
        </tbody>
    </table>
    <a href="prosesDownloadTabel.php"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"hx-get="/prosesDownloadTabel.php" hx-trigger="click" hx-target="#search-results">Download</button></a>
    
</section></div>
</body>
</html>
<?php
    }
} else {
    echo "0 hasil";
    echo $_SESSION['id_akun'];
    echo $_SESSION['pembuatanakun'];
}
mysqli_close($koneksi);
            ?>
        </div>
    </div>