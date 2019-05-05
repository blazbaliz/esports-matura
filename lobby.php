<?php 
session_start();
$connect = mysqli_connect("localhost", "root", "", "e-sports") or die ("nemorem povezati z db");
$username = $_SESSION['uporabnik'];
$sql_tekme = "SELECT * FROM tekme1 WHERE tekma_status = 'ni izzivalca' ";
$result_tekme = mysqli_query($connect, $sql_tekme) or die("can not select tekme");

#ustvari igro
if (isset($_POST['create_game'])) {
	$session_id = session_id();
	$uniqid = uniqid();
	$_SESSION['session_id'] = $uniqid;
	$_SESSION['uniqid'] = $uniqid;
	$igra = mysqli_real_escape_string($connect, $_POST['game']) or die ("a");
	$vrednost_stave = mysqli_real_escape_string($connect, $_POST['vrednost_stave']) or die ("b");
	$sql_create_game = "INSERT INTO tekme1 (gostitelj, izzivalec, vrednost_stave, igra,session_id, gostitelj_status, izzivalec_status, tekma_status, rezultat_gostitelj) VALUES ('$username', 'Ni izzivalca' ,'$vrednost_stave','$igra','$uniqid','nepripravljen','nepripravljen', 'ni izzivalca', '/') " ;
	mysqli_query($connect, $sql_create_game) or die ("cannot create game");
	$_SESSION['gostitelj'] = $row['gostitelj'];
	ini_set("session.use_cookies",0);
	ini_set("session.use_trans_sid",1);
	header("location: igralnica.php?session_id=".$uniqid ); 
	}
if (isset($_POST['join'])) {
	while ($row = mysqli_fetch_assoc($result_tekme)) {
		$st_tekme = $row['st'];	
		$session_id = $row['session_id'];
		$_SESSION['session_id'] = $session_id;
		break;
	}
	$sql_pridruzi_se = "SELECT * FROM tekme1 WHERE st = '$st_tekme'";
	$pridruzi_se= mysqli_query($connect,$sql_pridruzi_se) or die ('nemorem izbrati tekme;');
	while ($row = mysqli_fetch_assoc($pridruzi_se)){
	$sql_izivalec = "UPDATE tekme1 SET izzivalec = '$username', tekma_status = 'not_started' WHERE st = '$st_tekme' ";
	mysqli_query($connect, $sql_izivalec) or die ('cannot create izzivalec');
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
	 <?php echo $row['st']?>
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