<?php

class AuthorsController extends BaseController {
    private $db;

    public function onInit(){
        $this->title = "Authors";
        $this->db = new AuthorsModel();
    }

    public function index(){
        $this->authorize();

        $this->authors = $this->db->getAll();

        $this->renderView();
    }

    public function create(){
        $this->authorize();

        if($this->isPost()){
            $name = $_POST['author_name'];
            if(strlen($name) < 3){
                $this->addValidationError('author_name', 'The author name length should be greater than 3.');
                return $this->renderView(__FUNCTION__);
            }

            if($this->db->createAuthor($name)){
                $this->addInfoMessage("Authors created.");
                $this->redirect('authors');
            } else{
                $this->addErrorMessage("Error creating author.");
            };

        }

        $this->renderView(__FUNCTION__);
    }

    public function delete($id){
        $this->db->deleteAuthor($id);
        $this->redirect('authors');

        $this->renderView(__FUNCTION__);
    }
}