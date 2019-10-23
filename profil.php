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
</html><?php 
session_start();
$connect = mysqli_connect("localhost", "root", "", "e-sports") or die ("nemorem povezati z db");
$username = $_SESSION['uporabnik'];
$sql = "SELECT * FROM uporabnik WHERE username = '$username'" ;
$result = mysqli_query($connect, $sql);
$sql_uredi_profil = "SELECT * FROM uporabnik WHERE username = '$username'" ;
$result_uredi_profil = mysqli_query($connect, $sql_uredi_profil);
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
	<link rel="stylesheet" type="text/css" href="styles/main.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<meta name="viewport" content="width=device widht, intial-scale=1, shrink-to-fit=no">
</head>
<body class="index">
<div class="header">
<?php include "header.php" ?>
</div>
<div class="subheader">
	<div class="notranji_subheader">
		<ul class="navi">
			<a href="profil.php"><li>Osnovne informacije</li></a>
			<a href="varnost.php"><li>Varnost</li></a>
			<a href="denarnica.php"><li>Denarnica</li></a>
		</ul>	
	</div>
</div>

<div class="container" style="height: 1500px">

<?php
if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_array($result)) {
?><br>
<div class="card text-center" style="width: 650px; margin:0 auto;">
  <div class="card-header">
 <h4> Pregled osebnih podatkov </h4>
  </div>
  <div class="card-body">
    <p class="card-text">
    <table class="table table-striped table-bordered" style="width: 550px; margin:0 auto; border-radius: 3px;">
    <tr>
      <th style="border-width: 0px 0 3px 0; text-align: left; background-color: white;">Uporabniško ime</th> 
    </tr>
  <tbody>
    <tr>
      <td style="border-width: 3px 0 3px 0; text-align: center;"><?php echo $row["username"]; ?> </td>
    </tr>
    <tr>
      <th scope="col" style="border-width: 3px 0 3px 0; text-align: left;">Ime in priimek</td>
    </tr>
    <tr>
      <td style="border-width: 3px 0 3px 0; text-align: center;"><?php echo $row["ime"]." ".$row["priimek"] ?></td>
    </tr>
    <tr>
      <th scope="col" style="border-width: 3px 0 3px 0; text-align: left;">Naslov</td>
    </tr>
    <tr>
      <td style="border-width: 3px 0 3px 0; text-align: center;"><?php echo $row["ulica"]." ".$row["hisna_st"];?></td>
    </tr>
    <tr>
      <th scope="col" style="border-width: 3px 0 3px 0; text-align: left;">Pošta</td>
    </tr>
    <tr>
      <td style="border-width: 3px 0 3px 0; text-align: center;"><?php echo $row["postna_st"]." ".$row["kraj"] ?></td>
    </tr>
    <tr>
      <th scope="col" style="border-width: 3px 0 3px 0; text-align: left;">Telefonska številka</td>
    </tr>
    <tr>
      <td style="border-width: 3px 0 3px 0; text-align: center;"><?php echo "0".$row["telefonska_st"] ?></td>
    <tr>
      <th scope="col" style="border-width: 3px 0 3px 0; text-align: left;">Starost</td>
    </tr>
    <tr>
      <td style="border-width: 3px 0 3px 0; text-align: center;"><?php echo $row["starost"] ?></td>
    </tr>
    </tr>
  </tbody>
</table></p>
  </div>
  <div class="card-footer text-muted">
	<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Uredi profil</button>
  </div>
</div>
</div>

<?php
  }
}
 ?>

 <?php
if (mysqli_num_rows($result_uredi_profil) > 0) {
  while ($row = mysqli_fetch_array($result_uredi_profil)) {
?>


<form action="profil.php" method="post">
  <!-- Pojavno okno uredi profil -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"  role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Uredi profil:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

 <div class="input-group" style="padding: 3px 0 3px 0;">
  <div class="input-group-prepend">
    <span class="input-group-text" id="" style="width: 150px">Uporabniško ime</span>
  </div>
  <input type="text" class="form-control" style="text-align: center;" disabled="" name="ime" placeholder="<?php echo $row["username"]?>">
</div>

  <div class="input-group" style="padding: 3px 0 3px 0">
  <div class="input-group-prepend">
    <span class="input-group-text" id="" style="width: 150px;">Ime in priimek</span>
  </div>
  <input type="text" class="form-control" style="text-align: center;" name="ime" placeholder="Ime">
  <input type="text" class="form-control" style="text-align: center;" name="priimek" placeholder="Priimek">
</div>

  <div class="input-group" style="padding: 3px 0 3px 0">
  <div class="input-group-prepend">
    <span class="input-group-text" id="" style="width: 150px;">Naslov</span>
  </div>
  <input type="text" class="form-control" style="text-align: center;" name="ulica" placeholder="Ulica">
  <input type="number" class="form-control" style="text-align: center" name="hisna_st" placeholder="Hišna številka">
</div>

<div class="input-group" style="padding: 3px 0 3px 0">
  <div class="input-group-prepend">
    <span class="input-group-text" id="" style="width: 150px;">Pošta</span>
  </div>
  <input type="number" class="form-control" style="text-align: center;" name="postna_st" placeholder="Poštna številka">
  <input type="text" class="form-control" style="text-align: center" name="kraj" placeholder="Kraj">
</div>

  <div class="input-group" style="padding: 3px 0 3px 0">
  <div class="input-group-prepend">
    <span class="input-group-text" id="" style="width: 150px;">Mobilna št.</span>
  </div>
  <input type="number" class="form-control" style="text-align: center" name="telefonska_st" placeholder="Mobilna številka">
</div>
  <div class="input-group" style="padding: 3px 0 3px 0">
  <div class="input-group-prepend">
    <span class="input-group-text" id="" style="width: 150px;">Starost</span>
  </div>
  <input type="number" class="form-control" style="text-align: center" name="starost" disabled="" placeholder="<?php echo $row['starost']; ?>">
</div>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zapri</button>
        <input type="submit" class="btn btn-primary" name="shrani" value="Shrani"></input>
      </div>
    </div>
  </div>
</div>
</form>
<?php
  }
}
 ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
