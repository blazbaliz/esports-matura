<?php 
session_start();
$connect = mysqli_connect("localhost", "root", "", "e-sports") or die ("nemorem povezati z db");
$username = $_SESSION['uporabnik'];
$sql = "SELECT * FROM uporabnik WHERE username = '$username'" ;
$result = mysqli_query($connect, $sql);
if (isset($_POST['shrani'])) {
	$ime = mysqli_real_escape_string($connect, $_POST["ime"]);
	$priimek = mysqli_real_escape_string($connect, $_POST["priimek"]);
	$ulica = mysqli_real_escape_string($connect, $_POST["ulica"]);
	$hisna_st = mysqli_real_escape_string($connect, $_POST["hisna_st"]);
	$postna_st = mysqli_real_escape_string($connect, $_POST["postna_st"]);
	$kraj = mysqli_real_escape_string($connect, $_POST["kraj"]);
	$telefonska_st = mysqli_real_escape_string($connect, $_POST["telefonska_st"]);
	$starost = mysqli_real_escape_string($connect, $_POST["starost"]);
	#sql kode za spremembo podatkov v tabelah
	$sql_update_ime = "UPDATE uporabnik SET ime = '$ime' WHERE username = '$username'";
	$sql_update_priimek = "UPDATE uporabnik SET priimek = '$priimek' WHERE username = '$username'";
	$sql_update_ulica = "UPDATE uporabnik SET ulica = '$ulica' WHERE username = '$username'";
	$sql_update_hisna_st = "UPDATE uporabnik SET hisna_st = '$hisna_st' WHERE username = '$username'";
	$sql_update_postna_st = "UPDATE uporabnik SET postna_st = '$postna_st' WHERE username = '$username'";
	$sql_update_kraj = "UPDATE uporabnik SET kraj = '$kraj'";
	$sql_update_telefonska_st = "UPDATE uporabnik SET telefonska_st = '$telefonska_st' WHERE username = '$username'";	
	#ukazi za spremembo podatkov v tabelah
	$update_ime = mysqli_query($connect, $sql_update_ime);
	$update_priimek = mysqli_query($connect, $sql_update_priimek) or die ("lolo");
	$update_ulica = mysqli_query($connect, $sql_update_ulica);
	$update_hisna_st = mysqli_query($connect, $sql_update_hisna_st);
	$update_postna_st = mysqli_query($connect, $sql_update_postna_st);
	$update_kraj = mysqli_query($connect, $sql_update_kraj);
	$update_telefonska_st = mysqli_query($connect, $sql_update_telefonska_st);
	header("location: profil.php"); //preusmeri nazaj na osnovno stran profila
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
			Osnovne informacije	
		</td>
	</tr>
	<tr>
		<td>
			Varnost
		</td>
	</tr>
	<tr>
		<td>
			Denarnica	
		</td>
	</tr>
</table>	
</div>
<br>
<?php
if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_array($result)) {
?>
<div class="uredi_profil">
<form action="uredi_profil.php" method="post">
Uporabniško ime: <br>
	<?php echo $row["username"]; ?> <br>
Ime in Priimek: <br>
	<input type="text" name="ime" placeholder="<?php echo $row["ime"]?>" >
	<input type="text" name="priimek" placeholder="<?php echo $row["priimek"] ?>"><br>
Naslov:<br>
	<input type="text" name="ulica" placeholder="<?php echo $row["ulica"]?>">
	<input type="number" name="hisna_st" placeholder="<?php echo $row["hisna_st"]?>"><br>
Pošta:<br>
	<input type="number" name="postna_st" placeholder="<?php echo $row["postna_st"]?>" >
	<input type="text" name="kraj" placeholder="<?php echo $row["kraj"]?>"><br>
Telefonska št:<br>
	<input type="number" name="telefonska_st" placeholder="<?php echo $row["telefonska_st"]?>" >
	<br>
Starost:<br>
	<input type="number" name="starost" placeholder="<?php echo $row["starost"]?>" ><br>
	<input type="submit" name="shrani" value="Shrani">
</form>
</div>

<?php
	}
}
 ?>

</div>
</body>
</html>