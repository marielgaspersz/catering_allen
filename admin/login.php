<?php include "../inc/config.php"; ?>
<?php
if (!empty($_SESSION['iam_admin'])) {
	redir("index.php");
}

if (!empty($_POST)) {
	extract($_POST);
	$password = md5($password);

	// Cek apakah email terdaftar
	$q_email = mysql_query("SELECT * FROM user WHERE email='$email' AND status='admin'") or die(mysql_error());
	if (mysql_num_rows($q_email) > 0) {
		// Jika email terdaftar, cek password
		$q = mysql_query("SELECT * FROM user WHERE email='$email' AND password='$password' AND status='admin'") or die(mysql_error());
		if (mysql_num_rows($q) > 0) {
			$r = mysql_fetch_object($q);
			$_SESSION['iam_admin'] = $r->id;
			redir("index.php");
		} else {
			alert("Kata sandi salah");
		}
	} else {
		alert("Email tidak terdaftar");
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Login Form</title>

	<link rel='stylesheet' href='../assets/bootstrap/css/bootstrap.min.css'>
	<link rel="stylesheet" href="../assets/css/style_login.css">

</head>

<body>
	<div class="wrapper">
		<form class="form-signin" action="" method="POST">
			<h2 class="form-signin-heading">Silahkan login</h2>
			<input style="margin-bottom:20px;" type="email" class="form-control" name="email" placeholder="Email" required="" autofocus="" />
			<input type="password" class="form-control" name="password" placeholder="Password" required="" />
			<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
		</form>
	</div>

</body>

</html>