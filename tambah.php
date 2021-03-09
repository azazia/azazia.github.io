<?php 
	//cek apakah use sudah login
	session_start();
	if (!isset($_SESSION["login"])) {
		header("Location: login.php");
		exit;
	}

	require 'fncs.php';

	$link = mysqli_connect("localhost", "root", "", "phpdasar");


	if (isset($_POST["submit"])) {

		//cek keberhasilan menambahkan data
		if(tambah($_POST)>0){
			echo "
				<script>
					alert('berhasil')
					document.location.href = 'index.php'
				</script>
			";
		}else{
			echo "
				<script>
					alert('gagal')
					document.location.href = 'index.php'
				</script>
			";
			echo "<br>";
			echo mysqli_error($link);
		}

	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Tambah data</title>
</head>
<body>
	<h1>Tambah data</h1>

	<form action="" method="post" enctype="multipart/form-data">
		<ul>
			<li>
				<label for="judul">judul : </label>
				<input type="text" name="judul" id="judul" required="">
			</li>
			<li>
				<label for="tahun">tahun : </label>
				<input type="text" name="tahun" id="tahun">
			</li>
			<li>
				<label for="sutradara">sutradara : </label>
				<input type="text" name="sutradara" id="sutradara">
			</li>
			<li>
				<label for="pemeran">pemeran : </label>
				<input type="text" name="pemeran" id="pemeran">
			</li>
			<li>
				<label for="gambar">gambar : </label>
				<input type="file" name="gambar" id="gambar">
			</li>
			<li>
				<button type="submit" name="submit">tambah</button>
			</li>
		</ul>
	</form>
</body>
</html>