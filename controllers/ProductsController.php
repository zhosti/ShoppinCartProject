<?php

class ProductsController extends BaseController{

    private $db;

    public function onInit(){
        $this->title = "Products";
        $this->db = new ProductsModel();

        if($this->isLoggedIn()) {
            $userId = $this->db->getUser($_SESSION['username'])[0];
            $this->userId = $userId;
        }
    }

    public function index(){
        $this->products = $this->db->getAllProducts();
    }


}