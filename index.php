<?php
// Midelware KW wkwkwk
session_start();
if (isset($_SESSION['eror_msg'])) {
$eror_msg = $_SESSION['eror_msg'];
session_destroy();
}

if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
}
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
</head>

<body>
    <section class="bg-gradient-to-r from-indigo-500 from-10% via-sky-500 via-30% to-emerald-500 to-90% w-100 h-screen ">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Login ke akun mu
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="prosesLogin.php" method="post">
                        <div>
                            <label for="username"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                            <input type="text" name="username" id="username"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="username" required="">
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required="">
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-info rounded border-2 bg-emerald-500 p-1">login</button>
                        <p class="text-sm font-light text-white ">
                            belum punya akun? <a href="register.php"
                                class="font-medium text-primary-600 hover:underline dark:text-white-50 ">register</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <?php if (isset($eror_msg)) {
echo '<div id="errorDiv" class="fixed bottom-0 right-0">
  <div class=" m-5 bg-merah text-sm text-white rounded-lg p-4 ">
    <span class="font-bold">Eror!</span> '.$eror_msg.'<button id="closeBtn">
      <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
      </svg>
    </button>
  </div>
</div>';
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
    </section>
</body>

</html>