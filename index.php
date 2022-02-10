<?php

declare(strict_types=1);
require_once 'classes/personnummer.php';

$message = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $pnr = $_POST['personnummer'];

    if(Personnummer::validateString($pnr) == 1){
        $message = "<span class=\"w3-tag w3-green\">$pnr är giltigt</span>";
    }
    else{
        $message = "<span class=\"w3-tag w3-red\">$pnr är EJ giltigt</span>";
    }  
}



$title = "Kontollera personnummer";


include_once 'template.php';
?>