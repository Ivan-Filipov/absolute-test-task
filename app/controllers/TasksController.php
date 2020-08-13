<?php

include_once 'BaseController.php';
include_once 'app/models/Task.php';

class TasksController extends BaseController {
    public function __construct(){
        parent::__construct();
        if (!isset($_SESSION['auth'])) header("Location: /auth");
    }

    public function upload(){
        if (!Person::isMother()) header("Location: /errors/notfound");

        $this->title = 'FDTD - Tasks upload';
        if (!$_SESSION['auth'] && !Person::isMother()) header("Location: /dashboard");

        $this->view('tasks/upload.php');
    }

    public function postUpload(){
        if (!Person::isMother()) header("Location: /errors/notfound");

        $request = $_FILES;

        if (!empty($_SESSION['request']['messages'] = Task::validateTaskFile($request))){
            header("Location: /tasks/upload");
            return false;
        }

        foreach (file($request['tasks']['tmp_name']) as $line){
            $line = trim($line);
            if ($line !== '') {
                $task = new Task;
                $task->name = $line;
                $task->save();
            }
        }

        header("Location: /dashboard");
    }

    public function done($id = null){
        if ($id){
            $task = new Task($id);
            $task->done();
            $task->update();
        }

        header("Location: /dashboard");
    }

    public function implementer($id = null){
        if (!Person::isFather()) header("Location: /errors/notfound");

        $request = $_POST;

        if ($id) {
            $task = new Task($id);
            $task->implementer = $request['implementer'];
            $task->update();
        }

        header("Location: /dashboard");
    }

    public function delete($id = null){
        if (!Person::isMother()) header("Location: /errors/notfound");

        if ($id){
            $task = new Task($id);
            $task->delete();
        }

        header("Location: /dashboard");
    }
}
