<?php
session_start();
include('koneksi.php'); // Assuming you have a database connection file

$selected_beasiswa = isset($_GET['beasiswa']) ? $_GET['beasiswa'] : '';

// Base query to get the data
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
    beyasiswa ON daftar_beasiswa.beasiswa = beyasiswa.id";

// Modify the query if a filter is selected
if ($selected_beasiswa != '') {
    $query .= " WHERE beyasiswa.jenis = '" . mysqli_real_escape_string($koneksi, $selected_beasiswa) . "'";
}

$result = mysqli_query($koneksi, $query);

// Fetch the data
if ($result && mysqli_num_rows($result) > 0) {
    echo '<table class="min-w-full divide-y divide-gray-200">';
    echo '<thead class="bg-gray-50">';
    echo '<tr>';
    echo '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>';
    echo '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor HP</th>';
    echo '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>';
    echo '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semester</th>';
    echo '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IPK</th>';
    echo '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Beasiswa</th>';
    echo '<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Berkas</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody class="bg-white divide-y divide-gray-200">';
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td class="px-6 py-4 whitespace-nowrap"><div class="text-sm text-gray-900">' . $row['nama'] . '</div></td>';
        echo '<td class="px-6 py-4 whitespace-nowrap"><div class="text-sm text-gray-900">' . $row['nomorhp'] . '</div></td>';
        echo '<td class="px-6 py-4 whitespace-nowrap"><div class="text-sm text-gray-900">' . $row['email'] . '</div></td>';
        echo '<td class="px-6 py-4 whitespace-nowrap"><div class="text-sm text-gray-900">' . $row['semester'] . '</div></td>';
        echo '<td class="px-6 py-4 whitespace-nowrap"><div class="text-sm text-gray-900">' . $row['ipk'] . '</div></td>';
        echo '<td class="px-6 py-4 whitespace-nowrap"><div class="text-sm text-gray-900">' . $row['beasiswa_jenis'] . '</div></td>';
        echo '<td class="px-6 py-4 whitespace-nowrap"><a href="' . $row['berkas'] . '" class="text-sm text-indigo-600 hover:text-indigo-900">Download Berkas</a></td>';
        echo '</tr>';
    }
    
    echo '</tbody>';
    echo '</table>';
} else {
    echo '<div class="text-gray-500">No records found.</div>';
}

// Close the connection
mysqli_close($koneksi);
?>
