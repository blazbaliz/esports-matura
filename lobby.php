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
	$vrednost_stave = $_POST['vrednost_stave1'] or die ("be");
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
	<link rel="stylesheet" type="text/css" href="styles/main.css">
	<meta name="viewport" content="width=device widht, intial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="index">
	<div class="header"><?php include "header.php" ?></div>
<form action="lobby.php" method="post">
	<div class="subheader">
		<div class="notranji_subheader">
			<div class="lobby_sbhd">
					<!-- ustvari igro -->
				<span class="ustvari_igro">Ustvari igro:</span>&nbsp 
				<input type="radio" name="game" value="FIFA 19"> Fifa 19</input>&nbsp 
				<input type="radio" name="game" value="NBA 2k19"> NBA 2k19</input>&nbsp 
				<input type="radio" name="game" value="UFC 3"> UFC 3</input>&nbsp 
				Vrednost stave:
				<input type="number" name="vrednost_stave1" style="border-radius: 8px; width: 60px"> €</input> &nbsp
				<input type="submit" class="btn btn-primary" name="create_game" value="Potrdi"></input>
			</div>
		</div>
	</div>


	<div class="container" style="padding: 0 0 150px 0">
	<h4 style="float: left; padding: 10px 0 0 70px;"> Pridruži se že ustvarjeni igri </h4><br><br>
		<?php
	while ($row = mysqli_fetch_assoc($result_tekme)) {
?>
		<!-- Igre -->
	<div class="card" style="width: 18rem; margin: 10px ; display: inline-block;">
  		<div class="card-header" style="text-align: left; font-weight:bold; font-size: 18px">
			<?php echo $row['igra'] ?>
  		</div>
  		<div class="card-body">
  			<table class="table">
  				<tbody>
   					<tr>
      				<th scope="row" style="text-align: left">Gostitelj:</th>
      				<td><?php echo $row['gostitelj'] ?></td>
          			</tr>
    				<tr>
      				<th scope="row" style="text-align: left">Vrednost stave</th>
      				<td><?php echo $row['vrednost_stave']."€" ?></td>
    				</tr>
    				<tr>
      				<th scope="row" style="text-align: left">Dobitek</th>
      				<td><?php $dobitek = $row['vrednost_stave'] * 2; echo $dobitek."€" ?></td>
    				</tr>
    			</tbody>
  			</table>
			<input type="submit" class="btn btn-primary btn-sm" name="join" value="Pridruži se">
  		</div>
	</div>

<?php
	}
?>
</form>
</body>
</html>
