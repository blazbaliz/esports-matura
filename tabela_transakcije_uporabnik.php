<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "e-sports") or die ("db");
$username = $_SESSION["uporabnik"];
$sql = "SELECT * FROM transakcije WHERE username = '$username'" ;
$result = mysqli_query($connect, $sql) or die ("mofo");
 ?>



<!doctype <!DOCTYPE html>
<html>
<head>
	<title></title>
	
</head>
<body>
<?php  
		echo "<table class='table table-striped table-bordered'>";
		echo "<tr><td>Namen</td><td>Vrednost</td><td>Staro stanje</td><td>Novo stanje</td><td>Bančni račun</td><td>Status</td></tr>";
	while ($row = mysqli_fetch_assoc($result)) {
		echo "<tr><td>{$row['namen_trs']}</td><td>{$row['vrednost_trs']}€</td><td>{$row['staro_stanje']}€</td><td>{$row['novo_stanje']}€</td><td>{$row['bancni_racun']}</td><td>{$row['Status']}</td></tr>";}
		echo "</table>";

?>
</div>


</body>
</html>
