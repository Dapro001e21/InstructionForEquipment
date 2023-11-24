<?php
require "flight/Flight.php";

Flight::path("controllers", "controllers");
Flight::path("views", "views");
Flight::path("models", "models");

Flight::route('/', array("Main", "auth"));
Flight::route('/index.php', array("Main", "auth"));
Flight::route('/index.php/reg', array("Main", "reg"));
Flight::route('/index.php/instructions', array("Main", "instructions"));
Flight::route('/index.php/admin-panel', array("Main", "admin_panel"));
Flight::route('/index.php/about', array("Main", "about"));

Flight::route('/index.php/@msg', function($msg){
    $a = new Main();
    $a->auth($msg);
});

Flight::route('/index.php/reg/@msg', function($msg){
    $a = new Main();
    $a->reg($msg);
});

Flight::route('/index.php/instructions/@msg', function($msg){
    $a = new Main();
    $a->instructions($msg);
});
Flight::start();
?>