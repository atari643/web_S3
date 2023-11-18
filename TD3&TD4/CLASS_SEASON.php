<?php
    class Season{
        public $numberSeason;
        public $numberEpisode;
        public function __get($name){
            return $this->{$name};
        }
    };