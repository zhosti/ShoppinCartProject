<?php

class AdminController extends  BaseController
{
    private $db;

    public function onInit(){
        $this->title = "Admin";
        $this->db = new AdminModel();

        if($this->isLoggedIn()) {
            $userId = $this->db->getUser($_SESSION['username'])[0];
            $this->userId = $userId;
        }
    }

    public function index(){
        $this->authorize();

        $this->renderView();
    }

    public function addProductInCategory(){
        if($this->isPost()) {
            $product_name = $_POST['name'];
            $product_price =(double) $_POST['price'];
            $product_quantity = (int)$_POST['quantity'];
            $product_cat_id = $_POST['category_id'];
            $user_id = $this->userId[0];

            $this->db->addProduct($product_name,$product_price,$product_quantity,$product_cat_id,$user_id);
        }
        $this->categories = $this->db->getAllCategories();
        $this->renderView(__FUNCTION__);

    }
}