<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V2</title>
	
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form action = "submitregister.php" method="POST" class="login100-form validate-form">
					<a class="logo  href="#"><img src="logo.png "></a>
					
					<div class="wrap-input100" >
						Usernamae
						<input class="input100"  type="text" name="username">
						<span class="focus-input100"></span>
					</div>


					<div class="wrap-input100 validate-input" data-validate="Valid email is: a@b.c">
						Email
						<input class="input100"  type="text"  name="email">
						<span class="focus-input100"></span>
					</div>
					
					
					<div class="wrap-input100 validate-input" >
						Telepon
						<input class="input100"  type="number"  name="telepon">
						<span class="focus-input100"></span>
					</div>
					
					<div class="wrap-input100" >
					<span name="jk"></span>
						
						<tr>
						<td>
							<select name="jk">
								<option value="L">L</option>
								<option value="P">P</option>
							</select>
						</td>
					</tr>
					</div>
					
					<div class="wrap-input100" >
						Tanggal Lahir
						<input class="input100" type="date" name="tgl">
						<span class="focus-input100"></span>
						
					</div>
					
					<div class="wrap-input100 validate-input" data-validate="Enter password">
						Password
						<input class="input100"  type="password"  name="password">
						<span class="focus-input100"></span>
					</div>
					
					<div class="wrap-input100 validate-input" data-validate="Enter password">
						Confirm Password
						<input class="input100"  type="password"  name="confirmpassword">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Submit
							</button>
						</div>
					</div>

					<div class="text-center p-t-115">

						<a class="txt2" href="index.php">
							Back
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	

	<script src="js/main.js"></script>

</body>
</html>