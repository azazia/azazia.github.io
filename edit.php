<?php 
	//cek apakah use sudah login
	session_start();
	if (!isset($_SESSION["login"])) {
		header("Location: login.php");
		exit;
	}

	require 'fncs.php';


	//ambil data di URL
	$id = $_GET["id"];
	

	//query data film berdasar id
	$film = query("SELECT * FROM film WHERE id = $id")[0];
	

	if (isset($_POST["submit"])) {

		//cek keberhasilan mengedit data
		if(edit($_POST)>0){
			echo "
				<script>
					alert('berhasil diedit')
					document.location.href = 'index.php'
				</script>
			";
		}else{
			echo "
				<script>
					alert('gagal diedit')
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
	<title>Edit data</title>
</head>
<body>
	<h1>Edit data</h1>

	<form action="" method="post" enctype="multipart/form-data" <?php //untuk menangani file ?>>
		<input type="hidden" name="id" value="<?= $film["id"] ?>">
		<input type="hidden" name="gambarLama" value="<?= $film["gambar"] ?>">
		<ul>
			<li>
				<label for="judul">judul : </label>
				<input type="text" name="judul" id="judul" required="" value="<?= $film["judul"]; ?>">
			</li>
			<li>
				<label for="tahun">tahun : </label>
				<input type="text" name="tahun" id="tahun" value="<?= $film["tahun"]; ?>">
			</li>
			<li>
				<label for="sutradara">sutradara : </label>
				<input type="text" name="sutradara" id="sutradara" value="<?= $film["sutradara"]; ?>">
			</li>
			<li>
				<label for="pemeran">pemeran : </label>
				<input type="text" name="pemeran" id="pemeran" value="<?= $film["pemeran"]; ?>">
			</li>
			<li>
				<label for="gambar">gambar : </label>
				<br>
				<img src="img/<?= $film["gambar"];?>" width = "50">
				<input type="file" name="gambar" id="gambar" >
			</li>
			<li>
				<button type="submit" name="submit">Edit</button>
			</li>
		</ul>
	</form>
</body>
</html>