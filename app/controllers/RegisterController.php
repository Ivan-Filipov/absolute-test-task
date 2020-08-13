<?php

include_once 'BaseController.php';

class RegisterController extends  BaseController {
    public function index(){
        $this->title = 'FDTD - Registration';
        if ($_SESSION['auth']) header("Location: /dashboard");

        $query = $this->db->query("SELECT * FROM user_status");
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $roles = $query->fetchAll();

        $this->view('register/register.php', ['roles' => $roles]);
    }

    public function registration(){
        $request = $_POST;
        $name = $request['name'] ?: '';
        $status = $request['status'] ?: '';
        $password = $request['password'] ?: '';

        $messages = [];
        if (strlen($name) < 4){
            $messages[] = 'Minimum name length 6 characters';
        }
        if ($status === ''){
            $messages[] = 'Please select roles for this user';
        }

        if (strlen($password) < 6){
            $messages[] = 'Minimum password length 6 characters';
        }

        if (!empty($messages)){
            $_SESSION['request']['messages'] = $messages;
            header("Location: /register");
            return false;
        }

        $person = new Person;
        $person->name = $name;
        $person->status = $status;
        $person->password = md5($password);

        $person->save();

        header("Location: /auth");
        return true;
    }
}