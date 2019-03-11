<?php 
session_start();
$connect = mysqli_connect("localhost", "root", "", "e-sports") or die ("Povezave z zbirko ni mogoče vzpostaviti");
if (isset($_POST["loggin_btn"])) {
	$username = mysqli_real_escape_string($connect, $_POST['username']);
	$password = mysqli_real_escape_string($connect, $_POST['password']);

	$password = md5($password); //koda je HASHED
	$sql = "SELECT * FROM uporabnik WHERE username ='$username'  AND password = '$password'";
	$result = mysqli_query($connect,$sql);

	if (mysqli_num_rows($result) == 1) {
		$_SESSION['message'] = "You are now logged in";
		$_SESSION['uporabnik'] = $username;
		header("location: index.php"); //redirect to home page
	}
	else {
		echo  "Uporabniško ime ali gesto nista pravilna";
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>login form</title>
	<link rel="stylesheet" type="text/css" href="header.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<form action="login.php" method="post">
<p>Za nadaljevanje vpišite vaše <br>uporabniško ime in geslo:<br> </p>
	<input type="text" name="username" placeholder="Uporabniško ime" required=""><br>
	<input type="password" name="password" placeholder="Geslo" required=""><br>
</body>
</html>
