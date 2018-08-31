<?php
session_start();

$db = new PDO ( "mysql:host=127.0.0.1;dbname=photosting;", "root", "");

if ( $db !=true) {
	die ("Error");
}

$username			=$_POST["username"];
$password			=$_POST["password"];

$setUser = array(
	":username" => $username,
);

$query = $db->prepare("SELECT * FROM login WHERE username = :username;");
$query->execute($setUser);
$dataUser = $query->fetch(PDO::FETCH_ASSOC);

if ( $dataUser == false ){
	echo "<script>
		alert('User tidak ditemukan!');
		document.location='index.php';
	</script>";
}

else {
	$pengacak = "fahriganteng";
	$password = md5 ($password . $pengacak);
	
	if($dataUser["level"]== "admin"){
		if( $password == $dataUser["password"] ){
			$_SESSION["id"] = $dataUser["id"];
			$_SESSION["username"] = $dataUser["username"];
		
		echo "<script>
			alert('login berhasil!');
			document.location='index_admin.php';
		</script>";
		}
	}
		
	if($dataUser["level"]== "user"){
		if( $password == $dataUser["password"] ){
			$_SESSION["id"] = $dataUser["id"];
			$_SESSION["username"] = $dataUser["username"];
		
		echo "<script>
			alert('login berhasil!');
			document.location='index_user.php';
		</script>";
		}
	}
	
	else {
		echo "<script>
			alert('Password salah!');
			document.location='index.php';
		</script>";
	}
}

?>