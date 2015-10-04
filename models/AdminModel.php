<?php

class AdminModel extends BaseModel
{
    public function getAllCategories(){
        $statement = self::$db->query("SELECT id, name FROM categories");
        $restult = $statement->fetch_all();
        return $restult;
    }

    public function addProduct($name,$price,$quantity,$category_id,$user_id){
        $statement = self::$db->prepare("INSERT INTO products (name, price, quantity,category_id,user_id) VALUE(?, ?, ?,?,?)");
        $statement->bind_param("sdiii", $name, $price, $quantity,$category_id,$user_id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

}