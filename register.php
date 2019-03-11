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
 		$sql_preveriuporabnika = "SELECT * FROM uporabnik WHERE username = '$username'";
 		$rezultat_preveriuporabnika = mysqli_query($connect, $sql_preveriuporabnika);
 		$sql_preverimail = "SELECT * FROM uporabnik WHERE mail = '$email' ";
 		$rezultat_preverimail = mysqli_query($connect, $sql_preverimail);
 		if (mysqli_num_rows($rezultat_preverimail) == 0 ) {
			if(mysqli_num_rows($rezultat_preveriuporabnika) == 0){
				if ($password == $password2) {
					//naredi uporabnika
					$password = md5($password); //hash password
					$sql = "INSERT INTO uporabnik(username, ime , priimek, mail, password, starost) VALUES ('$username','$ime','$priimek', '$email', '$password', '$starost')";
					mysqli_query($connect, $sql) or die ("Nemorem narediti uporabnika");
					$_SESSION['sporocilo'] = 'Sedaj ste prijavljeni';
					$_SESSION['uporabnik'] = $username;
					header("location: index.php"); //preusmeri na domačo stran
					}
				else {echo "* Ponovljeno geslo se ne ujema";} }
			else {echo "Uporabniško ime že obstaja";} }
		else {echo "Email že obstaja";}		
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<form action="register.php" method="post" >
Za registracijo na spletnem portalu vnesite naslednje podatke:<br><br>
<input type="text" name="username" pattern=".{6,}" required title = "Uporabniško ime mora biti sestavljeno iz najmanj 6 znakov" placeholder="Uporabniško ime"> 
<input type="text" name="ime" pattern=".{1,}" required placeholder="Ime">
<input type="text" name="priimek" pattern=".{1,}" required placeholder="Priimek">
<input type="text" name="email" pattern=".{1,}" required  placeholder="Vaša e-pošta">
<input type="password" name="password" pattern=".{8,}" required title="Geslo mora vsebovati vsaj 8 znakov" placeholder="Geslo">
<input type="password" name="password2" pattern=".{8,}" required title="Geslo mora vsebovati vsaj 8 znakov" placeholder="Ponovno vnesite Geslo">
<input type="number" name="starost" pattern=".{1,}" required  placeholder="Starost"><br>

</body>
</html>
