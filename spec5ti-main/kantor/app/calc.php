<?php
require_once dirname(__FILE__).'/../config.php';

include _ROOT_PATH."/app/security/check.php";

function getParams( &$kwota, &$kurs, &$operation){

	$kwota = isset($_REQUEST['kwota']) ? $_REQUEST['kwota'] : null;
	$kurs = isset($_REQUEST['kurs']) ? $_REQUEST['kurs'] : null;
	$operation = isset($_REQUEST['op']) ? $_REQUEST['op'] : null;	

}

function validate(&$kwota, &$kurs, &$operation, &$messages){
if ( ! (isset($kwota) && isset($kurs) && isset($operation))) {

	return false;
}


if ( $kwota == "") {
	$messages[] = 'Nie podano kwoty.';
}
if ( $kurs == "") {
	$messages[] = 'Nie podano kursu.';
}

if (count ( $messages ) != 0) 
return false;

	if (! is_numeric( $kwota )) {
		$messages [] = 'Pierwsza wartość nie jest liczbą całkowitą.';
	}
	if (! is_numeric( $kurs )) {
		$messages [] = 'Druga wartość nie jest liczbą całkowitą.';
	}	

	if ($kwota <= 0) {
		$messages[] = 'Kwota nie może być 0.';
	}
	if ($kurs <= 0) {
		$messages[] = 'Kwota nie może być 0.';
	}
	
	if (count ( $messages ) != 0) return false;
	else return true;

}
function process(&$kwota, &$kurs, &$operation, &$messages, &$result) {
	global $role;

		$kwota = intval($kwota);
		$kurs = intval($kurs);

	if ($role != "admin") {
		if ($kwota > 1000) {
		$messages[] = "Tylko administrator może przewalutować więcej niż 1000";
		return false;
		}  
	  }

	if (empty ( $messages )) {
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

}}
$kwota = null;
$kurs = null;
$operation = null;
$messages = array();
$result = null;

getParams($kwota, $kurs, $operation);
if (validate($kwota, $kurs, $operation, $messages)) {
  process($kwota, $kurs, $operation, $messages, $result);
}

include 'calc_view.php';
?>