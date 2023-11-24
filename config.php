<?php
include_once "models/User.php";
$dir = array_reverse(explode("\\", __DIR__));
if(!isset($_SESSION)){
    session_start();
}
if(@$_SESSION["ROOT_DIR"] == null){
    $_SESSION["ROOT_DIR"] = $_SERVER["REQUEST_SCHEME"]."://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
}
if(!defined("ROOT_DIR")){
    define("ROOT_DIR", $_SESSION["ROOT_DIR"]);
}
$instructions_folder = "data/instructions/";
?>