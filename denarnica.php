<?php 
session_start();
$connect = mysqli_connect("localhost", "root", "", "e-sports") or die ("nemorem povezati z db");
$username = $_SESSION['uporabnik'];
$sql = "SELECT * FROM uporabnik WHERE username = '$username'" ;
$result = mysqli_query($connect, $sql);
if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_array($result)) {
//koda za transakcijo
if (isset($_POST["izplacaj"])) {
	$vrednost_izplacaj = mysqli_real_escape_string($connect, $_POST["vrednost_izplacaj"]);
	$bancni_racun = mysqli_real_escape_string($connect, $_POST["bancni_racun"]);
	$staro_stanje = $row["denarnica"];
	$novo_stanje = $staro_stanje - $vrednost_izplacaj;
	if ($novo_stanje > 0 ) {
	$sql_izplacaj = "INSERT INTO transakcije(username, namen_trs, vrednost_trs, staro_stanje, novo_stanje, bancni_racun, status) VALUES ('$username', 'Izplačilo', '$vrednost_izplacaj', '$staro_stanje', '$novo_stanje', 'SI $bancni_racun', 'V procesu')" or die ("lalala");
	$izplacaj_trs = mysqli_query($connect, $sql_izplacaj);
	$sql_posodobi_denarnico = "UPDATE uporabnik SET denarnica = '$novo_stanje' WHERE username= '$username'";
	$posodobi_denarnico = mysqli_query($connect, $sql_posodobi_denarnico);
	header('location:denarnica.php');
	}
	else {
		$error_izplacaj = "Stanje na racunu je prenizko <br>";
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

<div class="denarnica">
	Trenutno stanje: <br>
	<?php echo $row['denarnica'] ?> € <br> <br>
	<button class="dodaj_denar">Kupi igralna<br> sredstva</button>
	<button class="izplacaj_denar">Izplačaj denarna <br> sredstva</button>
	<?php 
		if ($username == "lizba48") {  ?>
		<button class='admin_page'  onclick="window.location.href='admin.php'">Stran za <br> administratorje</button>
	<?php	;
			}
	  ?>
	 
	 <br> <br>
	<div class="popup_kupi">
		<img src="pic/paypal_logo.jpg" width="150px" height="50px">
		<img src="pic/mastercard_logo.jpg" width="100px" height="60px"> <br>
		Igralna sredstva nakazujemo vsak delovni dan ob 12:00!
	</div>
</div>
<br>

<!-- pojavna okna za kupovanje denarnih sredstev -->
	<div class="modal_paypal">
		<div class="modal_content_paypal">
			<div class="modal_header_paypal">
				<span class="zapri">&times;</span>
				<h2 class="">Paypal</h2>	
			</div> 
			<div class="modal_body_paypal">

			</div>
			<div class="modal_footer_paypal">
				
			</div>
		</div> 
	</div>
	 <br>

<!--pojavno okno za izplacila  -->
<div class="modal_izplacaj">
	<form action="denarnica.php" method="post">
		<div class="modal_content_izplacaj">
			<div class="modal_header_izplacaj">
				<h2>Izplačaj denarna sredstva</h2>
			</div>
			<div class="modal_body_izplacaj">
			<?php echo $error_izplacaj ?>
			Izplačati želim: <br>
			<input type="number" name="vrednost_izplacaj" required placeholder="Vnesi vrednost"></input> € <br>
			Na bančni račun: <br>
			SI <input type="text" name="bancni_racun" required placeholder="XXXX XXXX XXXX XXXX"></input><br> 
			</div>
			<div class="modal_footer_izplacaj"> 	
			<input type="submit" name="izplacaj" value="Potrdi"></input>
			</div>
		</div>
	</form>
</div>


<!-- tabela transakcije -->

<h2>Transakcije</h2>

<?php include "tabela_transakcije_uporabnik.php" ?>

<?php
	}
}
 ?>

</div>


</body>
</html>