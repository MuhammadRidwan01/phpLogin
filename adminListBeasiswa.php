<?php

include('koneksi.php');
$beasiswa_query = "SELECT jenis FROM beyasiswa";
$beasiswa_result = mysqli_query($koneksi, $beasiswa_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Beasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-bold mb-4">Daftar Beasiswa</h1>
        
        <form method="GET" class="mb-4" hx-get="get_beasiswa.php" hx-target="#beasiswa-table" hx-indicator="#loading-indicator">
            <label for="beasiswa" class="block text-sm font-medium text-gray-700">Filter by Beasiswa</label>
            <select name="beasiswa" id="beasiswa" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                <option value="">All</option>
                <?php while ($row = mysqli_fetch_assoc($beasiswa_result)) { ?>
                    <option value="<?php echo $row['jenis']; ?>">
                        <?php echo $row['jenis']; ?>
                    </option>
                <?php } ?>
            </select>
            <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">Filter</button>
        </form>
        
        <!-- Loading Indicator -->
        <div id="spinner" class="htmx-indicator ">
            <div class="lds-dual-ring text-white"></div>
        </div>
        
        <!-- Table Content -->
        <div id="beasiswa-table">
            <?php include 'get_beasiswa.php'; ?>
        </div>
    </div>
</body>
</html>
