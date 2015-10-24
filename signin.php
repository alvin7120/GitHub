<?php
	session_start();
	
	if(!empty($_SESSION['login_user'])){
		header("location: staff_index.php");
	}
	
	if (!empty($_POST['submit'])) {
		$db = new mysqli("localhost","root","csis2014","hotel");
		if ($db->connect_error) {
			die("Connection failed: " . $db->connect_error);
		}
		if(empty($_POST['admin'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];

			$sql = "SELECT * FROM staff WHERE username='$username' AND password = sha1('$password')";
			$result = $db->query($sql);

			if ($result->num_rows ) {
				while($row = $result->fetch_assoc()) {
					$login_user = $row['username'];
					$_SESSION['login_user'] = $login_user;
					echo "<script> window.location.href='staff_index.php'; </script>";
					
				}
			} else {
					echo "<script> alert('Username or Password incorrect!') </script>";
			}
		}else{
			$username = $_POST['username'];
			$password = $_POST['password'];
					
			$sql = "SELECT * FROM admin WHERE username='$username' AND password = sha1('$password')";
			$result = $db->query($sql);
					
					if ($result->num_rows ) {
				while($row = $result->fetch_assoc()) {
					$login_user = $row['username'];
					$_SESSION['login_user'] = $login_user;
					echo "<script> window.location.href='admin_index.php'; </script>";
					
				}
			} else {
					echo "<script> alert('Username or Password incorrect!') </script>";
			}
		}
		$db->close();
	}
?>

<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./img/favicon.ico">

    <title>Sign in</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="./javascript/ie-emulation-modes-warning.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./javascript/ie10-viewport-bug-workaround.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <style>
	body {
	color:#3071a9;
	}
	.title {
	text-align:center;
	font-weight:bold;
	margin-top:-20px;
	padding-bottom:20px;
	font-size:30px;
	}
  </style>

  <body valign="middle">

    <div class="container" >

	    <h1 align="center" style="font-family:Century Gothic;font-weight:bold;">Hotel Management System</h1><br/><br/>
		
      <form class="form-signin"  method="POST">
		<h3 class="title" >Log in</h3>
        <input name="username" type="text" class="form-control" placeholder="Username" required autofocus>
        <input name="password" type="password" class="form-control" placeholder="Passwords" required>
        <label class="checkbox" style="padding-top:15px;">
          <input name="admin" type="checkbox" value="remember-me"> Login as administrator
        </label><br/>
        <input class="btn btn-lg btn-primary btn-block" name="submit" type="submit" value="Sign in"/>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
