<?php

session_start();

if ( !isset($_SESSION['id']) ) {
	echo "<script>
			alert('Anda belum login!');
			document.location='index.php';
			</script>";
}

$db = new PDO("mysql:host=127.0.0.1;dbname=photosting;", "root", "");

if ( $db !=true ) {
	die ("Error");
}

//mengatur array untuk query
$setPost = array(
	":idpost" => $_POST['idpost']
);

//mengambil data awal sebelum diedit
$query = $db->prepare("SELECT * FROM post WHERE idpost = :idpost");
$query->execute($setPost);
$dataAwal = $query->fetch(PDO::FETCH_ASSOC);

$teks = $_POST["teks"];
$file = $_FILES["file"];

//ketika terdapat file baru / mengupdate gambar
if ( empty($file["name"]) != true ) {
	
	//explode: memecah string jadi array berdasarkan karakter
	$filetype = explode("/", $file["type"]); //isi filetype: image/jpeg, kita pisah berdasarkan /
	
	//alamat direktori tempat penyimpanan file yg telah diupload
	$fileLocation = "files/" .date("YmdHis") . "." . $filetype[1];
	
	//move_uploaded_file([alamat penyimpanan sementara di browser], [tempat penyimpanan di server])
	$upload = move_uploaded_file($file["tmp_name"], $fileLocation);
	
	//menghapus file lama
	unlink($dataAwal['gambar']);

}
else{
	//file location diisi dengan dataAwal lama
	$fileLocation = $dataAwal['gambar'];
}

//ketika file baru berhasil di upload atau tidak tejadi pembaruan file gambar
if ( $upload == true || $fileLocation == $dataAwal['gambar'] ) {
	$setPost = array (
		":idpost"	=> $_POST['idpost'],
		":teks"		=> $teks,
		":gambar"	=> $fileLocation,
);

$query = $db->prepare("UPDATE post SET teks = :teks, gambar = :gambar WHERE
idpost = :idpost;");

$query->execute($setPost);

echo "<script>
	alert('Berhasil!');
	document.location='index_user.php';
	</script>";
}
else {
	echo "<script>
		alert('Upload Gagal!');
		document.location='createPost.php';
		</script>";
}
?>