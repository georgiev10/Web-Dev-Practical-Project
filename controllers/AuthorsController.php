<?php

class AuthorsController extends BaseController{
    private $db;

    public function onInit() {
        $this->title = "Authors";
        $this->db = new AuthorsModel();
    }

    public function index() {
        $this->authorise();
        $this->authors = $this->db->getAll();
        $this->renderView();
    }

    public function create() {
       $this->authorise();
       if($this->isPost){
           $name = $_POST['author_name'];
           if(strlen($name)<2) {
               $this->addFieldValue('author_name', $name);
               $this->addValidationError('author_name', 'The author name length should be greater than 2');
               return $this->renderView('create');
           }
           //$this->authors = $this->db->createAuthor($name);
           if($this->db->createAuthor($name)) {
               $this->addInfoMessage("Author created successfully.");
               $this->redirect('authors');
           }else{
               $this->addErrorMessage("Error creating author.");
           }
       }
        $this->renderView('create');
    }

    public function delete($id) {
        $this->authorise();
        if($this->db->deleteAuthor($id)){
            $this->addInfoMessage("Author deleted successfully.");
        }else{
            $this->addErrorMessage("Error deleting author.");
        }
        $this->redirect('authors');
    }

}