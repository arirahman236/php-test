<?php
	session_start ();
	//isset: mengecek jika variabel sudah dideklarasikan
	if ( !isset($_SESSION['id']) ){
		echo "<script>
					alert('anda belum login!');
					document.location='index.php';
			</script>";
	}
	$db = new PDO( "mysql:host=127.0.0.1;dbname=photosting;", "root", "" );

	if ( $db != true ) {
		die ("Error"); 
	}
?>
<?php
			/*
			* searching logic
			*/
			
			// ketika terdeteksi variabel param search
			if (isset ($_GET['search'])) {
				$key = $_GET['search'];
				
				//sintax searching menggunakan operator LIKE
				//'% menunjukkan karakter lain yang ada di dalam sebuah text
				// [...]% => akan mencari kata yang berawalan dengan kata kunci
				// %[...] => akan mencari kata yang berakhiran dengan kata kunci
				// %[...]% => akan mencari kata yang menggandung dengan kata kunci secara keseluruhan
				$search = "WHERE teks LIKE '%{$key}%'";
			}
			// ketika tidak terdeteksi variabel param search
			else {
				$key = "";
				$search = "";
			}
			/*
			* end of searching logic
			*/
			?>
<html>

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PhotosTing</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
	<link href="common-css/ionicons.css" rel="stylesheet">
	<link href="single-post-1/css/styles.css" rel="stylesheet">
	<link href="single-post-1/css/responsive.css" rel="stylesheet">

  </head>

  <body id="page-top">

	<div class="navbar navbar-expand navbar-dark bg-dark static-top ">

      <a class="logo  href="#"><img src="logo1.png "></a>

      

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Navbar -->
     

    </div>

    <div id="wrapper">
	
      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
	  <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>
		<li class="nav-item active">
          <a class="nav-link" href="createpost.php">
            <i class="ion-ios-plus-outline"></i>
            <span>POST</span></a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="#">
            <i class="ion-home"></i>
            <span>Home</span>
          </a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="profile.php">
            <i class="ion-ios-contact"></i>
            <span>Profile</span></a>
        </li>
		<li class="nav-item ">
          <a class="nav-link" href="logout.php">
            <i class="ion-log-out"></i>
            <span>Logout</span>
          </a>
        </li>
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">
		
          <!-- Icon Cards-->
	<section class="post-area section">
		<div class="container">

			<div class="row">

				<div class="col-lg-12 col-md-12 no-right-padding">

					<div class="main-post">

						<div class="blog-post-inner">

							<div class="post-info">
			<?php
			
			$query = $db->prepare("SELECT *
				FROM post
				LEFT JOIN login ON post.id = login.id
				{$search}
				ORDER BY idpost DESC 
			");
			$query->execute();
			
			$data = $query->fetchAll (PDO::FETCH_ASSOC);
			if (sizeof($data) == 0){
				echo "Not found!";
			}
			else {
			
				foreach($data as $dt) {
						
						$setLike = array(
							':idpost' 	=> $dt['idpost'],
							':id' 		=>	$_SESSION['id'],
						);
						
						$queryLike = $db->prepare('SELECT * FROM likes WHERE idpost= :idpost AND id = :id');
						$queryLike->execute($setLike);
						$likes = $queryLike->fetch(PDO::FETCH_ASSOC);
						
						$setLike = array(
							':idpost' => $dt['idpost'],
						);
						
						$queryLike =  $db->prepare('SELECT COUNT (*) as total FROM likes WHERE idpost = :idpost');
						$queryLike->execute($setLike);
						$likeCount = $queryLike->fetch(PDO::FETCH_ASSOC);
						
						if ($likes == false){
							$likeButton = '<a href="like.php?idpost='.$dt['idpost'].'">Like</a>';
						}
						else{
							$likeButton = $likeCount['total'].' Liked ';
						}
						
						if ($_SESSION['id'] == $dt['id']){
							$button = '- <a href="update.php?idpost='.$dt['idpost'].'">Update</a>
								<a href="javascript:hapus('.$dt['idpost'].')">Delete</a>';
						}
						else{
							$button = '';
						}
						
						echo '<a href="detail_post.php?idpost='.$dt['idpost'].'"><div class="card">
						'.$dt['username'].'
						<img src="'.$dt['gambar'].'" />
						<p>
							<b>'.$dt['username'].'</b>: '.$dt['teks'].'
						</p>
						<div>
							'.$likeButton.$button.'
						</div>
					</div></a>';
				
				}
			}
			?>
			</div>
		</div>
	</div>
					</div>
				</div>
			</div>
			</div>
		</div>
	</section>	
		<script>
		function hapus(idpost){
			if(confirm ("Are you sure?")) {
				document.location = "delete.php?idpost=" +idpost;
			}
		}
		</script>
		
          </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>

  </body>

</html>
