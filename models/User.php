<?php
class User
{
    public $email;
    public $name;
    public $type;

    function __construct($email, $name, $type)
    {
        $this->email = $email;
        $this->name = $name;
        $this->type = $type;
    }
}
?>