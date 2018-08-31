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
?>

<html>
	<head>
		<title>PhotosTing</title>
		<link href="style.css" rel="stylesheet">
	</head>

	<body>
		<div id="timelinecontainer">
		
			<?php require_once("timelinemenu.php"); ?>
			
			<div id="timeline">
				
				<?php
				$setPost = array(
					":idpost" => $_GET['idpost']
				);
				$query = $db->prepare("
					SELECT * FROM post LEFT JOIN login ON post.id = login.id
					WHERE idpost = :idpost
				");
				
				$query->execute($setPost);
				
				$data = $query->fetch(PDO::FETCH_ASSOC);
				
				$setLike = array(
					':idpost'	=> $data['idpost'],
					':id'		=> $_SESSION['id'],
				);
				
				$queryLike = $db->prepare('SELECT * FROM likes WHERE idpost= :idpost AND id = :id');
				$queryLike->execute($setLike);
				$likes = $queryLike->fetch(PDO::FETCH_ASSOC);
				
				$setLike = array(
				':idpost' => $data['idpost'],
			);
			
			$queryLike = $db->prepare('SELECT COUNT(*) as total FROM likes WHERE idpost = :idpost');
			$queryLike->execute($setLike);
			$likeCount = $queryLike->fetch(PDO::FETCH_ASSOC);
				
//membedakan tampilan yang sudah dilike dan belum
			if ($likes == false) {
				$likeButton = '<a href="like.php?idpost='.$dt['idpost'].'">Liked</i></a> ';
			}
			else {
				$likeButton = $likeCount['total'].' Liked ';
			}
			
			if ($_SESSION['id'] == $data['id']) {
				$button = '<a href="update.php?idpost='.$data['idpost'].'">Update</a>
					<a href="javascript:hapus('.$data['idpost'].')">Delete</a>';
			}
			else{
				$button = '';
			}
			
			echo '<div class="card">
				<img src="'.$data['gambar'].'"/>
				<p>
					<b>'.$data['username'].'</b>: '.$data['teks'].'
				</p>
				<div>
					'.$likeButton.$button.'
				</div>
				
			</div>';
				
				$setKomen = array(
					":idpost" => $_GET['idpost']
				);
				
				$query = $db->prepare("
					SELECT *
					FROM komen
					LEFT JOIN login ON komen.id = login.id WHERE idpost = :idpost
				");
				
				$query->execute($setPost);
				$data = $query->fetchAll(PDO::FETCH_ASSOC);
				
				echo "<h3>Komentar</h3>";
				foreach($data as $dt) {
					echo '<div class="card">
					
						<p>
							<b>'.$dt['username'].'</b>: '.$dt['teks'].'
						</p>
					</div>';
				}
				
				?>
				
				<form action ="submit_komen.php" method="POST">
					<div class="grup">
						<input type="hidden" name="idpost" value="<?=$_GET['idpost']?>" />
						<input type="text" name="teks" placeholder="Tulis Komentar. . ." />
					</div>
				</form>
			
			</div>
		</div>
		
		<script>
		function hapus(idpost){
			if (confirm("Are you sure?")){
				document.location = "delete.php?idpost=" + idpost;
			}
		}
		</script>
	</body>
</html>