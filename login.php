<!DOCTYPE html>
<html>

<head>
    <title>Membuat Login Dengan PHP dan MySQLi - WWW.MALASNGODING.COM</title>
</head>

<body>
    <h2>Login - www.malasngoding.com</h2>
    <br />
    <!-- cek pesan notifikasi -->
    <?php
    if (isset($_GET['pesan'])) {
        if ($_GET['pesan'] == "gagal") {
            echo "Login gagal! username dan password salah!";
        } else if ($_GET['pesan'] == "logout") {
            echo "Anda telah berhasil logout";
        } else if ($_GET['pesan'] == "belum_login") {
            echo "Anda harus login untuk mengakses halaman admin";
        }
    }
    ?>
    <br />
    <br />
    <form method="post" action="cek_login.php">
        <table>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><input type="text" name="username" placeholder="Masukkan username"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td><input type="password" name="password" placeholder="Masukkan password"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" value="LOGIN"></td>
            </tr>
        </table>
    </form>
</body>

</html>





<?php
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include 'config.php';

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];

// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($mysqli, "select * from admin where username='$username' and password='$password'");

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

if ($cek > 0) {
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login";
    header("location:index.php");
} else {
    header("location:login.php?pesan=gagal");
}
?>


<?php
if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "gagal") {
        echo "Login gagal! username dan password salah!";
    } else if ($_GET['pesan'] == "logout") {
        echo "Anda telah berhasil logout";
    } else if ($_GET['pesan'] == "belum_login") {
        echo "Anda harus login untuk mengakses halaman admin";
    }
}
?>







<!DOCTYPE html>
<html>

<head>
    <title>Membuat Login Dengan PHP dan MySQLi - WWW.MALASNGODING.COM</title>
</head>

<body>
    <h2>Halaman Admin</h2>

    <br />

    <!-- cek apakah sudah login -->
    <?php
    session_start();
    if ($_SESSION['status'] != "login") {
        header("location:../login.php?pesan=belum_login");
    }
    ?>

    <h4>Selamat datang, <?php echo $_SESSION['username']; ?>! anda telah login.</h4>

    <br />
    <br />

    <a href="logout.php">LOGOUT</a>


</body>

</html>

<!-- cek apakah sudah login -->
<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("location:../login.php?pesan=belum_login");
}
?>




<a href="logout.php">LOGOUT</a>



<?php
// mengaktifkan session
session_start();

// menghapus semua session
session_destroy();

// mengalihkan halaman sambil mengirim pesan logout
header("location:../login.php?pesan=logout");
?>