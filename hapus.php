<?php 
	require 'fncs.php';

	$id = $_GET["id"];

	if(hapus($id)>0){
			echo "
				<script>
					alert('berhasil dihapus')
					document.location.href = 'index.php'
				</script>
			";
		}else{
			echo "
				<script>
					alert('gagal dihapus')
					document.location.href = 'index.php'
				</script>
			";
			echo "<br>";
			echo mysqli_error($link);
		}
 ?>