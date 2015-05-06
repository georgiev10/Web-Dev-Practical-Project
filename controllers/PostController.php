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

    public function edit($post_id) {
        $this->admin();
        if($this->isPost){
            $title = $_POST['title'];
            $content = $_POST['content'];
            if($content == null) {
                $this->addErrorMessage("Error editing post.");
                return $this->renderView('edit');
            }
            if(strlen($title)<=2) {
                $this->addFieldValue('title', $title);
                $this->addValidationError('title', 'The title length should be greater than 2!');
                return $this->renderView('create');
            }
            if($this->db->editPost($title, $content, $post_id )) {
                $this->addInfoMessage("Post edited successfully.");
                $this->redirectToUrl('/post/index/' . $post_id);
            }else{
                $this->addErrorMessage("Error editing post.");
            }
        }

        $this->renderView('edit');
    }

    public function insertTags($tags, $post_id){
        foreach($tags as $tag){
            $idExistingTag = $this->db->getIdExistingTag($tag);
            if($idExistingTag){
                $tag_id = $idExistingTag;
            }else{
                $tag_id = $this->db->insertTags($tag);
            }
            $this->db->insertTagsByPost($tag_id, $post_id );
        }
    }






}