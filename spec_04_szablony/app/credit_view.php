<?php
//Tu już nie ładujemy konfiguracji - sam widok nie będzie już punktem wejścia do aplikacji.
//Wszystkie żądania idą do kontrolera, a kontroler wywołuje skrypt widoku.
include _ROOT_PATH.'/templates/top.php';
?>

<div id="kalkulator" class="w3-container" style="margin-top:75px">
    <h1 class="w3-xxlarge w3-text-red"><b>Oblicz swój kredyt.</b></h1>
    <hr style="width:50px;border:5px solid red" class="w3-round">
   
    <form action="<?php print(_APP_URL);?>/app/credit.php" method="post">
    <div class="w3-section">
        <label for="kwota">Kwota (zł): </label>
            <input class="w3-input w3-border" id="kwota" type="text" name="kwota" value="<?php out($kwota); ?>" /><br />
    </div>
    <div class="w3-section">
        <label for="procent">Oprocentowanie (%): </label>
            <input class="w3-input w3-border" id="procent" type="text" name="procent" value="<?php out($procent); ?>" /><br />
    </div>
    <div class="w3-section">
        <label for="okres">Okres (lata): </label>
            <input class="w3-input w3-border" id="okres" type="number" name="okres" value="<?php out($okres); ?>" /><br />
    </div>
        <input class="w3-button w3-block w3-padding-large w3-red w3-margin-bottom" type="submit" value="Oblicz" />
    </form>	

    <?php
    //wyświeltenie listy błędów, jeśli istnieją
    if (isset($messages)) {
        if (count ( $messages ) > 0) {
            echo '<ol style="padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
            foreach ( $messages as $key => $msg ) {
                echo '<li>'.$msg.'</li>';
            }
            echo '</ol>';
        }
    }
    ?>

    <?php if (isset($result)){ ?>
    <div class="message"style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #0f0; width:300px;">
        <?php echo 'Miesięczna rata kredytu wyniesie: '. round($result, 2) . ' zł'; ?>
    </div>

    <?php } ?>
</div>

</div>

<?php 
include _ROOT_PATH.'/templates/bottom.php';
?>