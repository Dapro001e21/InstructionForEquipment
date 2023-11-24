<?php
include_once "../db.php";
include_once "../config.php";
include_once "../views/header.php";
session_start();

//Проверка на авторизацию
if(@$currentUser != null){
    if(isset($_POST["auth"])){
        header("Location: ".ROOT_DIR."index.php/Вы уже авторизованы"); exit;
    }else if(isset($_POST["reg"])){
        header("Location: ".ROOT_DIR."index.php/reg/Вы уже авторизованы"); exit;
    }
}

//Авторизация
if(isset($_POST["auth"])){
    $SQL = "SELECT * FROM users WHERE email='".trim($_POST['email'])."' and password='".md5(trim($_POST['password']))."'";
    $R = mysqli_query($db_link, $SQL);
    if(mysqli_num_rows($R) == 1){
        $tmp = mysqli_fetch_array($R);
        if($tmp["blocking"]){
            header("Location: ".ROOT_DIR."index.php/Ваш аккаунт заблокирован!"); exit;
        }
        $_SESSION["user"]["email"] = $tmp["email"];
        $_SESSION["user"]["name"] = $tmp["name"];
        $_SESSION["user"]["type"] = $tmp["type"];
    }else{
        header("Location: ".ROOT_DIR."index.php/Неправильный логин или пароль!"); exit;
    }
    header("Location: ".ROOT_DIR."index.php/instructions"); exit;
}

//Регистрация
if (isset($_POST["reg"])) {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $name = trim($_POST['name']);
    $SQL = "SELECT * FROM users WHERE email='".$email."'";
    $R = mysqli_query($db_link, $SQL);
    if(mysqli_num_rows($R) == 1){
        header("Location: ".ROOT_DIR."index.php/reg/Такой пользователь уже существует!"); exit;
    }

    if ($password != trim($_POST["repeat_password"])) {
        header("Location: ".ROOT_DIR."index.php/reg/Пароли не совпадают!"); exit;
    }

    $SQL = "INSERT INTO users VALUES(0, '".$email."', '".md5($password)."', '".$name."', 'u')";
    mysqli_query($db_link, $SQL);
    $_SESSION["user"]["email"] = $email;
    $_SESSION["user"]["name"] = $name;
    $_SESSION["user"]["type"] = "u";
    header("Location: ".ROOT_DIR."index.php/instructions"); exit; 
}

//Выход
if (isset($_GET["logout"])) {
    unset($_SESSION["user"]);
    header("Location: ".ROOT_DIR."index.php"); exit; 
}

//Добавление инструкции
if(isset($_POST["add"])){
    if(@$currentUser == null){
        header("Location: ".ROOT_DIR."index.php/instructions/Авторизируйтесь для добавления инструкций"); exit;
    }

    $tmp = pathinfo($_FILES["file"]["name"]);
    $f_name = $tmp["filename"] . '_' . uniqid() . '.' . $tmp["extension"];

    $SQL = "INSERT INTO processing_instructions VALUES(0, '".$_POST["name"]."', '".$f_name."')";
    mysqli_query($db_link, $SQL);

    move_uploaded_file($_FILES['file']['tmp_name'], "../".$instructions_folder.$f_name);
    header("Location: ".ROOT_DIR."index.php/instructions/Файл загружен"); exit;
}

//Одобрение инструкции
if(isset($_GET["approve"])){
    if(@$currentUser == null){
        header("Location: ".ROOT_DIR."index.php/admin-panel/Авторизируйтесь для добавления инструкций"); exit;
    }else if(@$currentUser->type == "u"){
        header("Location: ".$_SERVER["HTTP_REFERER"]); exit;
    }

    $SQL = "SELECT * FROM processing_instructions WHERE id = ".$_GET["id"]."";
    $R = mysqli_query($db_link, $SQL);
    $tmp = mysqli_fetch_array($R);

    $SQL = "DELETE FROM processing_instructions WHERE id = ".$tmp["id"]."";
    mysqli_query($db_link, $SQL);

    $SQL = "INSERT INTO instructions VALUES(0, '".$tmp["name"]."', '".$tmp["path"]."')";
    mysqli_query($db_link, $SQL);

    header("Location: ".ROOT_DIR."index.php/admin-panel"); exit;
}

//Удаление инструкции и пользователя
if(isset($_GET["base"])){
    if(@$currentUser == null){
        header("Location: ".ROOT_DIR."index.php/instructions/Авторизируйтесь для удаления инструкций"); exit;
    }else if(@$currentUser->type == "u"){
        header("Location: ".$_SERVER["HTTP_REFERER"]); exit;
    }

    $SQL = "DELETE FROM ".$_GET["base"]." WHERE id = ".$_GET["id"]."";
    mysqli_query($db_link, $SQL);

    header("Location: ".$_SERVER["HTTP_REFERER"]); exit;
}

//Поиск инструкции
if(isset($_POST["search"])){
    $SQL = "SELECT * FROM instructions WHERE name LIKE '%".$_POST["text"]."%'";
    $_SESSION["search"] = $SQL;
}

//Блокирование пользователя
if(isset($_GET["blockinguser"])){
    if(@$currentUser == null || @$currentUser->type == "u"){
        header("Location: ".$_SERVER["HTTP_REFERER"]); exit;
    }

    $SQL = "UPDATE users SET blocking = True WHERE id = ".$_GET["id"]."";
    mysqli_query($db_link, $SQL);
}

//Разблокирование пользователя
if(isset($_GET["unblockinguser"])){
    if(@$currentUser == null || @$currentUser->type == "u"){
        header("Location: ".$_SERVER["HTTP_REFERER"]); exit;
    }

    $SQL = "UPDATE users SET blocking = False WHERE id = ".$_GET["id"]."";
    mysqli_query($db_link, $SQL);
}

header("Location: ".$_SERVER["HTTP_REFERER"]); exit;
?>