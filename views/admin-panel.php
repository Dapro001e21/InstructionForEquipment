<?php
include_once "db.php";
include_once "config.php";
include_once "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Панель администратора</title>
    <link rel="stylesheet" href="<?=ROOT_DIR?>styles/admin-panel.css">
</head>
<body>
    <div class="box">
        <div class="item">
            <h2>Инструкции на обработке</h2>
            <?php
            $SQL = "SELECT * FROM processing_instructions";
            $R = mysqli_query($db_link, $SQL);
            while($tmp = mysqli_fetch_array($R)){
                echo '<div><span>'.$tmp["name"].'</span>
                <a href="'.ROOT_DIR.$instructions_folder.$tmp["path"].'"">Посмотреть</a>
                <a href="'.ROOT_DIR.$instructions_folder.$tmp["path"].'"" download>Скачать</a>
                <a href="'.ROOT_DIR.'models/actions.php?approve&id='.$tmp["id"].'">Одобрить</a>
                <a href="'.ROOT_DIR."models/actions.php?base=processing_instructions&id=".$tmp["id"].'"">Удалить</a>';
                echo '</div>';
            }
            ?>
        </div>
        <div class="item">
            <h2>Пользователи</h2>
            <?php
            $SQL = "SELECT * FROM users";
            $R = mysqli_query($db_link, $SQL);
            while($tmp = mysqli_fetch_array($R)){
                echo '<div><span>'.$tmp["name"].'</span>
                <a href="'.ROOT_DIR."models/actions.php?base=users&id=".$tmp["id"].'">Удалить</a>';
                if($tmp["blocking"]){
                    echo ' <a href="'.ROOT_DIR."models/actions.php?unblockinguser&id=".$tmp["id"].'">Разблокировать</a>';
                }else{
                    echo ' <a href="'.ROOT_DIR."models/actions.php?blockinguser&id=".$tmp["id"].'">Заблокировать</a>';
                }
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>
</html>