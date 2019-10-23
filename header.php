<?php error_reporting(0); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device widht, intial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="styles/header.css">
	<title></title>
</head>
<body>
	<div class="header">
		<div class="login">
		<?php
		session_start();
		if (isset($_SESSION['uporabnik'])) {
		include "prijavljen_uporabnik.php";
		} 
	
		else
		{echo '<div class="prijava" id="gumb_prijava">
				|<a>Prijava</a>
			</div><br>
			<div class="reg" id="gumb_reg">
				|<a>Registracija</a>
			</div>' ;}
		?>
		</div>
		<div class="inner_header">
			<div class="logo">
			<h1>e<span>Sports</span></h1>
			</div>

			<?php if (isset($_SESSION['uporabnik'])) {
				echo '<ul class="navigacija">
				<a href="lobby.php"><li>Igralnica</li></a>
				<a href="profil.php"><li>Profil</li></a>
				<a><li>FAQ</li></a>
			</ul>
		</div>		
';
			}
				elseif (!isset($_SESSION['uporabnik'])) {
					echo "";
				}
		?>
	</div>
	<div id="modal_prijava" class="modal_prijava">
					<div class="modal_content_prijava">
						<div class="modal_header_prijava">
							<span class="close">&times;</span>
							<h2 class="naslov_modal">Prijava</h2>	
						</div> 
						<div class="modal_body_prijava">
						<?php
						 include "login.php" ?>
						</div>
						<div class="modal_footer_prijava">
							<form action="login.php" method="post">
					   			<input type="submit" name="loggin_btn" value="Prijava">
							</form>
						</div>
					</div> 
	</div>

	<div id="modal_registracija" class="modal_registracija">
					<div class="modal_content_registracija">
						<div class="modal_header_registracija">
							<span class="closeme">&times;</span>
							<h2 class="naslov_modal">Registracija</h2>	
						</div> 
						<div class="modal_body_registracija">
							<?php include "register.php" ?>
						</div>
						<div class="modal_footer_registracija">
							<form action="register.php" method="post">
								<input type="Submit" name="register_btn" value="Registriraj se">
							</form>
						</div>
					</div> 
	</div>
</body>

<script>
//skripta za odpiranje prijavnega modal boxa 
var modal = document.getElementById('modal_prijava');
var btn = document.getElementById("gumb_prijava");
var span = document.getElementsByClassName("close")[0];
//ko pritisne gumb odpri modal

btn.onclick = function() {
	modal.style.display = "block";
}

// ko uporabnik pritisne x zapri modal
span.onclick = function() {
  modal.style.display = "none";
}

// ko uporabnik klikne izven modala ga zapri
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

//modal reg

var modal_reg = document.getElementById('modal_registracija');
var gumb = document.getElementById('gumb_reg');
var zapri = document.getElementsByClassName('closeme')[0];


// ko uporabnik pritisne x zapri modal
zapri.onclick = function() {
  modal_reg.style.display = "none";
}


gumb.onclick = function() {
	modal_reg.style.display = "block";
}


// blokera to funkcijo v prijava modalu
//window.onclick = function(event) {
//  if (event.target == modal_reg) {
//    modal_reg.style.display = "none";
//  }
//}
</script>
</html>
