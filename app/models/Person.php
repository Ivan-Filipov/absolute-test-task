<?php

include_once 'Model.php';

class Person extends Model{
    public $name = '';
    public $status = '';
    public $password = '';

    public function save(){
        $query = $this->db->prepare("INSERT INTO users(name, password, status) VALUES(:name, :password, :status)");
        $query->bindParam(':name', $this->name);
        $query->bindParam(':password', $this->password);
        $query->bindParam(':status', $this->status);
        $query->execute();
    }

    public function all(){
        $stmt = $this->db->query("SELECT * FROM users");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    public static function isFather(){
        return strtolower($_SESSION['auth']['status']) === 'father';
    }

    public static function isMother(){
        return strtolower($_SESSION['auth']['status']) === 'mother';
    }

    public static function isChild(){
        return strtolower($_SESSION['auth']['status']) === 'child';
    }
}