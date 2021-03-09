<?php 
	require '../fncs.php';

	// menangkap dari ajax di script.js
	$keyword = $_GET["keyword"];

	$query = "SELECT * FROM film
					WHERE
					judul LIKE '%$keyword%' OR
					tahun LIKE '%$keyword%'
				";
	$film = query($query);

	
 ?>

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