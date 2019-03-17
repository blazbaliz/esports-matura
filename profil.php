<?php 
session_start();
$connect = mysqli_connect("localhost", "root", "", "e-sports") or die ("nemorem povezati z db");
$username = $_SESSION['uporabnik'];
$sql = "SELECT * FROM uporabnik WHERE username = '$username'" ;
$result = mysqli_query($connect, $sql)
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
			<a href="varnost.php">Varnost</a>
		</td>
	</tr>
	<tr>
		<td>
			<a href="denarnica.php">Denarnica</a>	
		</td>
	</tr>
</table>	
</div>
<br>
<?php
if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_array($result)) {
?>
<div class="osnovne_informacije">
Uporabniško ime: <br>
<?php echo $row["username"]; ?> <br>
Ime in Priimek: <br>
<?php echo $row["ime"]." ".$row["priimek"] ?> <br>
Naslov:<br>
	<?php echo $row["ulica"]." ".$row["hisna_st"];?><br>
Pošta:<br>
<?php echo $row["postna_st"]." ".$row["kraj"] ?><br>
Telefonska št:<br>
<?php echo $row["telefonska_st"] ?><br>
Starost:<br>
<?php echo $row["starost"] ?> <br>
</div>
<button class="uredi_profil" onclick="window.location.href='uredi_profil.php'">Uredi profil</button>
<?php
	}
}
 ?>

</div>


</body>
</html>