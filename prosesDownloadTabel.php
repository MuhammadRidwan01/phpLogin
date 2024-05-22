    <?php
include('koneksi.php');
session_start();
require_once __DIR__ . '/vendor/autoload.php';

use Mpdf\Mpdf;
// fetch data
$query = "SELECT * FROM `ridwan` WHERE id_akun='" . $_SESSION['id_akun'] . "'";
$result = mysqli_query($koneksi, $query);

// Check if any rows are returned
if (mysqli_num_rows($result) == 0) {
    echo "No rows found in the database for id_akun: " . $_SESSION['id_akun'];
    exit;
}

$mpdf = new Mpdf();
$html = '';
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $html .= '<style>';
$html .= 'table { border-collapse: collapse; width: 100%; }';
$html .= 'th, td { padding: 8px; border-bottom: 1px solid #ddd; text-align: left; }';
$html .= '</style>';
//tambahkan judul
$html .= '<h2>Data ' . $row["Nama_lengkap"] . '</h2>';
        $html .= '<table class="table-auto w-full text-lg" style="border-collapse: collapse; width: 100%;">';
$html .= '<thead class="bg-gray-100">';
$html .= '<tr>';
$html .= '<th style="padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">Nama Lengkap</th>';
$html .= '<th style="padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">Alamat</th>';
$html .= '<th style="padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">Jenis Kelamin</th>';
$html .= '<th style="padding: 8px; text-align: left; border-bottom: 1px solid #ddd;">Tanggal Lahir</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';
$html .= '<tr>';
$html .= '<td style="padding: 8px; border-bottom: 1px solid #ddd;">' . $row["Nama_lengkap"] . '</td>';
$html .= '<td style="padding: 8px; border-bottom: 1px solid #ddd;">' . $row["alamat"] . '</td>';
$html .= '<td style="padding: 8px; border-bottom: 1px solid #ddd;">' . $row["jenis_kelamin"] . '</td>';
$html .= '<td style="padding: 8px; border-bottom: 1px solid #ddd;">' . $row["tangal_lahir"] . '</td>';
$html .= '</tr>';
$html .= '</tbody>';
$html .= '</table>';

    }
}

// Html ke pdf
$mpdf->WriteHTML($html);

// Outputkan PDF
$mpdf->Output();

?>