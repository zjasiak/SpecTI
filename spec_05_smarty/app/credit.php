<?php
require_once dirname(__FILE__).'/../config.php';
require_once _ROOT_PATH.'/lib/smarty/Smarty.class.php';

function getParams (&$form) {
	$form['kwota'] = isset($_REQUEST['kwota'])?$_REQUEST['kwota']:null;
	$form['procent'] = isset($_REQUEST['procent'])?$_REQUEST['procent']:null;
	$form['okres'] = isset($_REQUEST['okres'])?$_REQUEST['okres']:null;
}

function validate(&$form, &$infos, &$messages) {
	if (!(isset($form['kwota']) && isset($form['procent']) && isset($form['okres']))) {
		return false;
	}

	$infos [] = 'Przekazano parametry.';

	if ($form['kwota'] == "") {
		$messages[] = "Nie podano kwoty kredytu.";
	}

	if ($form['procent'] == "") {
		$messages[] = "Nie podano oprocentowania";
	}

	if ($form['okres'] == "") {
		$messages[] = "Nie podano okresu kredytu";
	}

	if (count($messages) == 0) {
		if (!is_numeric($form['kwota'])) {
			$messages [] = 'Kwota kredytu nie jest liczbą całkowitą';
		}
		if (!is_numeric($form['procent'])) {
			$messages [] = 'Oprocentowanie nie jest liczbą całkowitą';
		}
		if (!is_numeric($form['okres'])) {
			$messages [] = 'Okres kredytu nie jest liczbą całkowitą';
		}
	}

	if (count($messages)>0) {
		return false;
	}
	else { 
		return true;
	}

}

function process(&$form, &$infos, &$messages, &$result) {
	$infos [] = 'Parametry poprawne. <br> Wykonuję obliczenia.';

	$kwota = floatval($kwota);
    $procent = floatval($procent);
	$okres = intval($okres);
	
	$oprocentowanie = (($kwota * $procent) / 100) * $okres;
	$wynik = $kwota + $oprocentowanie;

	$miesiac = $okres * 12;
	$result = $wynik / $miesiac;
}

$form = null;
$infos = array();
$messages = array();
$result = null;

getParams($form);

if (validate($form,$infos,$messages)) {
	process($form,$infos,$messages,$result);
}

$smarty = new Smarty();

$smarty->assign('app_url',_APP_URL);
$smarty->assign('root_path',_ROOT_PATH);
$smarty->assign('page_title','Kalkulator kredytowy');
$smarty->assign('page_description','Dzięki temu kalkulatorowi możesz obliczyć ratę swojego kredytu!');
$smarty->assign('page_header','Kalkulator kredytowy');

$smarty->assign('form',$form);
$smarty->assign('rata',$rata);
$smarty->assign('messages',$messages);
$smarty->assign('infos',$infos);

$smarty->display(_ROOT_PATH.'/app/credit_view.html');

?>