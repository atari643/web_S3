<?php
class Series{
    public $id;
    public $title;
    public $poster;

    public function __get($name){
        return $this->{$name};
    }
};
?>