<?php

class CartController extends BaseController
{
    private $db;

    public function onInit(){
        $this->title = "Cart";
        $this->db = new CartModel();

        if($this->isLoggedIn()) {
            $userId = $this->db->getUser($_SESSION['username'])[0];
            $this->userId = $userId;
        }
    }

    public function index(){
        $this->authorize();

        $userId = $this->db->getUser($_SESSION['username'])[0];
        $this->userId = $userId;
        $this->productsCart = $this->db->getAllProducts($userId[0]);

        $this->renderView();
    }

    public function add($userId, $categoryId, $productId){
        $this->authorize();
        $name = $_SESSION['username'];
        $money = (double)$this->db->getCurrentProductId($productId)[0];
        $quantity = $this->db->getQuantity($productId)[0];
        $userMoney = $this->db->getMoneyByUsername($name)[0];
        if($userMoney < $money) {
            $this->addErrorMessage("You don't have enough money");
        }
        else if($quantity > 0){
            $this->db->decreaseQuantity($productId);
            $this->db->add($userId, $categoryId, $productId);

            $this->db->decreaseMoney($money,$name);
        }

        $this->redirect('categories', 'products');

        $this->renderView(__FUNCTION__);
    }
    public function delete($id){
        $name = $_SESSION['username'];
        $productId = $this->db->getProductIdFromCart($id)[0];
        $money = (double)$this->db->getCurrentProductId($productId)[0];

        $this->db->increaseQuantity($productId);

        $this->db->increaseMoney($money,$name);
        $this->db->delete($id);
        $this->redirect('cart');
        $this->renderView(__FUNCTION__);
    }


}