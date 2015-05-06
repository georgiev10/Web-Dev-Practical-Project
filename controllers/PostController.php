<?php

class PostController extends BaseController {
    private $db;

    public function onInit() {
        $this->title = "Post";
        $this->db = new PostModel;
    }

    public function index($id) {
        $this->post = $this->db->getPostById($id);
        $this->tags = $this->db->getTagsByPostId($id);
        $this->comments = $this->db->getAllCommentsByPostId($id);

        $owner_username = $this->post[0][5];
        if($this->isAdmin || $owner_username == $_SESSION['username']){
           $_SESSION['post']=$this->post;
           $_SESSION['tags']=$this->tags;           
        }
        $_SESSION['comments']=$this->comments;

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
            $tags = preg_split("/[\s,]+/", $_POST['tags'], -1, PREG_SPLIT_NO_EMPTY);
            if($content == null) {
                $this->addErrorMessage("Error creating post. Enter a content!");
                return $this->renderView('create');
            }
            $tagsNumber = count($tags);
            if($tagsNumber<1) {
                $this->addErrorMessage("Error creating post. Enter a tag!");
                return $this->renderView('create');
            }
            if(strlen($title)<=2) {
                $this->addFieldValue('title', $title);
                $this->addValidationError('title', 'The title length should be greater than 2!');
                return $this->renderView('create');
            }

            $post_id = $this->db->createPost($title, $content, $user_id );
            if($post_id) {
                $this->insertTags($tags, $post_id);
                $this->addInfoMessage("Post created successfully.");
                $this->redirectToUrl('/');
            }else{
                $this->addErrorMessage("Error creating post.");
            }
        }

        $this->renderView('create');
    }

    public function edit($post_id, $owner_username) {
        if(!$this->isAdmin && $owner_username != $_SESSION['username']){
            $this->redirectToUrl('/post/index/' . $post_id);
        }
        if($this->isPost){
            $title = $_POST['title'];
            $content = $_POST['content'];
            $tags = preg_split("/[\s,]+/", $_POST['tags'], -1, PREG_SPLIT_NO_EMPTY);
            if($content == null) {
                $this->addErrorMessage("Error editing post.");
                return $this->renderView('edit');
            }
            $tagsNumber = count($tags);
            if($tagsNumber<1) {
                $this->addErrorMessage("Error editing post. Enter a tag!");
                return $this->renderView('edit');
            }
            if(strlen($title)<=2) {
                $this->addFieldValue('title', $title);
                $this->addValidationError('title', 'The title length should be greater than 2!');
                return $this->renderView('edit');
            }

            if($this->db->editPost($title, $content, $post_id )) {
                $this->db->deleteTagsFromPost($post_id);
                $this->insertTags($tags, $post_id);
                unset($_SESSION['post']);
                unset($_SESSION['tags']);
                $this->addInfoMessage("Post edited successfully.");
                $this->redirectToUrl('/post/index/' . $post_id);
            }else{
                $this->addErrorMessage("Error editing post.");
            }
        }

        $this->renderView('edit');
    }

    public function deleteConfirm(){
        $this->admin();
        $this->renderView('deleteConfirm');
    }

    public function delete($post_id){
        $this->admin();
        $this->db->deleteCommentsByPostId($post_id);
        $this->db->deleteTagsFromPost($post_id);
        if ($this->db->deletePost($post_id)) {
            $this->addInfoMessage("Post deleted successfully.");
            $this->redirectToUrl('/');
        } else {
            $this->addErrorMessage("Error deleting post.");
        }
    }

    public function insertTags($tags, $post_id){
        foreach($tags as $tag){
            $idExistingTag = $this->db->getIdExistingTag($tag);
            if($idExistingTag){
                $tag_id = $idExistingTag;
            }else{
                $tag_id = $this->db->insertTags(strtolower($tag));
            }
            $this->db->insertTagsByPost($tag_id, $post_id );
        }
    }






}