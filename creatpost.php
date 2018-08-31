<?php
session_start();


?>

<html>
	<head>
		<title>PhotosTing - Creat Post</title>
		<link href="style.css" rel="stylesheet">
	</head>
	
	<body>
		<div id="timelinecontainer">
		
		
		
			<div id="timeline">
					
				<form name = "upload" method="post" action="submitpost.php" enctype="multipart/form-data">
					
					<div class="form">
						<div class="grup">
							<input type="file"  name="file">
						</div>
						
						<div class="grup">
							<textarea name="teks" placeholder="Tulis keterangan..."></textarea>
						</div>
			
						<div class="grup">
							<input type="submit" name="submit" value="save" />
						</div>
					</div>
				</form>
			</div>
			<div class="displayMiddle">
		<a href="new.html">Back</a>
	</div>
		</div>
	</body>
</html>