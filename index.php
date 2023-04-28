<?php
// INCLUDE KONEKSI KE DATABASE
include_once("config.php");
?>

<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

	<title>Hello, world!</title>
</head>

<body class="container">
	<h2 class="text-center">data User</h2>
	<br>
	<form class="form-inline">
		<div class="form-group mb-2">
			<!-- <label for="staticEmail2" class="sr-only">Email</label> -->
			<input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Cari User">
		</div>
		<div class="form-group mx-sm-3 mb-2">
			<label for="inputPassword2" class="sr-only">Password</label>
			<input type="text" class="form-control" name="kata_cari" value="<?php if (isset($_GET['kata_cari'])) {
																				echo $_GET['kata_cari'];
																			} ?>" />
		</div>
		<button type="submit" class="btn btn-primary mb-2">Cari Data</button>
	</form>
	<br>

	<a type="button" class="btn btn-primary btn-lg btn-block" href="add.html">Tambah</a>
	<div class="table-responsive">
		<table class="table">

			<tr bgcolor='#CCCCCC'>
				<td>Nama</td>
				<td>Umur</td>
				<td>Email</td>
				<td>Gambar</td>
				<td>Action</td>
			</tr>
			<?php
			//untuk meinclude kan koneksi
			include('config.php');

			//jika kita klik cari, maka yang tampil query cari ini
			if (isset($_GET['kata_cari'])) {
				//menampung variabel kata_cari dari form pencarian
				$kata_cari = $_GET['kata_cari'];

				//jika hanya ingin mencari berdasarkan kode_produk, silahkan hapus dari awal OR
				//jika ingin mencari 1 ketentuan saja query nya ini : SELECT * FROM produk WHERE kode_produk like '%".$kata_cari."%' 
				$query = "SELECT * FROM USERS WHERE nama like '%" . $kata_cari . "%' OR umur like '%" . $kata_cari . "%' OR email like '%" . $kata_cari . "%' ORDER BY id ASC";
			} else {
				//jika tidak ada pencarian, default yang dijalankan query ini
				$query = "SELECT * FROM USERS ORDER BY id ASC";
			}


			$result = mysqli_query($mysqli, $query);

			if (!$result) {
				die("Query Error : " . mysqli_errno($mysqli) . " - " . mysqli_error($mysqli));
			}
			//kalau ini melakukan foreach atau perulangan
			while ($row = mysqli_fetch_assoc($result)) {
			?>

				<tr>
					<td><?php echo $row['nama']; ?></td>
					<td><?php echo $row['umur']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo "<img src='image/$row[gambar]' width='70' height='90' />"; ?></td>
					<td><a href="edit.php?id=<?php echo $row['id']; ?>">edit</a>
						<a href="delete.php?id=<?php echo $row['id']; ?>">del</a>
					</td>
					<!-- <td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Kamu yakin untuk delete ini?')\">Delete</a></td> -->
				</tr>

			<?php } ?>
		</table>
	</div>




	<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>