<?php

require_once 'function.php';

session_start();

// get current url
$goback=$_SERVER['HTTP_REFERER'];

$lang=GET('lang');
$_SESSION['lang']=$lang;

//go to current url
header("Location: ".$goback);


?>