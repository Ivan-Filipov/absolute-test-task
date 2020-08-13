<?php

include_once 'app/controllers/BaseController.php';
include_once 'app/models/Task.php';

class DashboardController extends BaseController {
    public function __construct(){
        parent::__construct();
        if (!isset($_SESSION['auth'])) header("Location: /auth");
    }

    public function index(){
        $taskModel = new Task;
        $tasks = $taskModel->all();

        $persons = new Person();
        $persons = $persons->all();

        $this->view('dashboard/index.php', ['tasks' => $tasks, 'persons' => $persons]);
    }
}