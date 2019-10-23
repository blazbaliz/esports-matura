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
	else { $error_mail = "* Uporabniški račun z tem naslovom že obstaja <br>";}
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
		$error_password = "* Vneseni gesli se ne ujemata <br>";
	}
}

?>

<!doctype <!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="styles/main.css">
	<meta name="viewport" content="width=device widht, intial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
	
</head>
<body class="index">

<div class="header">
	<?php include "header.php" ?>
</div>

<div class="subheader">
	<div class="notranji_subheader">
		<ul class="navi" style="padding: 13px 240px 0 0">
			<a href="profil.php"><li>Osnovne informacije</li></a>
			<a href="varnost.php"><li>Varnost</li></a>
			<a href="denarnica.php"><li>Denarnica</li></a>
		</ul>	
	</div>
</div>
<form action="varnost.php" method="post">
<?php
if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_array($result)) {
?>


<div class="container">
<br>
<div class="card text-center" style="width: 650px; margin:0 auto;">
  <div class="card-header">
 <h4> Varnost </h4>
  </div>
  <div class="card-body">
    <p class="card-text">
    <table class="table table-striped table-bordered" style="width: 550px; margin:0 auto; border-radius: 3px;">
    <tr>
      <th style="border-width: 0px 0 3px 0; text-align: left; background-color: white;">Vaš e-poštni naslov: <span style="color: red; font-size: 15px;float: right"><?php echo $error_mail ?></span> </th> 
    </tr>
  <tbody>
    <tr>
      <td style="border-width: 3px 0 3px 0; text-align: center;"><?php echo $row["mail"]; ?> &nbsp <button class="btn btn-sm btn-primary " style="float: right;" data-toggle="modal" data-target="#exampleModal">Uredi</button> </td>
    </tr>
    <tr>
      <th scope="col" style="border-width: 3px 0 3px 0; text-align: left;">Vaše geslo: <span style="color: red; font-size: 15px;float: right"><?php echo $error_password ?></span></td>
    </tr>
    <tr>
      <td style="border-width: 3px 0 3px 0; text-align: center;"><?php echo "********" ?> &nbsp <button class="btn btn-primary btn-sm" style="float: right;" data-toggle="modal" data-target="#exampleModal1">Uredi</button></td>
    </tr>	
  </tbody>
</table></p>
  </div>
  <div class="card-footer text-muted">
  	<span style="font-size: 11px">Nikomur ne posredujte svojih osebnih podatkov. Za vaše izgube v primeru zlorabe ne odgovarjamo</span>
  </div>
</div>

</div>

<!-- Modal email-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"  role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Spremeni e-poštni naslov:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Vnesite nov e-poštni naslov:<br>
	 		<input type="text" class="form-control" style="text-align: center;" name="new_mail" required placeholder="<?php echo $row['mail']; ?>"></input>    
	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zapri</button>
        <input type="submit" class="btn btn-primary" name="shrani_mail" value="Shrani"></input>
      </div>
    </div>
  </div>
</div>

<!-- Modal geslo-->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"  role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Spremeni uporabniško geslo:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Vnesite novo uporabniško geslo: <br>
      	<input type="password" name="password1" required placeholder="********" class="form-control" style="text-align: center;" ></input>
      <br>
		  Potrdite novo uporabniško geslo:<br>
<input type="password" name="password2" required placeholder="********" class="form-control" style="text-align: center;" ></input>
	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zapri</button>
        <input type="submit" class="btn btn-primary" name="shrani_geslo" value="Shrani"></input>
      </div>
    </div>
  </div>
</div>

<?php
	}
}
 ?>
</form>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
