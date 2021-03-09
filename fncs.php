<?php 

	$link = mysqli_connect("localhost", "root", "", "phpdasar");


	function query($query){
		global $link;
		$result = mysqli_query($link,$query);
		$rows = [];
		while ($row = mysqli_fetch_assoc($result)) {
			$rows[]=$row;
		}

	// //menampilkan pesan error
	// if($result == false){
	// 	echo "terjadi kesalahan";
	// }

	//ambil data(fetch) film dari object result
	// while ($film = mysqli_fetch_assoc($result)) {
	// 	var_dump($film);
	// }
		return $rows;
	}

	//tambah data
	function tambah($data){
		global $link;
		// ambil data dari tiap elemen dalam form
		$judul = $data["judul"];
		$tahun = $data["tahun"];
		$sutradara = $data["sutradara"];
		$pemeran = $data["pemeran"];

		$gambar = upload();
		if (!$gambar) {
			return false;
		}

		//query insert data
		$query = "INSERT INTO film 
					VALUES
					('','$judul','$tahun','$sutradara','$pemeran','$gambar')";

		mysqli_query($link, $query);

		return mysqli_affected_rows($link);
	}


	function upload(){
		$namaFile = $_FILES['gambar']['name'];
		$ukuranFile = $_FILES['gambar']['size'];
		$error = $_FILES['gambar']['error'];
		$tmp = $_FILES['gambar']['tmp_name'];

		// cek ada tidak gambar diupload
		if ($error === 4) {
			echo "<script>
					alert('uplod gambar dulu');
					</script>";
			return false;
		}

		//cek apakah file adalah gambar
		$ekstensiValid = ['jpg', 'jpeg', 'png'];
		$ekstensi = explode('.', $namaFile); //memisahkan nama file
		$ekstensi = strtolower(end($ekstensi));
		if (!in_array($ekstensi, $ekstensiValid)){
			echo "<script>
					alert('ekstensi file tidak sah');
					</script>";
			return false;
		}

		//cek ukuran
		if ($ukuranFile>1000000) {
			echo "<script>
					alert('ukuran gambar terlalu besar');
					</script>";
			return false;
		}

		//lolos pengecekan
		//generate nama gambar baru agar tidak doble dgn user lain
		$namaFileBaru = uniqid();
		$namaFileBaru .= '.'.$ekstensi;
		

		move_uploaded_file($tmp, 'img/'.$namaFileBaru);

		return $namaFileBaru;
	}


	function hapus($id){
		global $link;
		mysqli_query($link, "DELETE FROM film WHERE id = $id");
		return mysqli_affected_rows($link);
	}


	function edit($data){
		global $link;

		//menangkap id
		$id = $data["id"];
		// edit data dari tiap elemen dalam form
		$judul = htmlspecialchars($data["judul"]);
		$tahun = htmlspecialchars($data["tahun"]);
		$sutradara = htmlspecialchars($data["sutradara"]);
		$pemeran = htmlspecialchars($data["pemeran"]);
		
		$gambarLama = $data["gambarLama"];

		//cek apakah user memilih gambar baru
		if ($_FILES['gambar']['error']===4){
			$gambar = $gambarLama;
		}else{
			$gambar = upload();
		}

		//query insert data
		$query = "UPDATE film SET
					judul = '$judul',
					tahun = '$tahun',
					sutradara = '$sutradara',
					pemeran = '$pemeran',
					gambar = '$gambar'
				WHERE id = $id
				";

		mysqli_query($link, $query);

		return mysqli_affected_rows($link);
	}


	function cari($keyword){
		$query = "SELECT * FROM film
					WHERE
					judul LIKE '%$keyword%' OR
					tahun LIKE '%$keyword%'
				";
		return query($query);
	}


	function urut($cari){

		if ($cari=="waktu") {
			$query = "SELECT * FROM film
					ORDER BY id";
		}elseif ($cari=="judul") {
			$query = "SELECT * FROM film
					ORDER BY judul";
		}elseif ($cari=="tahun") {
			$query = "SELECT * FROM film
					ORDER BY tahun";
		}

		return query($query);
	}


	function registrasi($data){
		global $link;

		$username = strtolower(stripcslashes($data["username"]));
		$password = mysqli_real_escape_string($link, $data["password"]);
		$password2 = mysqli_real_escape_string($link, $data["password2"]);

		//cek apakah sudah ada akun serupa yang terdaftar 
		$result = mysqli_query($link, "SELECT username FROM user WHERE username = '$username'");

		if (mysqli_fetch_assoc($result)) {
			echo "<script>
					alert('username telah terdaftar');
				</script>";
			return false;
		}

		//cek konfirmasi password
		if($password !== $password2){
			echo "<script>
					alert('konfimasi password tidak sesuai');
				</script>";
			return false;
		}

		//enkripsi
		$password = password_hash($password, PASSWORD_DEFAULT);

		//tambahkan user baru ke db
		mysqli_query($link, "INSERT INTO user VALUES('', '$username', '$password')");

		return mysqli_affected_rows($link);
	}
 ?>