<?php

class PostController extends BaseController {
    private $db;

    public function onInit() {
        $this->title = "Post";
        $this->db = new PostModel;
    }

    public function index($id) {
        $this->post = $this->db->getPostById($id);
        $visits =  $this->post[0][4] + 1;
        $this->db->updateVisits($id, $visits);
        $this->renderView();
    }

    public function create() {
        $this->authorise();
        if($this->isPost){
            $user_id = $_SESSION['user_id'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            if($content == null) {
                $this->addErrorMessage("Error creating post.");
                return $this->renderView('create');
            }
            if(strlen($title)<=2) {
                $this->addFieldValue('title', $title);
                $this->addValidationError('title', 'The title length should be greater than 2!');
                return $this->renderView('create');
            }
            if($this->db->createPost($title, $content, $user_id )) {
                $this->addInfoMessage("Post created successfully.");
                $this->redirectToUrl('/');
            }else{
                $this->addErrorMessage("Error creating post.");
            }
        }

        $this->renderView('create');
    }






}