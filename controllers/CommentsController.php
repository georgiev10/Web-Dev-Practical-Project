<?php

class CommentsController extends BaseController{
    private $db;

    public function onInit() {
        $this->db = new CommentsModel;
    }
    public function showComments($post_id) {
        $this->comments = $this->db->getAll($post_id);
        $this->renderView('showComments', false);
    }

    public function create($post_id) {
        if($this->isPost){
            $comment = $_POST['comment'];
            if($comment == null) {
                $this->addErrorMessage("Error creating comment.");
                return $this->renderView('create');
            }
            if($this->isLoggedIn){
                $user_id = $_SESSION['user_id'];
                if($this->db->createCommentFromUser($comment, $user_id, $post_id)) {
                    $this->addInfoMessage("Comment created successfully.");
                    $this->redirectToUrl('/post/index/' . $post_id);
                }else{
                    $this->addErrorMessage("Error creating comment.");
                }
            }
            if(!$this->isLoggedIn){
                $visitor_name = $_POST['visitor-name'];
                if(strlen($visitor_name)<=2) {
                    $this->addFieldValue('visitor-name', $visitor_name);
                    $this->addValidationError('visitor-name', 'The visitor name length should be greater than 2!');
                    return $this->renderView('create');
                }
                $visitor_email = $_POST['visitor-email'];
                if($this->db->createCommentFromVisitor($comment, $visitor_name, $visitor_email, $post_id)) {
                    $this->addInfoMessage("Comment created successfully.");
                    $this->redirectToUrl('/post/index/' . $post_id);
                }else{
                    $this->addErrorMessage("Error creating comment.");
                }
            }
        }
        $this->renderView('create');
    }








}