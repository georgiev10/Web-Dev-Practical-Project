<?php

class CommentsController extends BaseController{
    private $db;

    public function onInit() {
        $this->db = new CommentsModel;
        $this->dbTags = new TagsModel();
        $this->tagSidebar = $this->dbTags->getPopularTags();
    }

    public function create($post_id) {
        $this->title = "Create Comment";
        $this->post_id = $post_id;
        if($this->isPost){
            $content = $_POST['content'];
            if($content == null) {
                $this->addErrorMessage("Error creating comment.");
                return $this->renderView('create');
            }
            if($this->isLoggedIn){
                $this->createCommentByUser($content, $post_id);
            }
            if(!$this->isLoggedIn){
                $this->createCommentByVisitor($content, $post_id);
            }
        }
        $this->renderView('create');
    }

    public function deleteConfirm($post_id, $comment_id){
        $this->title = "Delete Comment";
        $this->admin();
        $this->post_id = $post_id;
        $this->comment_id = $comment_id;
        $this->renderView('deleteConfirm');
    }

    public function delete($post_id, $comment_id){
        $this->admin();
        if ($this->db->deleteCommentsById($comment_id)) {
            $this->addInfoMessage("Comment deleted successfully.");
            $this->redirectToUrl('/post/index/' . $post_id);
        } else {
            $this->addErrorMessage("Error deleting comment.");
        }
    }

    public function edit($post_id, $comment_id, $owner_username) {
        if(!$this->isAdmin && $owner_username != $_SESSION['username']){
            $this->redirectToUrl('/post/index/' . $post_id);
        }
        $this->title = "Edit Comment";
        $this->post_id = $post_id;
        $this->comment_id = $comment_id;

        if($this->isPost){
            $content = $_POST['content'];
            if($content == null) {
                $this->addErrorMessage("Error editing comment.");
                return $this->renderView('edit');
            }

            if($this->db->editComment($content, $comment_id)) {
                $this->addInfoMessage("Comment edited successfully.");
                $this->redirectToUrl('/post/index/' . $post_id);
            }else{
                $this->addErrorMessage("Error editing post.");
            }
        }
        $this->renderView('edit');
    }

    function createCommentByUser($content, $post_id){
        $user_id = $_SESSION['user_id'];
        if($this->db->createCommentFromUser($content, $user_id, $post_id)) {
            $this->addInfoMessage("Comment created successfully.");
            $this->redirectToUrl('/post/index/' . $post_id);
        }else{
            $this->addErrorMessage("Error creating comment.");
        }
    }

    function createCommentByVisitor($content, $post_id){
        $visitor_name = $_POST['visitor-name'];
        if(strlen($visitor_name)<=2) {
            $this->addFieldValue('visitor-name', $visitor_name);
            $this->addValidationError('visitor-name', 'The visitor name length should be greater than 2!');
            return $this->renderView('create');
        }
        $visitor_email = $_POST['visitor-email'];
        if($this->db->createCommentFromVisitor($content, $visitor_name, $visitor_email, $post_id)) {
            $this->addInfoMessage("Comment created successfully.");
            $this->redirectToUrl('/post/index/' . $post_id);
        }else{
            $this->addErrorMessage("Error creating comment.");
        }
    }
}