<?php require_once dirname(__FILE__) .'/../config.php';?>
<html lang="pl">
<head>
<title>Kantor</title>
</head>
<body>
<form action="<?php print(_APP_URL);?>/app/calc.php" method="post">
	<label for="kwota">Kwota: </label>
	<input id="kwota" type="text" name="kwota" value="<?php isset($kwota)?print($kwota):" "; ?>" /><br />
	
	<label for="kurs">Kurs: </label>
	<input id="kurs" type="text" name="kurs" value="<?php isset($kurs)?print($kurs):" "; ?>" /><br />
	<label >Operacja: </label><br>
	<input type="radio" name="op" value="pln-eur" ><label>Złotówki na Euro</label><br />
	<input type="radio" name="op" value="eur-pln"><label>Euro na Złotówki</label><br />
	<input type="submit" value="Oblicz" />
</form>	
<?php 
      $kwota = isset($kwota) ? $kwota : '';
      $kurs = isset($kurs) ? $kurs : ''; 

	  if(isset($_POST['op'])){
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
<div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: red; width:300px;">
<?php echo 'Możesz kupić: '.$result . $waluta;?>
</div>
<?php } ?>

</body>
</html>