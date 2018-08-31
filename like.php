<?php

session_start();

if ( !isset($_SESSION['id']) ) {
	echo "<script>
			alert('Anda belum logn!');
			document.location='index.php';
		</script>";
}

$db = new PDO("mysql:host=127.0.0.1;dbname=photosting;", "root", "" );

if ( $db != true ) {
	die ("Error");
}

$idpost = $_GET["idpost"];

$setPost = array (
	":id"		=> $_SESSION["id"],
	":idpost"	=> $idpost,
);

$query = $db->prepare("INSERT INTO likes (idpost, id) VALUES (:idpost, :id);");
$query->execute($setPost);

echo "<script>
	alert('Berhasil!');
	document.location= 'index_user.php';
	</script>";
?>