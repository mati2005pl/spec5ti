<?php require_once dirname(__FILE__) .'/../config.php';?>
<html lang="pl">
<head>
<title>Kantor</title>
</head>
<body>
<div>
	<a href="<?php print(_APP_ROOT); ?>/app/inna_chroniona.php" class="pure-button">kolejna chroniona strona</a><br>
	<a href="<?php print(_APP_ROOT); ?>/app/security/logout.php" class="pure-button pure-button-active">Wyloguj</a>
</div>
	<form action="<?php print(_APP_URL);?>/app/calc.php" method="post">
		Kwota:<input id="kwota" type="text" name="kwota" value="<?php isset($kwota)?print($kwota):" "; ?>" /><br />
		Kurs:<input id="kurs" type="text" name="kurs" value="<?php isset($kurs)?print($kurs):" "; ?>" /><br />
		Operacja:<br>
		<input type="radio" name="op" value="pln-eur" >Złotówki na Euro<br/>
		<input type="radio" name="op" value="eur-pln">Euro na Złotówki<br/>
		<input type="submit" value="Oblicz" />
	</form>	
	<?php 
		$kwota = isset($kwota) ? $kwota : '';
		$kurs = isset($kurs) ? $kurs : ''; 

		if( isset($_POST['op']) && (($_POST['op'])) == "pln-eur" ){
			$waluta = " Euro";
		} else {
			$waluta = " Złoty";
		}
	?>

	<?php
		if (isset($messages) && count($messages) > 0) {
			echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
			foreach ( $messages as $msg ) {
				echo '<li>'.$msg.'</li>';
			}
			echo '</ol>';
		}
	?>

	<?php if (isset($result)){ ?>
		<div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #ff0; width:300px;">
	<?php echo 'Możesz kupić: '.$result . $waluta;?>
	</div>
	<?php } ?>

</body>
</html>