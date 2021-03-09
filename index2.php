<?php 
	// koneksi ke database
	$link = mysqli_connect("localhost", "root", "", "phpdasar");

	//ambil data dari tabel film
	$result = mysqli_query($link,"SELECT * FROM film");

	// //menampilkan pesan error
	// if($result == false){
	// 	echo "terjadi kesalahan";
	// }

	//ambil data(fetch) film dari object result
	// while ($film = mysqli_fetch_assoc($result)) {
	// 	var_dump($film);
	// }

	//untuk no
	$i=1;
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Admin</title>
</head>
<body>
	<h1>Daftar Film Animasi</h1>

	<table border="1" cellpadding="10" cellspacing="0">

		<tr>
			<th>No.</th>
			<th>Aksi</th>
			<th>Gambar</th>
			<th>Judul</th>
			<th>Tahun</th>
			<th>Sutradara</th>
			<th>Pemeran</th>
		</tr>

		<?php while ($row = mysqli_fetch_assoc($result))  : ?>
		<tr>
			<td><?= $i ?></td>
			<td><a href="">edit</a>
				<a href="">hapus</a></td>
			<td><img src="img/<?= $row["gambar"] ?>" width="50"></td>
			<td><?= $row["judul"] ?></td>
			<td><?= $row["tahun"] ?></td>
			<td><?= $row["sutradara"] ?></td>
			<td><?= $row["pemeran"] ?></td>
		</tr>

		<?= $i++ ?>
		<?php endwhile; ?>
	</table>
</body>
</html>