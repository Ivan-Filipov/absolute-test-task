<?php

include_once 'app/controllers/BaseController.php';

class AuthController extends BaseController{
    public function index(){
        $this->title = 'FDTD - Authentication';
        if ($_SESSION['auth']) header("Location: /dashboard");

        $this->view('auth/auth.php');
    }

    public function login(){
        $request = $_POST;
        $name = $request['name'];
        $password = md5($request['password']);

        $stmt = $this->db->query("SELECT users.*, user_status.status as status FROM users, user_status 
                                                WHERE users.name = '$name' and users.password = '$password' and users.status = user_status.id");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $user = $stmt->fetch();

        if ($user){
            $_SESSION['auth'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'status' => $user['status'],
            ];

            $_SESSION['request'] = [
                'messages' => []
            ];

            header("Location: /dashboard");
        }else{
            $_SESSION['request'] = [
                'messages' => ['You entered an incorrect username or password']
            ];

            header("Location: /auth");
        }

        return true;
    }

    public function logout(){
        session_destroy();

        header("Location: /auth");
        return true;
    }
}