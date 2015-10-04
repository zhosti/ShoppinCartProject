<?php

class UsersController extends BaseController{
    private $db;

    public function onInit(){
        $this->title = "Users";
        $this->db = new UsersModel();

        if($this->isLoggedIn()) {
            $userId = $this->db->getUser($_SESSION['username'])[0];
            $this->userId = $userId;
        }
    }

    public function index(){
        $this->isAdmin();
        $this->authorize();
        
        $this->renderView();
    }

    public function found(){
        $this->isAdmin();
        if($this->isPost()){
            $this->name = $_POST['enter_username'];
            if($this->db->getByName($this->name)){
                $this->addInfoMessage("User is found.");
            } else{
                $this->addErrorMessage("User is not found.");
                $this->redirect('users', 'index');
            };
        }

        $this->renderView(__FUNCTION__);
    }
}