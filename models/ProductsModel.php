<?php


class ProductsModel extends BaseModel{

    public function getAllProducts(){
        $statement = self::$db->query("SELECT id,price,quantity,name FROM products");
        $restult = $statement->fetch_all();
        return $restult;
    }


}