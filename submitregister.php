<?php

$db = new PDO ( "mysql:host=127.0.0.1;dbname=photosting;", "root", "");

if ( $db !=true) {
	die ("Error");
}

$username			=$_POST["username"];
$password			=$_POST["password"];
$email				=$_POST["email"];
$telepon			=$_POST["telepon"];
$jk					=$_POST["jk"];
$tgl				=$_POST["tgl"];


if ( empty($username) == true || empty ($password) == true || empty($confirmpassword) == true ){
	echo "<script>alert('inputan kosong!');</script>";
	echo "<script>document.location='formregister.php';</script>";
}

else if ( strpos($username, " ") !=false ){
	echo "<script>alert('username tidak boleh spasi!');</script>";
	echo "<script>document.location='formregister.php';</script>";
}
else if ( $password != $confirmpassword ) {
	echo "<script>alert('Confirm password tidak sama!');</script>";
	echo "<script>document.location='formregister.php';</script>";
}

else {
	$pengacak = "fahriganteng";
	$password = md5 ($password . $pengacak);
	
	$datauser = array(
		":username" 	=> $username,
		":password" 	=> $password,
		":email" 		=> $email,
		":telepon" 		=> $telepon,
		":jk"			=> $jk,
		":tgl" 			=> $tgl,
	);

	$query = $db->prepare ( "INSERT INTO login (username, password, email, telepon, jk, tgl,level) VALUES (:username, :password, :email, :telepon, :jk, :tgl, 'user');" );
	$query->execute ($datauser);
	
	echo "<script>alert('anda berhasil terdaftar!');</script>";
}

echo "<script>document.location='index.php';</script>";

?>