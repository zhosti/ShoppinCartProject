<?php

class AccountController extends BaseController {
    private $db;

    public function onInit(){
        $this->db = new AccountModel();

    }

    public function register(){
        if($this->isPost()){
            $username = $_POST['username'];
            if($username == null || strlen($username) < 3){
                $this->addErrorMessage("Username is invalid!");
                $this->redirect("account", "register");
            }

            $password = $_POST['password'];

            if($password == null || strlen($password) <= 5){
                $this->addErrorMessage("Password must be more than 5 symbols!");
                $this->redirect("account", "register");
            }
            $amount= $_POST['amount'];
            $isRegister = $this->db->register($username, $password,$amount);
            if($isRegister) {
                $_SESSION['username'] = $username;
                $_SESSION['amount'] = $amount;
                $this->addInfoMessage("Successful registration!");
                $this->redirect("books", "index");
            } else{
                $this->addErrorMessage("Register faild!");
            }
        }

        $this->renderView(__FUNCTION__);
    }

    public function login(){
        if($this->isPost()){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $isLoggedIn = $this->db->login($username, $password);
            if($isLoggedIn){
                $_SESSION['username'] = $username;
                $_SESSION['amount'] = $this->db->getCash($username)[0];
                $this->addInfoMessage("Successful login!");
                if($this->db->isAdmin($username)){
                    $_SESSION['isAdmin'] = $username;
                    return $this->redirect("admin", "index");
                }
                if($this->db->isEditor($username)){
                    $_SESSION['isEditor'] = $username;
                    return $this->redirect("home", "index");
                }
                return $this->redirect("categories");
            } else{
                $this->addErrorMessage("Invalid login!");
            }
        }

        $this->renderView(__FUNCTION__);
    }

    public function logout(){
        $this->authorize();

        unset($_SESSION['username']);
        unset($_SESSION['isAdmin']);
        unset($_SESSION['isEditor']);
        unset($_SESSION['cash']);
        session_destroy();
        $this->addInfoMessage("You are logged out!");
        $this->redirectToUrl("/");
    }
}