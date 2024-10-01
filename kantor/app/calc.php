<?php

require_once dirname(__FILE__).'/../config.php';
$messages = [];
$kwota = $_REQUEST ['kwota'];
$kurs = $_REQUEST ['kurs'];
$operation = $_REQUEST ['op'];


if ( ! (isset($kwota) && isset($kurs) && isset($operation))) {
	$messages [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
}

if (empty($kwota)) {
	$messages[] = 'Nie podano kwoty';
}
if (empty($kurs)) {
	$messages[] = 'Nie podano kursu';
}

if (empty( $messages )) {
	
	if (! is_numeric( $kwota )) {
		$messages [] = 'Pierwsza wartość nie jest liczbą całkowitą';
	}
	
	if (! is_numeric( $kurs )) {
		$messages [] = 'Druga wartość nie jest liczbą całkowitą';
	}	

}



if (empty ( $messages )) {
	floatval($kwota);
	floatval($kurs);
	//wykonanie operacji
	switch ($operation) {
		case 'pln-eur' :
			$result = ($kwota / $kurs);
			$result = round($result,2);
			break;
		case 'eur-pln' :
			$result = ($kwota * $kurs);
			$result = round($result,2);
			break;
	}
}

include 'calc_view.php';