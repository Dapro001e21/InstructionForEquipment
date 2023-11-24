<?php
if(!isset($_SESSION)){
    session_start();
}
include_once "config.php";

if (@$_SESSION["user"]["email"] != null) {
    $currentUser = new User($_SESSION["user"]["email"], $_SESSION["user"]["email"], $_SESSION["user"]["type"]);
}
?>

<head>
    <link rel="stylesheet" href="<?=ROOT_DIR?>styles/header.css">
</head>

<header>
    <h1>Инструкции для техники</h1>
    <ul class="nav">
        <li><a href="<?=ROOT_DIR?>index.php">Главная</a> |</li>
        <li><a href="<?=ROOT_DIR?>index.php/instructions">Инструкции</a> |</li>
        <li><a href="<?=ROOT_DIR?>index.php/about">О сайте</a></li>
    </ul>
    <?php
    if(@$currentUser != null){
        echo '<div class="user">';
        if($currentUser->type == "a"){
            echo '<a href="'.ROOT_DIR.'index.php/admin-panel">Панель администратора</a>';
        }
        echo ''.$currentUser->email.' <a href="'.ROOT_DIR.'models/actions.php?logout=1">Выйти</a>'; 
        echo '</div>';
    }
    ?>
    <hr>
</header>