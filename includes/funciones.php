<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function ultimo(string $actual,string $prximo) : bool{
    if($actual !== $prximo){
        return true;
    }else{
        return false;
    }
}

//Funcion que revisa que el usuario esta autemticado
function autenticado():void{
    if(!isset($_SESSION['login'])){
        header('Location:/');
    }
}

function isAdmin():void{
    if(!isset($_SESSION['admin'])){
        header('Location:/');
    }
}