<?php 
session_start();
$connect = mysqli_connect("localhost", "root", "", "e-sports") or die ("nemorem povezati z db");
$username = $_SESSION['uporabnik'];
$sql = "SELECT * FROM uporabnik WHERE username = '$username'" ;
$result = mysqli_query($connect, $sql);
if (isset($_POST['shrani_mail'])) {
	$mail = mysqli_real_escape_string($connect, $_POST["new_mail"]);
	$sql_preverimail = "SELECT * FROM uporabnik WHERE mail = '$mail'";
	$rezultat_preverimail = mysqli_query($connect, $sql_preverimail);
	if (mysqli_num_rows($rezultat_preverimail) == 0) {
		$sql_update_mail = "UPDATE uporabnik SET mail = '$mail' WHERE username = '$username'";
		$update_mail = mysqli_query($connect, $sql_update_mail) or die("nemorem");
		header("location: varnost.php");
	}
	else { $error_mail = "Uporabniški račun z tem naslovom že obstaja <br>";}
}


if(isset($_POST['shrani_geslo'])) {
	$password1 = mysqli_real_escape_string($connect, $_POST['password1']);
	$password2 = mysqli_real_escape_string($connect, $_POST['password2']);
	if ($password1 == $password2) {
		$password1 = md5($password1);
		$sql_update_password = "UPDATE uporabnik SET password = '$password1' WHERE username = '$username'";
		$update_password = mysqli_query($connect, $sql_update_password);		
	}
	else {
		$error_password = "Vneseni gesli se ne ujemata <br>";
	}
}

?>

<!doctype <!DOCTYPE html>
<html>
<head>
	<title></title>
	
	
</head>
<body>
<?php include "header.php" ?>
<br>
<div class="profil">
<div class="sidebar">
<table>
	<tr>
		<td>	
		</td>
	</tr>
	<tr>
		<td>
			<a href="profil.php">Osnovne informacije</a>
		</td>
	</tr>
	<tr>
		<td>
			Varnost
		</td>
	</tr>
	<tr>
		<td>
			<a href="denarnica.php">Denarnica	
		</td>
	</tr>
</table>	
</div>
<br>
<?php
if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_array($result)) {
?>
<div class="varnost">
Vaš e-mail naslov: <button class="spremeni_mail">Uredi</button> <br>
<?php echo $row["mail"]; ?> <br>
Vaše geslo: <button class="spremeni_geslo">Uredi</button><br> 
******** <br>
</div>
<br> <br>
<!-- Pojavno okno spremeni mail-->
<div id="modal_mail" class="modal_mail">
	<form action="varnost.php" method="post">
	 <div class="modal_mail_content">
	 	<div class="modal_mail_header">
	 		Spremeni uporabniški e-mail naslov
	 	</div>
	 	<div class="modal_mail_bodi">
	 	<?php echo $error_mail ?>
	 	Vnesite vaš nov naslov:<br>
	 		<input type="text" name="new_mail" required placeholder="<?php echo $row["mail"]; ?>"></input>
	 	</div>
	 	<div class="modal_mail_footer">
	 		<input type="submit" name="shrani_mail" value="Shrani" ></input>
	 	</div>
	 	
	 </div>
	 </form>
</div>

<br><br>
<!-- Pojavno okno spremeni geslo-->
<div id="modal_geslo" class="modal_geslo">
	<form action="varnost.php" method="post">
	 <div class="modal_geslo_content">
	 	<div class="modal_geslo_header">
	 	Spremeni geslo:
	 	</div>
	 	<div class="modal_geslo_bodi">
	 	<?php echo $error_password ?>
	 	Vnesite novo geslo:<br>
	 	<input type="password" name="password1" required placeholder="********"></input><br>
	 	Potrdite novo geslo:<br>
	 	<input type="password" name="password2" required placeholder="********"></input>
	 	</div>
	 	<div class="modal_geslo_footer">
	 	<input type="submit" name="shrani_geslo" value="Shrani"></input>
	 	</div>
	 	
	 </div>
	 </form>
</div>
<?php
	}
}
 ?>

</div>
</body>
</html>