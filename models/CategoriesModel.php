<?php

class CategoriesModel extends BaseModel
{

    public function getProductsInCategory($id){
        $statement = self::$db->prepare("SELECT p.id, p.category_id, p.name, p.quantity FROM products p
                                            JOIN categories ca
                                            ON ca.id = p.category_id
                                            WHERE ca.id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $restult = $statement->get_result()->fetch_all();
        return $restult;
    }
    public function getFilteredProductsByCategory($id, $from, $size){
        $statement = self::$db->prepare("SELECT p.id, p.name FROM products p
                                            JOIN products_categories pc
                                            ON pc.categoryId = p.id
                                            WHERE pc.categoryId = ?
                                            LIMIT ?, ?");
        $statement->bind_param("iii",$id, $from, $size);
        $statement->execute();
        $result = $statement->get_result()->fetch_all();
        return $result;
    }

    public function getAllCategories(){
        $statement = self::$db->query("SELECT id, name FROM categories");
        $restult = $statement->fetch_all();
        return $restult;
    }
}