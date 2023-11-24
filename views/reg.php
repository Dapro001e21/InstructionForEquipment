<?php
include_once "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="<?=ROOT_DIR?>styles/main.css">
</head>
<body>
    <div class="container">
        <form class="box box-reg" action="<?=ROOT_DIR?>models/actions.php" method="POST">
            <h1>Регистрация</h1>
            <hr>
            <p class="msg"><?=$msg?></p>
            <input name="email" type="email" placeholder="Почта" required>
            <input name="password" type="password" placeholder="Пароль" required>
            <input name="repeat_password" type="password" placeholder="Повтор пароля" required>
            <input name="name" type="text" placeholder="Имя" required>
            <br>
            <button name="reg">Зарегистрироваться</button>
            <br>
            <a href="<?=ROOT_DIR?>index.php">Авторизация</a>
        </form>
    </div>
</body>
</html>