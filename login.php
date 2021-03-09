<?php 
	session_start();
	require 'fncs.php';

	//cek cookie dulu
	if(isset($_COOKIE["id"])){
		$id = $_COOKIE['id'];
		$key = $_COOKIE["key"];

		//a,bil usename berdasar id
		$result= mysqli_query($link, "SELECT username FROM user WHERE id = $id");
		$row = mysqli_fetch_assoc($result);

		//cek cookie dan username
		if ($key === hash('sha256', $row['username'])) {
			$_SESSION['login'] = true;
		}
	}

	//cek apakah use sudah login
	if (isset($_SESSION["login"])) {
		header("Location: index.php");
		exit;
	}

	
	if (isset($_POST["login"])) {
		$username = $_POST["username"];
		$password = $_POST["password"];

		//mengambil username
		$result = mysqli_query($link, "SELECT * FROM user WHERE username = '$username'");

		//cek username jika ketemu akan return 1
		if(mysqli_num_rows($result) === 1){

			//cek password
			$row = mysqli_fetch_assoc($result);
			if(password_verify($password, $row["password"]) ){

				// //set session
				$_SESSION["login"] = true;

				//cek remmber me
				if (isset($_POST['remember'])) {
					//buat cookie
					setcookie('id', $row['id'], time()+120);
					setcookie('key', hash('sha256', $row['username']), time()+120);

				}

				header("Location: index.php");
				exit;
			}
		}

		$error = true;
	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<!-- <style>
		label{
			display: block;
		}
	</style> -->
</head>
<body>
	<h1>Halaman login</h1>

	<?php if(isset($error)) : ?>
		username/password salah gan
	<?php endif; ?>

	<form action="" method="post">
		<li>
			<label for="username">Username : </label>
			<input type="text" name="username" id="username">
		</li>
		<li>
			<label for="password">Password : </label>
			<input type="password" name="password" id="password">
		</li>
		<li>
			<input type="checkbox" name="remember" id="remember">
			<label for="remember">Remember me</label>
		</li>
		<li>
			<button type="submit" name="login">Login</button>
		</li>
	</form>
</body>
</html>