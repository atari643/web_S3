<?php
class User{
    public $id;
    public $name;
    public $email;

    public $password;

    public $register_date;

    public $admin;

    public $country_id;

    public $user_id;

    public function __get($name){
        return $this->{$name};
    }
};
?>