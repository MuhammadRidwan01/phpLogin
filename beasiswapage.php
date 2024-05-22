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
        ?>
<section class="bg-gradient-to-r from-indigo-500 from-10% via-sky-500 via-30% to-emerald-500 to-90% w-100 h-auto ">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div
            class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-3 space-y-2 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Daftar beasiswa
                </h1>
                <?php
                
$query_cek_username = "SELECT * FROM `daftar_beasiswa` WHERE id_akun='" . $_SESSION['id_akun'] . "'";
$result_check_username = mysqli_query($koneksi, $query_cek_username);

// Jika username $_SESSION['username'] ada dalam tabel daftar_beasiswa, maka tampilkan pesan bahwa sudah terdaftar
if (mysqli_num_rows($result_check_username) > 0) {
    echo '<h2 class="text-xl font-bold leading-tight tracking-tight text-bg-merah text-gray-900 md:text-2xl dark:text-white">
                    Anda sudah terdaftar, silahakn pergi ke Beasiswa terdaftar
                </h2>';
} else {
    // tampilkan formulir untuk mendaftar
?>
<form class="space-y-4 md:space-y-6" action="Prosesdaftar.php" method="post" enctype="multipart/form-data">
    <div>
        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
        <input readonly type="text" name="nama" id="nama"
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            value="<?php if (isset($row["Nama_lengkap"])) { echo $row["Nama_lengkap"]; } ?>">
    </div>
<!-- input id akun otomatis -->
    <input type="hidden" name="id_akun" value="<?php echo $row["id_akun"]; ?>">
    <div class="flex">
        <div class="w-1/2 pr-2">
            <label for="nomorhp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor HP</label>
            <input type="nomorhp" name="nomorhp" id="nomorhp" placeholder="08123456789"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required="">
        </div>
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" name="email" id="email" placeholder="EX: Email@domain.com"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required="">
        </div>
    </div>
    <div class="">
        <label for="semester" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Semester saat ini</label>
        <select id="semester" name="semester"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-50 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:placeholder-gray-400">
            <option value="semester1">Semester1</option>
            <option value="semester2">Semester2</option>
            <option value="semester3">Semester3</option>
            <option value="semester4">Semester4</option>
            <option value="semester5">Semester5</option>
            <option value="semester6">Semester6</option>
        </select>
    </div>
    <div>
        <label for="ipk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">IPK</label>
        <input type="number" name="ipk" id="ipk" placeholder="3.33" min="1" max="4" step="0.01"
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            required>
    </div>
    <div class="">
        <label for="beasiswa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Beasiswa</label>
        <select id="beasiswa" name="beasiswa"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-50 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:placeholder-gray-400">
            <?php
            // koneksi ke database
            include('koneksi.php');
            // Query untuk mengambil data beasiswa dari tabel beyasiswa
            $query_beasiswa = "SELECT * FROM `beyasiswa`";
            $result_beasiswa = mysqli_query($koneksi, $query_beasiswa);
            // Periksa apakah query berhasil dieksekusi
            if ($result_beasiswa) {
                // Tampilkan setiap baris data sebagai opsi dalam dropdown "Beasiswa"
                while ($row_beasiswa = mysqli_fetch_assoc($result_beasiswa)) {
                    echo '<option value="' . $row_beasiswa["id"] . '">' . $row_beasiswa["jenis"] . '</option>';
                }
            } else {
                echo "Error: " . $query_beasiswa . "<br>" . mysqli_error($koneksi);
            }
            mysqli_close($koneksi);
            ?>
        </select>
    </div>
    <div>
        <label for="berkas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unggah Berkas</label>
        <input type="file" name="berkas" id="berkas"
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            required>
    </div>
    <button type="submit" class="w-full text-white bg-info rounded border-2 bg-emerald-500 p-1">daftar</button>
</form>
<?php } }}?>
            </div>
        </div>
    </div>
</section>