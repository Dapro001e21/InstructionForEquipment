<?php
class Main
{
    public static function auth($msg = "")
    {
        Flight::render("auth.php", array("msg" => $msg));
    }

    public static function reg($msg = "")
    {
        Flight::render("reg.php", array("msg" => $msg));
    }

    public static function instructions($msg = "")
    {
        Flight::render("instructions.php", array("msg" => $msg));
    }

    public static function admin_panel()
    {
        Flight::render("admin-panel.php");
    }

    public static function about()
    {
        Flight::render("about.php");
    }
}
?>