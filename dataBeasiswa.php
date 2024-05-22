<?php
session_start();
if (isset($_SESSION['username'])) {
    
} else {header("Location: index.php");}
// Koneksi ke database
include('koneksi.php');
$username = $_SESSION['username'];
$id_akun = $_SESSION['id_akun'];
// Query untuk mengambil semua data dari tabel
$query = "SELECT 
    ridwan.Nama_lengkap AS nama,
    daftar_beasiswa.nomorhp,
    daftar_beasiswa.email,
    daftar_beasiswa.semester,
    daftar_beasiswa.ipk,
    daftar_beasiswa.berkas,
    beyasiswa.jenis AS beasiswa_jenis
FROM 
    daftar_beasiswa
JOIN 
    ridwan ON daftar_beasiswa.id_akun = ridwan.id_akun
JOIN 
    beyasiswa ON daftar_beasiswa.beasiswa = beyasiswa.id
WHERE daftar_beasiswa.id_akun = '$id_akun'";
$result = mysqli_query($koneksi, $query);

// Cek apakah query berhasil dieksekusi
if ($result) { ?>
    <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Nama
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Nomor HP
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Email
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Semester
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    IPK
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Beasiswa
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Berkas
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900"><?php echo $row['nama']; ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900"><?php echo $row['nomorhp']; ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900"><?php echo $row['email']; ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900"><?php echo $row['semester']; ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900"><?php echo $row['ipk']; ?></div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900"><?php echo $row['beasiswa_jenis']; ?>
                    </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="<?php echo $row['berkas']; ?>" class="text-sm text-indigo-600 hover:text-indigo-900">Download Berkas</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<?php
} else {
    echo "Error: ". $query. "
". mysqli_error($koneksi);
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>
