<?php
	// connection
	$host = 'localhost';
	$username = 'root';
	$password = '';
	$database = 'spk_ahp2';

	$koneksi = mysqli_connect($host,$username,$password);

	if (!$koneksi)
	{
		echo "Tidak dapat terkoneksi dengan server";
		exit();
	}

	if(!mysqli_select_db($koneksi, $database))
	{
		echo "Tidak dapat menemukan database";
		exit();
	}
?>
