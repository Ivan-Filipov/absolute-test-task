<?php

class Model{
    public function __construct(){
        $this->db = Db::getConnection();
    }
}