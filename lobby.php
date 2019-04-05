<?php 
session_start();
$connect = mysqli_connect("localhost", "root", "", "e-sports") or die ("nemorem povezati z db");
$username = $_SESSION['uporabnik'];
$sql_tekme = "SELECT * FROM tekme";
$result_tekme = mysqli_query($connect, $sql_tekme) or die("can not select tekme");
#ustvari igro
if (isset($_POST['create_game'])) {
	session_start();
	$session_id = session_id();
	$igra = mysqli_real_escape_string($connect, $_POST['game']) or die ("a");
	$vrednost_stave = mysqli_real_escape_string($connect, $_POST['vrednost_stave']) or die ("b");
	$sql_create_game = "INSERT INTO tekme(gostitelj, vrednost_stave, igra,session_id) VALUES ('$username','$vrednost_stave','$igra','$session_id') " ;
	mysqli_query($connect, $sql_create_game) or die ("cannot create game");
	$sql_pridruzi_se = "SELECT * FROM tekme WHERE st = '$st_tekme'";
	$pridruzi_se= mysqli_query($connect,$sql_pridruzi_se) or die ('nemorem izbrati tekme;');
	while ($row = mysqli_fetch_assoc($pridruzi_se)){
	$_SESSION['gostitelj'] = $row['gostitelj'];
	ini_set("session.use_cookies",0);
	ini_set("session.use_trans_sid",1);
	header("location: igralnica.php?session_id=".$session_id ); 
	}}
if (isset($_POST['join'])) {
	while ($row = mysqli_fetch_assoc($result_tekme)) {
		$st_tekme = $row['st'];	
		break;
	}
	$sql_pridruzi_se = "SELECT * FROM tekme WHERE st = '$st_tekme'";
	$pridruzi_se= mysqli_query($connect,$sql_pridruzi_se) or die ('nemorem izbrati tekme;');
	while ($row = mysqli_fetch_assoc($pridruzi_se)){
	session_start();
	$_SESSION['izzivalec'] = $row['izzivalec'];
	header("location: igralnica.php?session_id=".$row['session_id'] ); 
}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php include "header.php" ?>
	<!-- ustvari igro -->

	<div class="create_game">
		<h4> Ustvari igro </h2>
			<form action="lobby.php" method="post">
				<input type="radio" name="game" value="FIFA 19"> Fifa 19</input>
				<input type="radio" name="game" value="NBA 2k19"> NBA 2k19</input>
				<input type="radio" name="game" value="UFC 3"> UFC 3</input>
				<br>
			Igrati želim za:  <br> 
				<input type="number" name="vrednost_stave"> €</input>
				<br>
				<input type="submit" name="create_game" value="Ustvari igro"></input>
			</form>
	</div>


	<!-- Igre -->
	<div class="games">
<?php
	while ($row = mysqli_fetch_assoc($result_tekme)) {
?>
	 <div class="igre">
	 <?php echo $row['igra'] ?> <br>
	 Gostitelj:	<?php echo $row['gostitelj'] ?><br>
	 Igraj za: <?php echo $row['vrednost_stave']."€" ?> Dobitek: <?php $dobitek = $row['vrednost_stave'] * 2; echo $dobitek."€" ?> <br>
	 <form action="lobby.php" method="post">
	 	 <input type="submit" name="join" value="Pridruži se">
	 </form>
	 </div>
	 <br>



<?php
	}
?>
	</div>
</body>
</html>