<?php session_start();
// middle ware kw LOL
// jika tidak ada username di session
if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin') {
} 
else { // jika tidak di penuhi Maka redirect ke :
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Admin</title>
</head>
<body>
    <form action="prosesadadmin.php" method="POST">
        <body>
    <section class="bg-gradient-to-r from-indigo-500 from-10% via-sky-500 via-30% to-emerald-500 to-90% w-100 h-screen">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        tambah admin baru</h1>
                    <form class="space-y-4 md:space-y-6" action="prosesLogin.php" method="post">
                        <div>
                            <label for="username"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                            <input type="text" name="username" id="username"
                                class="input-field focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Username" required="">
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password"
                                class="input-field focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="••••••••" required="">
                        </div>
                        <button type="submit" class="w-full text-white bg-info rounded border-2 bg-emerald-500 p-1">tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    </form>
</body>
</html>
