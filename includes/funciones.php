<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function isAuth(){
   if(empty($_SESSION)) session_start();
    return isset($_SESSION['nombre']) && !empty($_SESSION);
}

function isAdmin(){
    if(empty($_SESSION))session_start();
    return $_SESSION['admin'] && !empty($_SESSION['admin']);
}
