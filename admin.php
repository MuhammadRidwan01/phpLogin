<?php
session_start();
// middle ware kw LOL
// jika tidak ada username di session
if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin') {
} 
else { // jika tidak di penuhi Maka redirect ke :
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
<style>

.lds-grid,
.lds-grid div {
  box-sizing: border-box;
}
.lds-grid {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-grid div {
  position: absolute;
  width: 16px;
  height: 16px;
  border-radius: 50%;
  background: currentColor;
  animation: lds-grid 1.2s linear infinite;
}
.lds-grid div:nth-child(1) {
  top: 8px;
  left: 8px;
  animation-delay: 0s;
}
.lds-grid div:nth-child(2) {
  top: 8px;
  left: 32px;
  animation-delay: -0.4s;
}
.lds-grid div:nth-child(3) {
  top: 8px;
  left: 56px;
  animation-delay: -0.8s;
}
.lds-grid div:nth-child(4) {
  top: 32px;
  left: 8px;
  animation-delay: -0.4s;
}
.lds-grid div:nth-child(5) {
  top: 32px;
  left: 32px;
  animation-delay: -0.8s;
}
.lds-grid div:nth-child(6) {
  top: 32px;
  left: 56px;
  animation-delay: -1.2s;
}
.lds-grid div:nth-child(7) {
  top: 56px;
  left: 8px;
  animation-delay: -0.8s;
}
.lds-grid div:nth-child(8) {
  top: 56px;
  left: 32px;
  animation-delay: -1.2s;
}
.lds-grid div:nth-child(9) {
  top: 56px;
  left: 56px;
  animation-delay: -1.6s;
}
@keyframes lds-grid {
  0%, 100% {
    opacity: 1;
  }
  50% {
    opacity: 0.5;
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
    <!-- alart konfirmasi -->
    <script>
        function confirmChange(event, message) {
            if (!confirm(message)) {
                event.preventDefault(); // Mencegah aksi jika pengguna membatalkan
            }
        }
    </script>

    <link rel="stylesheet" href="style.css">
    <!-- htmx -->
    <script src="https://unpkg.com/htmx.org@1.9.12"
        integrity="sha384-ujb1lZYygJmzgSwoxRggbCHcjc0rB2XoQrxeTUQyRjrOnlCoYta87iKBWq3EsdM2"
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="container w-100 h-100">
        <nav class="flex flex-col md:flex-row bg-blue-600 text-white shadow-md leading-none">
            <div class="flex items-center mx-5 py-5 md:py-0">
                <h1 class="text-2xl ml-2 inline-block">Dashboard</h1>
                <h2 class="text-2l ml-2 inline-block">Selamat datang <b>
                        <?php echo $_SESSION['username']; ?> <span class="text-lime-400"><b>ADMIN</b></span>
                    </b></h2>
            </div>
            <div class="md:flex md:flex-grow bg-blue-700 md:bg-blue-600">

                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-10"
                    onclick="location.href='prosesLogout.php'">Logout</button>
                <ul class="text-lg md:flex md:ml-auto flex justify-center">
                    <li>
                        <a id="home"
                            class="aktif w-full md:w-auto p-5 inline-block border-b-4 border-transparent hover:border-white hover:bg-blue-800"
                            href="" hx-get="/dataadmin.php" hx-trigger="click" hx-target="#search-results"
                            onclick="toggleActive('home')" hx-indicator="#spinner">Home</a>
                    </li>
                    <li>
                        <a id="account"
                            class="w-full md:w-auto p-5 inline-block border-b-4 border-transparent hover:border-white hover:bg-blue-800"
                            href="" hx-get="/addadmin.php" hx-trigger="click" hx-target="#search-results"
                            onclick="toggleActive('account')" hx-indicator="#spinner">Add user</a>
                    </li>
                    <li>
                        <a id="viewBeasiswa"
                            class="w-full md:w-auto p-5 inline-block border-b-4 border-transparent hover:border-white hover:bg-blue-800"
                            href="" hx-get="/adminListBeasiswa.php" hx-trigger="click" hx-target="#search-results"
                            onclick="toggleActive('viewBeasiswa')" hx-indicator="#spinner">daftar Beasiswa</a>
                    </li>
                    <li>
                        <a id="addbeasiswa"
                            class="w-full md:w-auto p-5 inline-block border-b-4 border-transparent hover:border-white hover:bg-blue-800"
                            href="" hx-get="/adminAddBeasiswa.php" hx-trigger="click" hx-target="#search-results"
                            onclick="toggleActive('addbeasiswa')" hx-indicator="#spinner">Add Beasiswa</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="h-screen relative flex items-center justify-center">
            <div class="container " id="search-results">
                <!-- area ajax HTMX -->
                <section class="text-center">
                    <?php include('dataadmin.php'); ?>
                </section>
            </div>
        </div>
        <div id="spinner" class="htmx-indicator ">
        <div class="lds-grid absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white "><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>
    </div>
    </div>

    </div>

    </div>
    
    <?php if (isset($_SESSION['eror_msg'])) {
    $type = $_SESSION['eror_msg']['type'];
    $msg = $_SESSION['eror_msg']['msg'];

    if ($type == 'error') {
        echo '<div id="errorDiv" class="fixed bottom-0 right-0">
            <div class="m-5 bg-red-500 text-sm text-white rounded-lg p-4">
                <span class="font-bold">Error! ' . $msg . '</span>
                <button id="closeBtn" onclick="closeNotification()">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>';
    } elseif ($type == 'notif') {
        echo '<div id="errorDiv" class="fixed bottom-0 right-0">
            <div class="m-5 bg-green-500 text-sm text-white rounded-lg p-4">
                <span class="font-bold"> ' . $msg . '</span>
                <button id="closeBtn" onclick="closeNotification()">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>';
    }

    // Reset session message
    unset($_SESSION['eror_msg']);
}?>
    <script>
        // Mendapatkan elemen-elemen yang diperlukan
        const errorDiv = document.getElementById('errorDiv');
        const closeBtn = document.getElementById('closeBtn');

        // Mendefinisikan fungsi untuk menutup div error
        function closeErrorDiv() {
            errorDiv.style.display = 'none';
        }

        // Menambahkan event listener untuk tombol close
        closeBtn.addEventListener('click', closeErrorDiv);
    </script>
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