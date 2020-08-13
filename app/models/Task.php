<?php

include_once 'Model.php';

class Task extends Model {
    public $id;
    public $name;
    public $implementer;
    public $timeCreateTask;
    public $done;

    public function __construct($id = null)
    {
        parent::__construct();

        if ($id) {
            $task = $this->get($id);
            $this->id = $task['id'];
            $this->name = $task['name'];
            $this->implementer = $task['implementer'];
            $this->timeCreateTask = $task['time_create'];
            $this->done = $task['done'];
        }
    }

    public function all(){
        $stmt = $this->db->query("SELECT * FROM tasks ORDER BY id DESC");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    public function get($id){
        $stmt = $this->db->query("SELECT * FROM tasks WHERE id = '$id'");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetch();
    }

    public function save(){
        $query = $this->db->prepare("INSERT INTO tasks(name) VALUES(:name)");
        $query->bindParam(':name', $this->name);
        $query->execute();
    }

    public function done(){
        $this->done = true;
    }

    public function update(){
        $stmt = $this->db->prepare("UPDATE tasks SET implementer = :implementer, done = :done WHERE id = " . $this->id);
        $stmt->bindParam(':implementer', $this->implementer);
        $stmt->bindParam(':done', $this->done);
        $stmt->execute();
    }

    public function delete(){
        $this->db->exec("DELETE FROM tasks WHERE id = " . $this->id);
    }

    public static function validateTaskFile($request){
        $fileName = $request['tasks']['name'];

        $messages = [];
        if (empty($fileName)){
            $messages[] = 'Please select file';
        }
        if (pathinfo($fileName)['extension'] !== 'txt'){
            $messages[] = 'Please select file with txt extension';
        }

        return $messages;
    }
}