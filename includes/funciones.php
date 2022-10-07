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


function esUltimo(string $actual, string $proximo) : bool {
    if($actual !== $proximo) {
        // El id de la cita cambia (es otra cita), entonces $actual es el ultimo con ese id
        return true;
    }
    return false;
}


// Funcion que revisa que el usuario este autenticado
function isAuth() : void {
    if(!isset($_SESSION['login'])) {
        header('Location: /');
    }
}


function isAdmin() : void {
    if(!isset($_SESSION['admin'])) {
        header('Location: /');
    }
}