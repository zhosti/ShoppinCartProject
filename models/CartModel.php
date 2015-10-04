<?php

class CartModel extends BaseModel
{
    public function getAllProducts($id){
        $statement = self::$db->prepare("SELECT p.id, c.id, p.name, p.price FROM products p
                                                JOIN cart c
                                                ON c.product_id = p.id
                                                WHERE c.user_id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $restult = $statement->get_result()->fetch_all();
        return $restult;
    }

    public function add($userId, $categoryId, $productId){
        $statement = self::$db->prepare("INSERT INTO cart (user_id, category_id, product_id) VALUE(?, ?, ?)");
        $statement->bind_param("iii", $userId, $categoryId, $productId);
        $statement->execute();
        return $statement->affected_rows > 0;
    }
    public function getMoneyByUsername($username){
        $statement = self::$db->prepare("SELECT amount FROM users WHERE username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        return $statement->get_result()->fetch_row();
    }
    public function getCurrentProductId($productId){
        $statement = self::$db->prepare("SELECT price FROM products WHERE id = ?");
        $statement->bind_param("i", $productId);
        $statement->execute();
        return $statement->get_result()->fetch_row();
    }
    public function decreaseMoney($money,$username){
        $statement = self::$db->prepare("UPDATE users SET amount=amount-? WHERE username=?");
        $statement->bind_param("ds",$money,$username);
        $statement->execute();
    }

    public function increaseMoney($money,$username){
        $statement = self::$db->prepare("UPDATE users SET amount=amount+? WHERE username=?");
        $statement->bind_param("ds",$money,$username);
        $statement->execute();
    }

    public function getProductIdFromCart($id){
        $statement = self::$db->prepare("SELECT product_id FROM cart WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_row();
    }
    public function delete($id){
        $statement = self::$db->prepare("DELETE FROM cart WHERE id=?");
        $statement->bind_param("i",$id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function decreaseQuantity($id){
        $statement = self::$db->prepare("UPDATE products SET quantity=quantity-1 WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
    }
    public function increaseQuantity($id){
        $statement = self::$db->prepare("UPDATE products SET quantity=quantity+1 WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
    }
}