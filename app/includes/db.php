<?php

    class Db{
        public static function getConnection(){
            $user = SETTING['db_user'];
            $pass = SETTING['db_password'];

            $dsn = "mysql:host=localhost;dbname=".SETTING['db_name'].";charset=CP1251";
            $opt = array(
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            );

            try{
                $pdo = new PDO($dsn, $user, $pass, $opt);
            } catch (PDOException $e){
                die ('Don`t have connection to database.<br>' . $e->getMessage());
            }

            return $pdo;
        }
    }