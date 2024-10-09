<?php
require_once dirname(__FILE__).'/../config.php';

$messages = [];
$kwota = $_REQUEST ['kwota'];
$kurs = $_REQUEST ['kurs'];
$operation = $_REQUEST ['op'];




if ( ! (isset($kwota) && isset($kurs) && isset($operation))) {
	$messages [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
}

if (empty( $messages )) {
	if (! is_numeric( $kwota )) {
		$messages [] = 'Pierwsza wartość nie jest liczbą całkowitą.';
	}
	if (! is_numeric( $kurs )) {
		$messages [] = 'Druga wartość nie jest liczbą całkowitą.';
	}	
}

if ( $kwota == "") {
	$messages[] = 'Nie podano kwoty.';
}
if ( $kurs == "") {
	$messages[] = 'Nie podano kursu.';
}

if ($kwota <= 0) {
	$messages[] = 'Kwota nie może być 0.';
}
if ($kurs <= 0) {
	$messages[] = 'Kwota nie może być 0.';
}
 
if (empty ( $messages )) {

	$kwota = intval($kwota);
	$kurs = intval($kurs);

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