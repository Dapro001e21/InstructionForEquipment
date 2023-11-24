<?php
include_once "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="<?=ROOT_DIR?>styles/main.css">
</head>
<body>
    <div class="container">
        <form class="box" action="<?=ROOT_DIR?>models/actions.php" method="POST">
            <h1>Авторизация</h1>
            <hr>
            <p class="msg"><?=$msg?></p>
            <input name="email" type="text" placeholder="Почта" required>
            <input name="password" type="password" placeholder="Пароль" required>
            <br>
            <button name="auth">Войти</button>
            <br>
            <a href="<?=ROOT_DIR?>index.php/reg">Регистрация</a>
        </form>
    </div>
</body>
</html>