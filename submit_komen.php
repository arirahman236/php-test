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

$teks = $_POST["teks"];
$idpost = $_POST["idpost"];

if (empty($teks) == true){
	echo"<script>
		alert('Inputan kosong!');
		document.location='detail_post.php?idpost={$idpost}';
	</script>";
}
else {
	$setPost = array (
		":id" 		=> $_SESSION["id"],
		":teks"		=> $teks,
		":idpost"	=> $idpost,
	);
	
	$query = $db->prepare("INSERT INTO komen (id, idpost, teks) VALUES (:id, :idpost, :teks);");
	$query->execute($setPost);
	
	echo "<script>
		alert('Berhasil!');
		document.location='detail_post.php?idpost={$idpost}';
	</script>";
}

?>