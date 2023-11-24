<?php
include_once "db.php";
include_once "config.php";
include_once "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Инструкции</title>
    <link rel="stylesheet" href="<?=ROOT_DIR?>styles/instructions.css">
</head>
<body>
    <div class="box">
        <h2>Добавление инструкции</h2>
        <hr>
        <p class="msg"><?=$msg?></p>
        <form action="<?=ROOT_DIR?>models/actions.php" method="POST" enctype="multipart/form-data">
            <label for="name">Введите название:</label>
            <input id="name" name="name" type="text" required>
            <input name="file" type="file" required>
            <button name="add">Submit</button>
        </form>
    </div>
    <div class="box">
        <h2 class="title">Инструкции</h2>
        <form class="search-block" action="<?=ROOT_DIR?>models/actions.php" method="POST">
            <input name="text" type="text" placeholder="Искать здесь...">
            <button name="search" type="submit">Поиск</button>
        </form>
        <?php
        $SQL = "SELECT * FROM instructions";
        if(isset($_SESSION["search"])){
            $SQL = $_SESSION["search"];
            unset($_SESSION["search"]);
        }
        $R = mysqli_query($db_link, $SQL);
        while($tmp = mysqli_fetch_array($R)){
            echo '<div><span>'.$tmp["name"].'</span>
            <a href="'.ROOT_DIR.$instructions_folder.$tmp["path"].'"">Посмотреть</a>';
            if(@$currentUser != null){
                echo ' <a href="'.ROOT_DIR.$instructions_folder.$tmp["path"].'"" download>Скачать</a>';
            }else{
                echo ' <a href="'.ROOT_DIR.'/index.php/instructions/Авторизируйтесь для скачивания инструкций">Скачать</a>';
            }
            if(@$currentUser->type == "a"){
                echo ' <a href="'.ROOT_DIR."/models/actions.php?base=instructions&id=".$tmp["id"].'"">Удалить</a>';
            }
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>