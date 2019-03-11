<!doctype html>
<html>
<head>	
	<style type="text/css">
	.prijavljen_uporabnik{
		cursor: pointer;
	}

	.odjava {
		cursor: pointer;
	}
	</style>
</head>
<body>

<div class="prijavljen_uporabnik" >|<?php
 echo $_SESSION['uporabnik'] ?>
</div>
 <div class="odjava" onclick="window.location.href='logout.php'">|Odjava </div>

</body>
</html>
