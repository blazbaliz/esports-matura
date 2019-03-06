<?php 
$connect = mysqli_connect("localhost", "root", "", "e-sports") or die ("Povezave z zbirko ni mogoče vzpostaviti");
	if (isset($_POST["register_btn"])) {
		session_start();
		$username = mysqli_real_escape_string($connect, $_POST["username"]);
		$ime = mysqli_real_escape_string($connect, $_POST["ime"]);
		$priimek = mysqli_real_escape_string($connect, $_POST["priimek"]);
		$email = mysqli_real_escape_string($connect, $_POST["email"]);
		$password = mysqli_real_escape_string($connect, $_POST["password"]);
		$password2 = mysqli_real_escape_string($connect, $_POST["password2"]);
		$starost = mysqli_real_escape_string($connect, $_POST["starost"]); 

		//if (strlen($password)>=8) { } else {echo "* Geslo mora vsebovati vsaj 8 znakov ";} 
		
		if ($password == $password2) {
			//naredi uporabnika
			$password = md5($password); //hash password
			$sql = "INSERT INTO uporabnik(username, ime , priimek, mail, password, starost) VALUES ('$username','$ime','$priimek', '$email', '$password', '$starost')";
			mysqli_query($connect, $sql) or die ("Nemorem narediti uporabnika");
			$_SESSION['sporocilo'] = 'Sedaj ste prijavljeni';
			$_SESSION['uporabnik'] = $username;
			header("location: index.php"); //preusmeri na domačo stran
			}
		else {
			echo "* Ponovljeno geslo se ne ujema";} 
		}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<form action="register.php" method="post" >
<h2 class="registracija"> Registracija </h2>
Prosimo vnesite naslednje podatke <br><br>
	<table>
		
		<tr>
			<td> <input type="text" name="username" pattern=".{6,}" required title = "Uporabniško ime mora biti sestavljeno iz najmanj 6 znakov" placeholder="Uporabniško ime"> </td>
		</tr>
		<tr>
			<td> <input type="text" name="ime" pattern=".{1,}" required placeholder="Ime"> </td>
		</tr>
		<tr>	
			<td> <input type="text" name="priimek" pattern=".{1,}" required placeholder="Priimek"> </td>
		</tr>
		<tr>
			<td> <input type="text" name="email" pattern=".{1,}" required  placeholder="Vaša e-pošta"> </td>
		</tr>
		<tr>
			<td> <input type="password" name="password" pattern=".{8,}" required title="Geslo mora vsebovati vsaj 8 znakov" placeholder="Geslo">
			 </td>
		</tr>
		<tr>
			<td> <input type="password" name="password2" pattern=".{8,}" required title="Geslo mora vsebovati vsaj 8 znakov" placeholder="Ponovno vnesite Geslo"> 
			</td>
		</tr>
		<tr>
			<td><input type="number" name="starost" pattern=".{1,}" required  placeholder="Starost"></td>
		</tr>
		<tr>
			<td><input type="Submit" name="register_btn" value="Registriraj se"></td>
		</tr>
	</table>
</body>
</html>