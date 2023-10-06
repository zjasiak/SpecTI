<?php require_once dirname(__FILE__) .'/../config.php';?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta charset="utf-8" />
<title>Kalkulator kredytowy</title>
</head>
<body>

<form action="<?php print(_APP_URL);?>/app/credit.php" method="post">
	<label for="kwota">Kwota (zł): </label>
	    <input id="kwota" type="text" name="kwota" value="<?php out($kwota); ?>" /><br />
	<label for="procent">Oprocentowanie (%): </label>
	    <input id="procent" type="text" name="procent" value="<?php out($procent); ?>" /><br />
    <label for="okres">Okres (lata): </label>
	    <input id="okres" type="number" name="okres" value="<?php out($okres); ?>" /><br />
	<input type="submit" value="Oblicz" />
</form>	

<?php
//wyświeltenie listy błędów, jeśli istnieją
if (isset($messages)) {
	if (count ( $messages ) > 0) {
		echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
		foreach ( $messages as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php if (isset($result)){ ?>
<div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #0f0; width:300px;">
<?php echo 'Miesięczna rata kredytu wyniesie: '. round($result, 2) . ' zł'; ?>
</div>
<?php } ?>

</body>
</html>