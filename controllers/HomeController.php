<?php

class HomeController extends BaseController {

    private $id;

    public function index() {
        $this->renderView();
    }

    public function onInit(){

        $this->title = "Home";

        $this->db = new HomeModel();
        if($this->isLoggedIn()) {
            $userId = $this->db->getUser($_SESSION['username'])[0];
            $this->userId = $userId;
        }
    }
}