<?php
session_start();
// middle ware kw LOL

// jika tidak ada username di session
if (isset($_SESSION['username'])) {
// Maka redirect ke :
} else {header("Location: index.php");}
?>
<!DOCTYPE html>
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
    <!-- htmx -->
    <script src="https://unpkg.com/htmx.org@1.9.12" integrity="sha384-ujb1lZYygJmzgSwoxRggbCHcjc0rB2XoQrxeTUQyRjrOnlCoYta87iKBWq3EsdM2" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container w-100 h-100">
        <nav class="flex flex-col md:flex-row bg-blue-600 text-white shadow-md leading-none">
            <div class="flex items-center mx-5 py-5 md:py-0">
                <h1 class="text-2xl ml-2 inline-block">Dashboard</h1>
                <h2 class="text-2l ml-2 inline-block">Selamat datang <b><?php echo $_SESSION['username']; ?></b></h2>
            </div>
            <div class="md:flex md:flex-grow bg-blue-700 md:bg-blue-600">
                <ul class="text-lg md:flex md:ml-auto">
                    <li>
    <a id="home" class="aktif w-full md:w-auto p-5 inline-block border-b-4 border-transparent hover:border-white hover:bg-blue-800"
        href="" hx-get="/data.php" hx-trigger="click" hx-target="#search-results" onclick="toggleActive('home')">Home</a>
</li>
<li>
    <a id="account" class="w-full md:w-auto p-5 inline-block border-b-4 border-transparent hover:border-white hover:bg-blue-800"
        href="" hx-get="/logoutpage.php" hx-trigger="click" hx-target="#search-results" onclick="toggleActive('account')">Account</a>
</li>
<li>
    <a id="beasiswa" class="w-full md:w-auto p-5 inline-block border-b-4 border-transparent hover:border-white hover:bg-blue-800"
        href="" hx-get="/beasiswapage.php" hx-trigger="click" hx-target="#search-results" onclick="toggleActive('beasiswa')">Beasiswa</a>
</li>
<li>
    <a id="beasiswa-terdaftar" class="w-full md:w-auto p-5 inline-block border-b-4 border-transparent hover:border-white hover:bg-blue-800"
        href="" hx-get="/dataBeasiswa.php" hx-trigger="click" hx-target="#search-results" onclick="toggleActive('beasiswa-terdaftar')">Beasiswa terdaftar</a>
</li>
                </ul>
            </div>
        </nav>

        <div class="flex  items-center h-screen">
          
          <div class="container " id="search-results">
            <?php
include('koneksi.php');

// Mengambil data dari tabel
$query = "SELECT * FROM `ridwan` WHERE id_akun='" . $_SESSION['id_akun'] . "'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) > 0) {
    // Output data dari setiap baris
    while($row = mysqli_fetch_assoc($result)) {
        ?>
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
</section></div>

<?php
    }
} else {
    echo "0 hasil/ Data kosong";
}
mysqli_close($koneksi);
            ?>
        </div>
    </div>
    </div>

        </div>
    </div>
    <script>
function toggleActive(id) {
    // Menghapus class "aktif" dari semua elemen
    const links = document.querySelectorAll('a');
    links.forEach(link => {
        link.classList.remove('aktif');
    });
    // Menambahkan class "aktif" ke elemen yang diklik
    const element = document.getElementById(id);
    element.classList.add('aktif');
}
</script>
</body>
</html>
