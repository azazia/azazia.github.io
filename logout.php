<?php 
	session_start();
	// untuk memas tikan telah logout makanya dibuat banyak
	session_unset();
	session_destroy();
	$_SESSION=[];

	//menghapus cookie nama sama tapi nilai kosong dan time mindur
	setcookie('id','tutud', time()-3600);
	setcookie('key','', time()-3600);

	header("Location: login.php");
	exit;
 ?>