<?php

include_once 'app/models/Person.php';

class BaseController{
    public $title = 'Family daily task dashboard';
    public $db;

    public function __construct(){
        $this->db = Db::getConnection();
    }

    public function view($view, $data = null){
        include_once 'app/views/layouts/app.php';

        $_SESSION['request']['messages'] = [];
    }
}
