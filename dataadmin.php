
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
</head>
<body>
    <table class="table-auto w-full text-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-2xl">NO</th>
                                <th class="px-4 py-2 text-2xl">id</th>
                                <th class="px-4 py-2 text-2xl">pembuatanakun</th>
                                <th class="px-4 py-2 text-2xl">username</th>
                                <th class="px-4 py-2 text-2xl">Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
include('koneksi.php');

$query = "SELECT * FROM `user`";
$result = mysqli_query($koneksi, $query);
$nomor = 1;
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
?>
                            <tr class="border-b border-gray-200">
                                <td class="px-4 py-2 border border-black bg-[#fde68a]">
                                    <?php echo $nomor++; ?>
                                </td>
                                <td class="px-4 py-2">
                                    <?php echo $row["id"]; ?>
                                </td>
                                <td class="px-4 py-2">
                                    <?php echo $row["pembuatanakun"]; ?>
                                </td>
                                <td class="px-4 py-2">
                                    <?php echo $row["username"]; ?>
                                </td>
                                <td class="px-4 py-2">
                                    <?php 
            if ($row["role"] == "admin") {
                echo '<span class="text-lime-400">'.$row["role"].'</span>';
            } else {
                echo '<span class="text-pink-600">'.$row["role"].'</span>';
            }
            ?>
                                    <form action="update_role.php" method="POST" class="inline"
                                        onsubmit="confirmChange(event, 'Apakah Anda yakin ingin mengubah role [ <?php echo $row['username']; ?> ] ?')">
                                        <input type="hidden" name="username" value="<?php echo $row['username']; ?>">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <select name="new_role" class="border border-gray-300 rounded px-2 py-1">
                                            <?php
                switch ($row['role']) {
                    case 'admin':
                        echo '<option value="admin" selected>Admin</option>';
                        echo '<option value="user">User</option>';
                        break;
                    case 'user':
                        echo '<option value="admin">Admin</option>';
                        echo '<option value="user" selected>User</option>';
                        break;
                    default:
                        echo '<option value="admin">Admin</option>';
                        echo '<option value="user">User</option>';
                }
            ?>
                                        </select>
                                        <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded ml-2">Ubah
                                            Role</button>
                                    </form>

                                    <form action="delete_user.php" method="POST" class="inline"
                                        onsubmit="confirmChange(event, 'Apakah Anda yakin ingin menghapus [ <?php echo $row['username']; ?> ]')">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded ml-2">Hapus
                                            User</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
    }
} else {
    echo "0 hasil/ Data kosong";
}
mysqli_close($koneksi);
?>
                        </tbody>
                    </table>
</body>
</html>