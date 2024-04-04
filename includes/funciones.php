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
   if(!isset($_SESSION)) session_start();
    return isset($_SESSION['nombre']) && !empty($_SESSION);
}

function isAdmin(){
    if(!isAuth()) return;
    return !empty($_SESSION['admin']) && $_SESSION['admin'];
}


function aos_animacion() {
    $efectos = ["fade-up","fade-down","fade-left","fade-right","zoom-out-up","zoom-up-down","flip-right","flip-left","zoom-in-up","zoom-in-down"];
    $efecto = $efectos[rand(0, count($efectos)-1)];
    echo 'data-aos="' . $efecto . '"';
}

