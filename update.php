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

$setPost = array(
	":idpost"	=> $_GET['idpost']
);

$query = $db->prepare("SELECT * FROM post WHERE idpost = :idpost");
$query->execute($setPost);
$data  = $query->fetch(PDO::FETCH_ASSOC);

?>



<html>

    <head>

        <title>PhotosTing-imageupload</title>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="dist/css/bootstrap-imageupload.css" rel="stylesheet">

        <style>
            body {
                padding-top: 70px;
            }

            .imageupload {
                margin: 20px 0;
            }
        </style>

    </head>

    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
			<a class="logo  href="#"><img src="logo1.png "></a>
                </div>
            </div>
        </nav>

        <div class="container">


            <!-- bootstrap-imageupload. -->
			
		<form name = "upload" method="post" action="submitpost.php" enctype="multipart/form-data">
		<input type="hidden" name="idpost" value="<?php echo $_GET[
					'idpost']; ?>">
            <div class="imageupload panel panel-default">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title pull-left">Upload Image</h3>
                    
                </div>
				<?php echo "<img src='".$data["gambar"]."' width='100px'>"; ?>
                <div class="file-tab panel-body">
				
                    <label class="btn btn-default btn-file">
					
                        <span>Browse</span>
                        <!-- The file is stored here. -->
                        <input type="file" name="file">
                    </label>
                    <button type="button" class="btn btn-default">Remove</button>
                </div>
                
                    <div class="input-group">
                        <textarea name="teks" placeholder="What do you think?">
							<?php echo $data["teks"]; ?></textarea>
                        <div class="input-group-btn">
                            <button type="submit" name="submit" value="save" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                   
                    <!-- The URL is stored here. -->
                    
                
            </div>
		</form>
            <!-- bootstrap-imageupload method buttons. -->
            <button type="button" ><a href="index.html">Back</a></button>
			

        </div>

        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="dist/js/bootstrap-imageupload.js"></script>

        <script>
            var $imageupload = $('.imageupload');
            $imageupload.imageupload();

            $('#imageupload-disable').on('click', function() {
                $imageupload.imageupload('disable');
                $(this).blur();
            })

            $('#imageupload-enable').on('click', function() {
                $imageupload.imageupload('enable');
                $(this).blur();
            })

            $('#imageupload-reset').on('click', function() {
                $imageupload.imageupload('reset');
                $(this).blur();
            });
        </script>

    </body>

</html>