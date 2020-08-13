<?php

include_once 'BaseController.php';

class ErrorsController extends BaseController {
    public function notfound(){
        $this->title = 'Page not found';
        $this->view('errors/404.php');
    }
}