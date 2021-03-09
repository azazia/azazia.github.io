<!-- buat order by macam macam -->
<!-- buat jika keyword tidak lengkap tetap bisa dicari -->
<!-- _empty -->

<?php 
	//cek apakah use sudah login
	session_start();
	if (!isset($_SESSION["login"])) {
		header("Location: login.php");
		exit;
	}

	// koneksi ke database
	//mengambil file fncs.php
	require 'fncs.php';

	//ambil data dari tabel film
	$film = query("SELECT * FROM film");

	//ketika cari ditekan
	if (isset($_POST["cari"])) {
		$film = cari($_POST["keyword"]);
	}

	if (isset($_POST["waktu"])) {
		$film = urut("waktu");
	}elseif (isset($_POST["judul"])) {
		$film = urut("judul");
	}elseif (isset($_POST["tahun"])) {
		$film = urut("tahun");
	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Admin</title>
	<style>
		.load{
			width: 20px;
			display: none;
		}
	</style>

	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/script.js"></script>
</head>
<body>
	<h1><a href="index.php">Film Animasi</a></h1>

	<a href="tambah.php">Tambah data</a>

	<br><br>

	<form action="" method="post">

		<input type="text" name="keyword" placeholder="Masukan kata kunci" autocomplete="off" id="keyword">
		<button type="submit" name="cari" id="tombol">cari</button>

		<img src="img/load.jpg" class="load">
		
	</form>

	<br><br>

	<form action="" method="post">
		<h5>Urut berdasarkan</h5>
		<button type="submit" name="waktu">waktu</button> 
		<button type="submit" name="judul">judul</button> 
		<button type="submit" name="tahun">tahun</button>
	</form>

	<br><br>

	<div id="container">
		<table border="1" cellpadding="10" cellspacing="0">

			<tr>
				<?php 
				//untuk no
				$i=1; 
				?>
				<th>No.</th>
				<th>Aksi</th>
				<th>Gambar</th>
				<th>Judul</th>
				<th>Tahun</th>
				<th>Sutradara</th>
				<th>Pemeran</th>
			</tr>

			<?php foreach ($film as $row) : ?>
			<tr>
				<td><?= $i++ ?></td>
				<td><a href="edit.php?id=<?= $row["id"] ?>">edit</a>
					<a href="hapus.php?id=<?= $row["id"] ?>" onclick="return confirm('yakin?')">hapus</a></td>
				<td><img src="img/<?= $row["gambar"] ?>" width="50"></td>
				<td><?= $row["judul"] ?></td>
				<td><?= $row["tahun"] ?></td>
				<td><?= $row["sutradara"] ?></td>
				<td><?= $row["pemeran"] ?></td>
			</tr>

			
			<?php endforeach; ?>
		</table>
	</div>

	<br><br>
	<a href="logout.php">LOGOUT</a>


</body>
</html>