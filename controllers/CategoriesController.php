<?php

class CategoriesController extends BaseController
{
    private $db;

    public function onInit(){
        $this->title = "Category";
        $this->db = new CategoriesModel();

        if($this->isLoggedIn()) {
            $userId = $this->db->getUser($_SESSION['username'])[0];
            $this->userId = $userId;
        }
    }

    public function index(){
        //$this->authorize();

        $this->categories = $this->db->getAllCategories();

        $this->renderView();
    }
    public function products(){
        //$this->authorize();

        if($this->isPost()) {
            $id = (int)$_POST['category_num'];
            $this->id = $id;
            $_SESSION['category_num'] = $id;

            //var_dump($id);
            if ($_POST['category_num'] == '' || $_POST['category_num'] == null) {
                $this->addErrorMessage("Enter your choice!");
                return $this->redirect('categories');
            }

            if (count($this->db->getProductsInCategory($id)) <= 0) {
                $this->addErrorMessage("We dont't have categories there!");
                return $this->redirect('categories');
            }
        }
        $id = $_SESSION['category_num'];

        $this->products = $this->db->getProductsInCategory($id);
        if($this->isLoggedIn()) {
            $this->userId = $this->db->getUser($_SESSION['username'])[0];
        }
        $this->renderView(__FUNCTION__);
    }

}