<?php

session_start();
if (!isset($_SESSION['id']) ){
	echo "<script>
			alert('Anda belum login!');
			document.location='index.php';
		</script>";
}

$db = new PDO ( "mysql:host=127.0.0.1;dbname=photosting;", "root", "");

if ( $db !=true) {
	die ("Error");
}

$setPost = array(
	":idpost" => $_GET ['idpost']
);

$query = $db->prepare("SELECT * FROM post WHERE idpost = :idpost");
$query->execute($setPost);
$dataAwal = $query->fetch(PDO::FETCH_ASSOC);

$query = $db->prepare("DELETE FROM post WHERE idpost = :idpost");
$delete = $query->execute($setPost);
if($delete != false){
	
	unlink($dataAwal['gambar']);
	
	echo"<script>
		alert('Berhasil!');
		document.location='index_user.php';
	</script>";
}
else{
	echo"<script>
		alert('Gagal!');
		document.location='index_user.php';
	</script>";
}

?>