<?php

abstract class BaseModel
{
    protected static $db;

    public function __construct(){
        if(self::$db == null) {
            self::$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            self::$db->set_charset("utf8");
            if(self::$db->connect_errno){
                die("Cannot connect to database");
            }
        }
    }

    public function getUser($username){
        $statement = self::$db->prepare("SELECT id, amount FROM users WHERE username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        return $statement->get_result()->fetch_all();
    }

    public function getProductId($id){
        $statement = self::$db->prepare("SELECT id, price FROM products WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_all();
    }
    public function getQuantity($id){
        $statement = self::$db->prepare("SELECT quantity FROM products WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_row();
    }
}