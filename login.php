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
		echo "Uporabniško ime ali gesto nista pravilna";
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>login form</title>
</head>
<body>
<form action="login.php" method="post">
<h2 class="prijava"> Pozdravljeni </h2>
Za nadaljevanje vpišite vaše uporabniško ime in geslo <br> <br>

	<table>
		<tr>
			<td colspan="2"><input type="text" name="username" placeholder="Uporabniško ime"></td>
		</tr>
		<tr>
			<td colspan="2"><input type="password" name="password" placeholder="Geslo"></td>
		</tr>
		<tr>
			<td><input type="submit" name="loggin_btn" value="Prijava"></td>
			<td><input type="button" name="register" value="Registracija" onclick="window.location.href='register.php'"></td>
		</tr>
	</table>
</body>
</html>