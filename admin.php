<?php 
session_start();
$connect = mysqli_connect("localhost", "root", "", "e-sports") or die ("nemorem povezati z db");
$username = $_SESSION['uporabnik'];
$sql_uporabnik = "SELECT * FROM uporabnik WHERE username = '$username'" ;
$result_uporabnik = mysqli_query($connect, $sql_uporabnik);
$sql_izplacila = "SELECT * FROM transakcije WHERE namen_trs = 'Izplačilo'" ;
$result_izplacila = mysqli_query($connect, $sql_izplacila) or die ("mofo");
$sql_transakcije = "SELECT * FROM transakcije WHERE username = '$username'" ;
$result_transakcije = mysqli_query($connect, $sql_transakcije);
$sql_vplacila = "SELECT * FROM transakcije WHERE namen_trs = 'Vplačilo'" ;
$result_vplacila = mysqli_query($connect, $sql_vplacila) or die ("mofo");

if (isset($_POST['nakazi'])) {
$st_vplacila = mysqli_real_escape_string($connect, $_POST['st_vplacila']);
$racun = mysqli_real_escape_string($connect, $_POST['racun']);
$izberi_uporabnika = "SELECT * FROM uporabnik WHERE username = '$racun' ";
$sql_izberi = mysqli_query($connect,$izberi_uporabnika);
while ($row = mysqli_fetch_array($sql_izberi)) {
	$staro_stanje = $row["denarnica"];
	$novo_stanje = $staro_stanje + $st_vplacila;
}
$sql_vplacilo_trs = "INSERT INTO transakcije (username, namen_trs, vrednost_trs, staro_stanje, novo_stanje , bancni_racun, status) VALUES ('$racun', 'Vplačilo' ,'$st_vplacila', '$staro_stanje', '$novo_stanje', 'Paypall', 'Končana')"  ;
mysqli_query($connect,$sql_vplacilo_trs) or die("nemorem nakazati");
$sql_posodobi_denarnico = "UPDATE uporabnik SET denarnica = '$novo_stanje' WHERE username= '$racun'";
mysqli_query($connect, $sql_posodobi_denarnico) or die("nemorem posodobiti denarnice"); }
?>



<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="styles/main.css">
</head>
<body class="index">
<?php include "header.php" ?>
<div class="container"><br>
<h1>Admin stran za transakcije</h1>
<br>
<div class="transakcije_proces">

<h2> Izplačila  </h2>
<?php //tabela za trasakcije, ki se niso odobrene  
		echo "<table border = 1  class='table table-striped table-bordered'>";
		echo "<tr><td>Št. transakcije</td><td>Uporabnik</td><td>Namen</td><td>Vrednost</td><td>Bančni račun</td><td>Status</td></tr>";
	while ($row = mysqli_fetch_assoc($result_izplacila)) {
		echo "<tr><td>{$row['st_trs']}</td><td>{$row['username']}</td><td>{$row['namen_trs']}</td><td>{$row['vrednost_trs']}€</td><td>{$row['bancni_racun']}</td><td>{$row['Status']}</td></td></tr>";}
		echo "</table>";


?>
</div>
<div class="izplacilo_trs">
	<h2>Izplačilo transakcij</h2><br>
	<form action="admin.php" method="post">
		Št. transakcije: <input type="number" style="border-radius: 8px;" name="st_trs"></input>
		<input type="submit" class="btn btn-primary" name="izplacaj_trs" value="Najdi transakcijo"></input><br><br>
		<?php 
			if (isset($_POST['izplacaj_trs'])) {
				$st_trs = mysqli_real_escape_string($connect, $_POST['st_trs']);
				$sql_izplacaj_trs = "SELECT * FROM transakcije WHERE st_trs = '$st_trs'" ;
				$result_izplacaj_trs = mysqli_query($connect, $sql_izplacaj_trs);
			while ($row = mysqli_fetch_array($result_izplacaj_trs)) { ?> 
		Št. transakcije: <?php echo $row['st_trs']?><br>	
		Izplačaj: <?php echo $row['vrednost_trs'];?>€,<br>
		Na račun: <?php echo $row['bancni_racun'] ?> <br>
		Igralcu: <?php echo $row['username'];?><br>
		Namen: <?php echo $row['namen_trs'];?><br>
		Status: <?php echo $row['Status'];?>
		<br>
		<input type="submit" class="btn btn-primary" name="izplacaj" value="Izplačaj"></input>
		<?php 
			if (!isset($_POST['izplacaj'])) {
				$sql_update = "UPDATE transakcije SET Status = 'Končana' WHERE st_trs = '$st_trs'";
				$potrdi_izplacilo = mysqli_query($connect, $sql_update) or die("lelel");
				
			}
		?>
		<?php }} ?>
		
	</form>
</div>
<br>

<div class="vplacila_proces">

<h2> Vplačila </h2>
<form action="admin.php" method="post">
		Nakaži: <input type="number" style="border-radius: 8px;" name="st_vplacila"></input>€ uporabniku:
		<input type="text" style="border-radius: 8px;" name="racun">
		<input type="submit" name="nakazi" class="btn btn-primary" value="Nakaži"></input><br><br>

	</form>

</div>
<div class="izplacilo_trs">
	<h2>Vsa vplačila</h2><br>
	
	<?php //tabela za vplačila, ki se niso odobrene  
		echo "<table class='table table-striped table-bordered' border = 1>";
		echo "<tr><td>Št. transakcije</td><td>Uporabnik</td><td>Namen</td><td>Vrednost</td></tr>";
	while ($row = mysqli_fetch_assoc($result_vplacila)) {
		echo "<tr><td>{$row['st_trs']}</td><td>{$row['username']}</td><td>{$row['namen_trs']}</td><td>{$row['vrednost_trs']}€</td></td></tr>";}
		echo "</table>";


?>
</div>

</div>
</body>
</html>