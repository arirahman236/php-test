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

$teks = $_POST["teks"];
$file = $_FILES["file"];

if ( empty($teks) == true || empty ($file["name"]) == true ){
	echo "<script>
		alert('inputan kosong!');
		document.location='createpost.php';
	</script>";
}
else {
	$filetype = explode("/", $file["type"]);
	$fileLocation = "files/" . date("YmdHis") . "." . $filetype[1];
}

	$upload = move_uploaded_file($file["tmp_name"], $fileLocation);

	if ( $upload == true ){
		$setPost = array(
			":id" 	  => 	$_SESSION["id"],
			":teks"	  => 	$teks,
			":gambar" => 	$fileLocation,
		);
		
		$query = $db->prepare("INSERT INTO post ( id, teks,gambar) VALUES ( :id, :teks, :gambar);");
		$query->execute($setPost);
		
		echo "<script>
			alert ('berhasil!');
			document.location='index_user.php';
		</script>";
	}
	else {
		
	}

?>