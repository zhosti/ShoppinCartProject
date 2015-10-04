<?php

class UsersModel extends BaseModel
{
    public function getByName($username){
        $statement = self::$db->prepare("SELECT id, username FROM users WHERE username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        return $statement->get_result()->num_rows;
    }

}