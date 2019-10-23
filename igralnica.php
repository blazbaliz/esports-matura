<?php
	session_start();
	error_reporting(0);
	$connect = mysqli_connect("localhost", "root", "", "e-sports") or die ("Povezave z zbirko ni mogoče vzpostaviti");
	$username = $_SESSION['uporabnik'];
	$session_id = $_SESSION['session_id'];
	$sql_tekme = "SELECT * FROM tekme1 WHERE session_id = '$session_id'";
	$result_tekme = mysqli_query($connect, $sql_tekme) or die("can not select tekme");
	

while ($row = mysqli_fetch_assoc($result_tekme)) {
		$gostitelj = $row['gostitelj']; 
		$izzivalec = $row['izzivalec'];
		$vrednost_stave = $row['vrednost_stave'];
		$datum = $row['datum'];
 		$m = $row['min'] + 15 ;
 		$s = $row['sec'];
 		$ure = $row['h'];

#ready buttons 

if (isset($_POST['gostitelj_ready'])) {
	$sql_gostitelj_ready = "UPDATE tekme1 SET gostitelj_status = 'pripravljen' WHERE session_id = '$session_id' ";
	mysqli_query($connect, $sql_gostitelj_ready) or die ('cannot do gostitelj_ready');
	header("location: igralnica.php?session_id=".$session_id);
}

if(isset($_POST['gostitelj_nepripravljen'])) {
	$sql_gostitelj_nipripravljen = "UPDATE tekme1 SET gostitelj_status = 'nepripravljen' WHERE session_id = '$session_id' ";
	mysqli_query($connect, $sql_gostitelj_nipripravljen) or die ('cannot do gostitelj_nepripravlejn');
	header("location: igralnica.php?session_id=".$session_id);
}

if (isset($_POST['izzivalec_ready'])) {
	$sql_gostitelj_ready = "UPDATE tekme1 SET izzivalec_status = 'pripravljen' WHERE session_id = '$session_id' ";
	mysqli_query($connect, $sql_gostitelj_ready) or die ('cannot do izzivalec_ready');
	header("location: igralnica.php?session_id=".$session_id);
}

if(isset($_POST['izzivalec_nepripravljen'])) {
	$sql_gostitelj_nipripravljen = "UPDATE tekme1 SET izzivalec_status = 'nepripravljen' WHERE session_id = '$session_id' ";
	mysqli_query($connect, $sql_gostitelj_nipripravljen) or die ('cannot do izzivalec_nepripravlejn');
	header("location: igralnica.php?session_id=".$session_id);
}
#nastavitev začetka tekme

if ($row['gostitelj_status'] == 'pripravljen' && $row['izzivalec_status'] == 'pripravljen' && $row['tekma_status'] == 'not_started') {
	date_default_timezone_set("Europe/Ljubljana"); 
	$my_date = date("Y-m-d");
	$h = date("H");
	$min = date ("i");
	$sec = date("s");
	$sql_posodobi_cas = "UPDATE tekme1 SET tekma_status = 'started' , datum = '$my_date', h = '$h', min = '$min', sec = '$sec' WHERE session_id = '$session_id' ";
	mysqli_query($connect, $sql_posodobi_cas) or die('nemorem posodobiti časa');}

#posodobitev rezultatov

if (isset($_POST['rezultat_gostitelj'])) {
	$rezultat1_gostitelj = $_POST['rezultat1_gostitelj'];
	$rezultat2_gostitelj = $_POST['rezultat2_gostitelj'];
	$rezultat_gostitelj = $rezultat1_gostitelj.':'.$rezultat2_gostitelj;
	$sql_posodobi_rezultat_gostitelj = "UPDATE tekme1 SET rezultat_gostitelj = '$rezultat_gostitelj' WHERE session_id = '$session_id' ";
	mysqli_query($connect, $sql_posodobi_rezultat_gostitelj) or die("nemorem posodobiti rezultata od gostitelja");
}

if (isset($_POST['rezultat_izzivalec'])) {
	$rezultat1_izzivalec = $_POST['rezultat1_izzivalec'];
	$rezultat2_izzivalec = $_POST['rezultat2_izzivalec'];
	$rezultat_izzivalec = $rezultat1_izzivalec.':'.$rezultat2_izzivalec;
	$sql_posodobi_rezultat_izzivalec = "UPDATE tekme1 SET rezultat_izzivalec = '$rezultat_izzivalec' WHERE session_id = '$session_id' ";
	mysqli_query($connect, $sql_posodobi_rezultat_izzivalec) or die("nemorem posodobiti rezultata od izzivalca");
}

#preverjanje rezultatov in prenos denarnih enot

#če je zmagovalec gostitelj

if ($row['rezultat_gostitelj'] == $row['rezultat_izzivalec'] && $rezultat1_gostitelj > $rezultat2_gostitelj) {
	$sql_koncaj_tekmo = "UPDATE tekme1 SET tekma_status = 'koncana', zmagovalec = '$gostitelj' WHERE session_id = '$session_id' ";
	$select_wallet_gostitelj = "SELECT * FROM uporabnik WHERE username = '$gostitelj'";
	$sql_select_wallet_gostitelj = mysqli_query($connect, $select_wallet_gostitelj) or die("cannot select wallet_gostitelj");
	$select_wallet_izzivalec = "SELECT * FROM uporabnik WHERE username = '$izzivalec'";
	$sql_select_wallet_izzivalec = mysqli_query($connect,$select_wallet_izzivalec) or die("cannot select wallet_izzivalec");
while ($row = mysqli_fetch_assoc($sql_select_wallet_gostitelj)) {
	$wallet_gostitelj = $row['denarnica'];
}

while ($row = mysqli_fetch_assoc($sql_select_wallet_izzivalec)) {
	$wallet_izzivalec = $row['denarnica'];
}
	$novo_stanje_gostitelj = $wallet_gostitelj + $vrednost_stave;
	$novo_stanje_izzivalec = $wallet_izzivalec - $vrednost_stave;
	$sql_posodobi_denarnico_zmagovalec = "UPDATE uporabnik SET denarnica = '$novo_stanje_gostitelj' WHERE username = '$gostitelj'";
	$sql_posodobi_denarnico_porazenec = "UPDATE uporabnik SET denarnica = '$novo_stanje_izzivalec' WHERE username = '$izzivalec'";
	mysqli_query($connect, $sql_koncaj_tekmo) or die("cannot set zmagovalec gostitelj");
	mysqli_query($connect, $sql_posodobi_denarnico_zmagovalec) or die ('cannot set wallet gostitelj');
	mysqli_query($connect, $sql_posodobi_denarnico_porazenec) or die ('cannot set wallet izzivalec');
	header("location: igralnica.php?session_id=".$session_id);
}

#če je zmagovalec izzivalec

elseif ($row['rezultat_gostitelj'] == $row['rezultat_izzivalec']  && $rezultat1_izzivalec < $rezultat2_izzivalec) {
	$sql_koncaj_tekmo = "UPDATE tekme1 SET tekma_status = 'koncana', zmagovalec = '$izzivalec' WHERE session_id = '$session_id' ";
	$select_wallet_gostitelj = "SELECT * FROM uporabnik WHERE username = '$gostitelj'";
	$sql_select_wallet_gostitelj = mysqli_query($connect, $select_wallet_gostitelj) or die("cannot select wallet_gostitelj");
	$select_wallet_izzivalec = "SELECT * FROM uporabnik WHERE username = '$izzivalec'";
	$sql_select_wallet_izzivalec = mysqli_query($connect,$select_wallet_izzivalec) or die("cannot select wallet_izzivalec");
while ($row = mysqli_fetch_assoc($sql_select_wallet_gostitelj)) {
	$wallet_gostitelj = $row['denarnica'];
}

while ($row = mysqli_fetch_assoc($sql_select_wallet_izzivalec)) {
	$wallet_izzivalec = $row['denarnica'];
}
	$novo_stanje_gostitelj = $wallet_gostitelj - $vrednost_stave;
	$novo_stanje_izzivalec = $wallet_izzivalec + $vrednost_stave;
	$sql_posodobi_denarnico_zmagovalec = "UPDATE uporabnik SET denarnica = '$novo_stanje_gostitelj' WHERE username = '$gostitelj'";
	$sql_posodobi_denarnico_porazenec = "UPDATE uporabnik SET denarnica = '$novo_stanje_izzivalec' WHERE username = '$izzivalec'";
	mysqli_query($connect, $sql_koncaj_tekmo) or die("cannot set zmagovalec gostitelj");
	mysqli_query($connect, $sql_posodobi_denarnico_zmagovalec) or die ('cannot set wallet gostitelj');
	mysqli_query($connect, $sql_posodobi_denarnico_porazenec) or die ('cannot set wallet izzivalec');
	header("location: igralnica.php?session_id=".$session_id);
}

#če je izenačeno

//elseif ($row['rezultat_gostitelj'] == $row['rezultat_izzivalec'] && $rezultat1_gostitelj == $rezultat2_gostitelj) {
//	$sql_koncaj_tekmo = "UPDATE tekme1 SET tekma_status = 'koncana', zmagovalec = 'Izenačeno' WHERE session_id = '$session_id' ";
//	mysqli_query($connect, $sql_koncaj_tekmo) or die("cannot set Izenačeno");
//}

#če uporabnika navedeta različne rezultate/shrani njuna sporocila (kjer zagovarjata svoj rezultat) v support

 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="styles/main.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<meta name="viewport" content="width=device widht, intial-scale=1, shrink-to-fit=no">
</head>
<body class="index">
	<?php include "header.php" ?>
	<div class="subheader">
	<div class="sbhd">
	</div>
	</div>
		<form method="post" action="igralnica.php">
	<div class="container" style="height: 1000px" >
<br>		
<h2 style="font-family: impact"> Dobrodošli v igri</h1> 
<div class="alert alert-danger" role="alert">
  <h4 class="alert-heading" >Pravila igre</h4>
  <p></p>
  <hr>
  <p class="mb-0">1. Počakajte na sotekmovalca, nato ga dodajte v igri.</p>
  <hr>
  <p class="mb-0">2. Ko ste v igri povezani s sotekmovacem, pritisnite gumb "Pripravljen".</p>
  <hr>
  <p class="mb-0">3. Ko bosta oba igralca priprljavljena se bo začel odštevati čas v katerem morate odigrati igro.</p>  
  <hr>
  <p class="mb-0">4. Po preteklem času navedite rezultat igre, v primeru da oba tekmovalca navedeta enak rezultat, se bodo denarne enote avtomatsko nakazale na račun zmagovalca, v nasprotnem primeru zavajajte svoje rezultate administratorju | <b>Večkratna navedba napačnih rezultatov se kaznuje z denarno kaznijo </b> </p>
</div>
<div class="igralci">
	<div class="row justify-content-center">
  <div class="col-sm-5">
    <div class="card">
    <div class="card-header">
    		<h5 style="padding: 10px 0 0 0; font-weight: bold;"> GOSTITELJ </h5>
    	</div>
      <div class="card-body">
        <h5 class="card-title">
		<?php echo $row['gostitelj'];	 ?>	

        </h5>
        <?php  
	if ($username == $gostitelj) {
		if ($row['gostitelj_status'] == 'nepripravljen' && $row['izzivalec_status'] == 'nepripravljen') {
			echo "<input type='submit' class='btn btn-primary' name='gostitelj_ready' value='Pripravi se'></input> ";
		}

		elseif ($row['gostitelj_status'] == 'nepripravljen' && $row['izzivalec_status'] == 'pripravljen') {
			echo "<input type='submit' class='btn btn-primary' name='gostitelj_ready' value='Pripravi se'></input> ";
		}

		elseif ($row['gostitelj_status'] == 'pripravljen' && $row['izzivalec_status'] == 'nepripravljen') {
			echo "<input type='submit' class='btn btn-primary' name='gostitelj_nepripravljen' value='Nisem pripravljen' ></input> ";
		}
	}
	elseif ($username == $izzivalec) {
		if ($row['izzivalec_status'] == 'nepripravljen' && $row['gostitelj_status'] == 'nepripravljen') {
			echo "<button type='button' class='btn btn-primary' disabled = 'disabled'>Ni pripravljen</button> ";
		}

		elseif ($row['izzivalec_status'] == 'nepripravljen' && $row['gostitelj_status'] == 'pripravljen') {
			echo "<button type='button' class='btn btn-primary' disabled = 'disabled'>&#10004</button> ";
		}

		elseif ($row['izzivalec_status'] == 'pripravljen' && $row['gostitelj_status'] == 'nepripravljen') {
			echo "<button type='button' class='btn btn-primary' disabled = 'disabled'>Ni pripravljen</button> ";
		}
}
	?>
      </div>
    </div>
  </div> 
  <div class="col-sm-1" style="font-family: Courier; font-size: 30px; font-weight: bold; top: 100px">
  VS
  </div>
  <div class="col-sm-5">
    <div class="card">
    	<div class="card-header">
    		<h5 style="padding: 10px 0 0 0; font-weight: bold;"> IZZIVALEC </h5>
    	</div>
      <div class="card-body">
        <h5 class="card-title">
		<?php echo $row['izzivalec'];	 ?>	
        </h5>
        	<?php  
	if ($username == $gostitelj) {
		if ($row['gostitelj_status'] == 'nepripravljen' && $row['izzivalec_status'] == 'nepripravljen') {
			echo "<button type='button' class='btn btn-primary' disabled = 'disabled'>Ni pripravljen</button>";
		}

		elseif ($row['gostitelj_status'] == 'nepripravljen' && $row['izzivalec_status'] == 'pripravljen') {
			echo "<button type='button' class='btn btn-primary' disabled = 'disabled'>&#10004</button>";
		}

		elseif ($row['gostitelj_status'] == 'pripravljen' && $row['izzivalec_status'] == 'nepripravljen') {

			echo "<button type='button' class='btn btn-primary' disabled = 'disabled'>Ni pripravljen</button>";
		}
	}
	elseif ($username == $izzivalec) {
		if ($row['izzivalec_status'] == 'nepripravljen' && $row['gostitelj_status'] == 'nepripravljen') {
			echo "<input type='submit' class='btn btn-primary' name='izzivalec_ready' value='Pripravi se'></input> ";
		}

		elseif ($row['izzivalec_status'] == 'nepripravljen' && $row['gostitelj_status'] == 'pripravljen') {
			echo "<input type='submit' class='btn btn-primary' name='izzivalec_ready' value='Pripravi se'></input> ";
		}

		elseif ($row['izzivalec_status'] == 'pripravljen' && $row['gostitelj_status'] == 'nepripravljen') {
			echo "<input type='submit' class='btn btn-primary' name='izzivalec_nepripravljen' value='Nisem pripravljen' ></input> ";
		}
}
	?>
      </div>
    </div>
  </div>
</div>
	
</div>

<br>


<div class="igra">
	<?php
		if ($row['tekma_status'] == 'started') {  ?>
			<div class="card text-center">
  <div class="card-header">
    eSports
  </div>
  <div class="card-body">
    <h5 class="card-title">Objavi svoj rezultat</h5>
    <p class="card-text"><?php echo "<p id='demo'></p>"; ?></p>
  </div>
  <div class="card-footer text-muted">
  Po pretečenem času boste lahko objavili svoj rezultat
  </div>
</div>
		<?php	
		}
		elseif ($row['tekma_status'] == 'koncana') {?>
<div class="card-header">
    eSports
  </div>
  <div class="card-body">
    <h5 class="card-title">Konec tekme</h5>
    <p class="card-text"><?php echo "Čestitamo, zmagovalec tekme je: <b>".$row['zmagovalec']."</b>"; ?></p>
  </div>
  <div class="card-footer text-muted">
  Vaše novo stanje je : 

 <?php
	$izberi_denarnico_gostitelj = "SELECT * FROM uporabnik WHERE username = '$username' ";
	$izberi = mysqli_query($connect, $izberi_denarnico_gostitelj) or die("nemorem izbarti denarnice");
  	while ($row = mysqli_fetch_assoc($izberi)) {
	echo $row['denarnica']." €"; }  ?>
  </div>
</div>
<?php
		}
		elseif ($row['tekma_status'] == 'koncana' && $row['zmagovalec'] == 'Izenačeno' ) {
			echo "Tekma se je končala brez zmagovalca.";
		}
	 ?>
</div>
</div>

</form>
<script>
// Set the date we're counting down to
var countDownDate = new Date("<?php echo $datum?> <?php echo $ure ?>:<?php echo $m ?>:<?php echo $s ?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get todays date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = hours + "h " + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "<?php 
    if ($username == $row['gostitelj']) {
    	if (!isset($_POST['rezultat_gostitelj'])) {echo "<div class='form-row'> <div class ='col'> <input type = 'number' class = 'form-control' name = 'rezultat1_gostitelj'></input></div>"." : "."<div class='col'><input class='form-control' type = 'number' name = 'rezultat2_gostitelj'><br></input></div> </div> "."<input class = 'btn btn-primary' type = 'submit' name='rezultat_gostitelj' value = 'Potrdi'></input> ";}
    	}
    	
    elseif ($username == $row['izzivalec']) {
    	if (!isset($_POST['rezultat_izzivalec'])) {echo "<input type = 'number' name = 'rezultat1_izzivalec'></input>"." : "."<input type = 'number' name = 'rezultat2_izzivalec'></input> "."<input class = 'btn btn-primary' type = 'submit' name='rezultat_izzivalec' value = 'Potrdi'></input> ";}
    	
    }
     ?>";
  }
}, 1000);
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<?php } ?>
</body>
</html>
