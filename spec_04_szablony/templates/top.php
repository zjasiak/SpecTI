<!DOCTYPE html>
<html lang="pl">
<link rel="stylesheet" href="<?php print(_APP_URL);?>/css/style.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<head>
    <meta charset="UTF-8">
    <title> <?php out($page_title); if (!isset($page_title)) {  ?> Tytuł domyślny... <?php } ?> </title>
</head>

<body>
    <nav class="w3-sidebar w3-red w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
    <div class="w3-container">
        <h3 class="logo"><img src="<?php print(_APP_URL);?>/img/logo.svg" alt="logo"></h3>
    </div>
    <div class="w3-bar-block">
        <a href="#" class="w3-bar-item w3-button w3-hover-white">Główna</a> 
        <a href="#opis" class="w3-bar-item w3-button w3-hover-white">Opis</a> 
        <a href="#kalkulator" class="w3-bar-item w3-button w3-hover-white">Kalkulator Kredytowy</a>
    </div>
    </nav>

    <div class="w3-main" style="margin-left:340px;margin-right:40px">

        <header class="w3-container" id="opis">
            <h1 class="w3-jumbo"><b>Kalkulator Kredytowy</b></h1>
            <h1 class="tw3-xxxlarge w3-text-red"><b>Opis.</b></h1>
            <hr  class="w3-round" style="width:50px;border:5px solid red">
            <p> <?php out($page_header); if (!isset($page_header)) {  ?> Tytuł domyślny... <?php } ?> 
            <br> <br> <?php out($page_description); if (!isset($page_description)) {  ?> Opis domyślny... <?php } ?> </p>
        </header>