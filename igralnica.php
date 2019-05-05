<?php
	session_start();
	//error_reporting(0);
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
 		$m = $row['min'];
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
</head>
<body>
<?php include "header.php" ?>
<form method="post" action="igralnica.php">
<div class="players">
	<?php 
		echo $row['gostitelj']." : ".$row['izzivalec'];	 ?>	
</div>

<div class="ready_buttons">
	<?php  
	if ($username == $gostitelj) {
		if ($row['gostitelj_status'] == 'nepripravljen' && $row['izzivalec_status'] == 'nepripravljen') {
			echo "<input type='submit' name='gostitelj_ready' value='Pripravi se'></input> ";
			echo "<button disabled = 'disabled'>Ni pripravljen</button>";
		}

		elseif ($row['gostitelj_status'] == 'nepripravljen' && $row['izzivalec_status'] == 'pripravljen') {
			echo "<input type='submit' name='gostitelj_ready' value='Pripravi se'></input> ";
			echo "<button disabled = 'disabled'>&#10004</button>";
		}

		elseif ($row['gostitelj_status'] == 'pripravljen' && $row['izzivalec_status'] == 'nepripravljen') {
			echo "<input type='submit' name='gostitelj_nepripravljen' value='Nisem pripravljen' ></input> ";
			echo "<button disabled = 'disabled'>Ni pripravljen</button>";
		}
	}
	elseif ($username == $izzivalec) {
		if ($row['izzivalec_status'] == 'nepripravljen' && $row['gostitelj_status'] == 'nepripravljen') {
			echo "<button disabled = 'disabled'>Ni pripravljen</button> ";
			echo "<input type='submit' name='izzivalec_ready' value='Pripravi se'></input> ";
		}

		elseif ($row['izzivalec_status'] == 'nepripravljen' && $row['gostitelj_status'] == 'pripravljen') {
			echo "<button disabled = 'disabled'>&#10004</button> ";
			echo "<input type='submit' name='izzivalec_ready' value='Pripravi se'></input> ";
		}

		elseif ($row['izzivalec_status'] == 'pripravljen' && $row['gostitelj_status'] == 'nepripravljen') {
			echo "<button disabled = 'disabled'>Ni pripravljen</button> ";
			echo "<input type='submit' name='izzivalec_nepripravljen' value='Nisem pripravljen' ></input> ";
		}
}
	?>


</div>


<div class="igra">
	<?php
		if ($row['tekma_status'] == 'started') {
			echo "<p id='demo'></p>";
		}
		elseif ($row['tekma_status'] == 'koncana') {
			echo "Zmagovalec je: ".$row['zmagovalec'];
		}
		elseif ($row['tekma_status'] == 'koncana' && $row['zmagovalec'] == 'Izenačeno' ) {
			echo "Tekma se je končala brez zmagovalca.";
		}
	 ?>
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
  document.getElementById("demo").innerHTML =  hours + "h "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "<?php 
    if ($username == $row['gostitelj']) {
    	if (!isset($_POST['rezultat_gostitelj'])) {echo "<input type = 'number' name = 'rezultat1_gostitelj'></input>"." : "."<input type = 'number' name = 'rezultat2_gostitelj'></input> "."<input type = 'submit' name='rezultat_gostitelj' value = 'Potrdi'></input> ";}
    	}
    	elseif (isset($_POST['rezultat_gostitelj'])) {
    		echo "Počakaj da nasprotnik objavi rezultat, nato bo izkupiček tekme prenešen na zmagovalčevo denarnico";
    	}
    elseif ($username == $row['izzivalec']) {
    	if (!isset($_POST['rezultat_izzivalec'])) {echo "<input type = 'number' name = 'rezultat1_izzivalec'></input>"." : "."<input type = 'number' name = 'rezultat2_izzivalec'></input> "."<input type = 'submit' name='rezultat_izzivalec' value = 'Potrdi'></input> ";}
    	elseif (isset($_POST['rezultat_izzivalec'])) {
    		echo "Počakaj da nasprotnik objavi rezultat, nato bo izkupiček tekme prenešen na zmagovalčevo denarnico";
    	}
    }
     ?>";
  }
}, 1000);
</script>


<?php } ?>
</body>
</html>